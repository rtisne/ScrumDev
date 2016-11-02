<?php
include("../config.php");
if(isset($_GET['name'])){
    $search_sql = 'SELECT * FROM user WHERE first_name LIKE \'%'.$_GET['name'].'%\' LIMIT 5';

    print query_to_json($search_sql);
}



?>
