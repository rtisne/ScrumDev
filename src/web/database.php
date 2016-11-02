<?php

/**
 * @param $db
 * @param string $database_name
 * @param string $mysql_server
 * @param string $mysql_username
 * @param string $mysql_password
 * @return mysqli|resource
 */

function db_connect(&$db, $database_name = null, $mysql_server = null, $mysql_username = null, $mysql_password = null)
{
    if(empty($mysql_server))
        $mysql_server = $GLOBALS['hostname'];

    if(empty($mysql_user))
        $mysql_username = $GLOBALS['username'];

    if(empty($mot_de_passe_mysql))
        $mysql_password = $GLOBALS['password'];

    if(empty($database_name))
        $database_name = $GLOBALS['database_name'];


    if($GLOBALS['mysql_extension'] == 'mysqli') {
        $port = @ini_get("mysqli.default_port");
        if(empty($port)) {
            // default port
            $port = 3306;
        }
        $server = explode(':',$mysql_server);

        if(isset($GLOBALS['site_parameters']['use_database_permanent_connection']) && ($GLOBALS['site_parameters']['use_database_permanent_connection'] === true || ($GLOBALS['site_parameters']['use_database_permanent_connection'] == 'local' && (strpos($GLOBALS['wwwroot'], '://localhost')!==false || strpos($GLOBALS['wwwroot'], '://127.0.0.1')!==false)))) {
            // Use  pconnect for optimization

            $db = mysqli_connect('p:'.$server[0], $mysql_username, $mysql_password, '', $port);
        } else {
            $db= mysqli_connect($server[0], $mysql_username, $mysql_password, '', $port);
        }

    } else {
        // If someone use a very very old version of PHP
        $db = mysql_connect($mysql_server, $mysql_username, $mysql_password);
    }
    if(!empty($database_name)) {
        $GLOBALS['database_selected'] = _select_db($database_name, $db);
    }
    return $db;
}

function _select_db($db_name,&$db_instance)
{
    if ($GLOBALS['mysql_extension'] == 'mysqli') {
        $GLOBALS['database_selected'] = $db_instance->select_db($db_name);

    }else{
        $GLOBALS['database_selected'] = mysql_select_db($db_name, $db_instance);

    }
    return $GLOBALS['database_selected'];
}


/**
 * @param $sql_query
 * @param null $db
 * @param bool $silent_if_error
 * @param bool $sql_filter
 * @return bool|resource
 */

function perform_query($sql_query ,$db = null, $silent_if_error = false, $sql_filter = true)
{
    if (empty($sql_query)) {
        return false;
    }


    // throw malicious queries

    if ($sql_filter && (strpos(strtolower($sql_query), 'information_schema') !== false || strpos(strtolower($sql_query), 'loadfile') !== false || strpos(strtolower($sql_query), 'union all') !== false) || strpos(strtolower($sql_query), 'benchmark(') !== false) {
        return false;
    }

    if (empty($db)) {
        $db = &$GLOBALS['database'];
    }

    $i = 0;

    while (empty($query_values)) {
        if ($i > 0) {
            // We are made another attempt
            if (empty($error_number) || in_array($error_number, array(111, 126, 127, 141, 144, 145, 1034, 1053, 1137, 1152, 1154, 1156, 1184, 1205, 1317, 2003, 2006, 2013))) {
                // https://dev.mysql.com/doc/refman/5.7/en/error-lost-connection.html
                /// Lost connection to MySQL server during query
                // 2006 MySQL server has gone away
                if (!empty($db)) {
                    // Waiting for a little moment
                    sleep(1);
                }
                db_connect($db);

            }elseif($error_number == 1364 && String::strpos($sql_query, 'sql_mode') === false) {
            set_configuration_variable(array('technical_code' => 'mysql_sql_mode_force', 'string' => 'MYSQL40', 'site_id' => 0, 'origin' => 'auto'), true);

            query("SET @@session.sql_mode='MYSQL40'");
            break;
            } else {
                // If unknown error , exit from the loop
                break;
            }
        }
        if (!empty($db)) {

            if ($GLOBALS['mysql_extension'] == 'mysqli') {

                    if ($silent_if_error) {
                        $query_values = @$db->query($sql_query);

                    } else {
                        $query_values = $db->query($sql_query);
                    }
                } else {
                    if ($silent_if_error) {
                        $query_values = @mysql_query($sql_query, $db);
                    } else {
                        $query_values = mysql_query($sql_query, $db);
                    }
                }

        }

        if (empty($query_values) && !empty($database_object)) {

                if ($GLOBALS['mysql_extension'] == 'mysqli') {
                    $error_number = $db->errno;
                    $error_name = $db->error;
                } else {
                    $error_number = mysql_errno($db);
                    $error_name = mysql_error($db);
                }
            }
            $i++;
            if ($i >= 2) {
                break;
            }

            if (!empty($query_values)) {
                return $query_values;
            }
        }


}


/**
 * @param $sql_query
 * @param array $values
 * @return bool
 */

function execute_query($sql_query, $values = array()){
    $ref_values = null;

    if (empty($db)) {
        $db = &$GLOBALS['database'];
    }

    $stmt = $db->prepare($sql_query);
    $types = '';
    foreach($values as $k => $v) {
        if (is_string($v)) $types .= 's';
        else if (is_integer($v)) $types .= 'i';
        else $types .= 'd';
    }
    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
    {
        $ref_values = array();
        foreach($values as $key => $value)
            $ref_values[$key] = &$values[$key];

    }
    $func_arr = array_merge( array($stmt,$types), $ref_values );
    call_user_func_array('mysqli_stmt_bind_param',$func_arr);
    mysqli_stmt_execute($stmt);
    $status = mysqli_insert_id($db);
    return $status;
}

/**
 * @param $table_name
 * @param null $columns
 * @param null $insert_sql
 * @return null|string
 */
function create_insert_sql($table_name, $columns = null, $insert_sql = null){

    if($insert_sql != null)
        return $insert_sql;

    if(empty($table_name))
        $table_name = get_table_name();

    if (empty($columns)) {
        $insert_sql = create_insert_sql_identity();
        return $insert_sql;
    }

    $values =array();
    $columns = array_unique($columns);


    foreach ($columns as $column) {
        $placeholder = "?";
        if(isset($GLOBALS['column_fields']) && isset($GLOBALS['column_types'] )){
            $placeholder = '?';
        }
        $values[] = $placeholder;
    }

    $columns = implode(', ', $columns);
    $values = implode(', ', $values);
    $insert_sql = sprintf('INSERT INTO %s (%s) VALUES (%s)', $table_name, $columns, $values);
    return $insert_sql;
}

function create_update_sql($table_name, $columns = null){
    if(empty($table_name))
        $table_name = get_table_name();

    if (empty($columns)) {
        $insert_sql = create_insert_sql_identity();
        return $insert_sql;
    }

    $values = array();
    $columns = array_unique($columns);
    foreach ($columns as $column) {
        $values[] = $column . "=?";
    }

    $values = implode(', ', $values);
    $insert_sql = sprintf('UPDATE %s SET %s WHERE id = ?', $table_name, $values);
    return $insert_sql;
}





/**
 * @return string
 */
function get_table_name(){
    // TODO
    return "";
}

/**
 * @return array
 */

function get_all_columns(){
    // TODO
    $columns = array();

    $column_query = "";
    /* Get field information for all fields */
    if($result = perform_query($column_query)){
        $fields_info = $result->fetch_fields();
        foreach ($fields_info as $field_info){
            $columns[] = $field_info->name;
        }
    }
    return $columns;
}



function get_insert_sql_version_two($table_name,$columns,$values){
    $query = 'INSERT INTO'. $table_name .  '(' . implode(',', $columns) .')'
        ." VALUES (". implode(', ',$values ) . ")";
    return $query;
}

/**
 * @param array ...$queries
 * @return array
 */

function perform_multiple_queries(...$queries){
    $query_values = array();
    foreach ($queries as $query) {
        array_push($query_values,perform_query($query));
    }
    return $query_values;
}

/**
 * @param $sql_query
 * @return mixed
 */
function fetch_first($sql_query){

    $query = perform_query($sql_query);
    return $query->fetch_array(MYSQLI_ASSOC);

}

function query_to_json($sql_query){
    if (empty($db)) {
        $db = &$GLOBALS['database'];
    }
    if ($result = $db->query($sql_query)) {
        $myArray = null;
        while($row = $result->fetch_array()) {
                $myArray[] = $row;
        }
        return json_encode($myArray);
    }
}
?>
