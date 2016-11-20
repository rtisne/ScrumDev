<?php


/**
 * Check user email using regex
 * @param $email
 * @return bool
 */
function user_email_check($email){
    return preg_match('/^([*+!.&#$¶\'\\%\/0-9a-z^_`{}=?~:-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $email);
}

/**
 * Check user password using password_verify cf. http://php.net/manual/fr/function.password-verify.php
 * @param $user
 * @param $password
 * @return bool
 */

function user_password_check($user, $password){
    return password_verify($password,$user["password"]);
}


/**
 * Check user email and user password
 * @param $credentials
 * @return array
 */

function user_credentials_check($credentials){
    // Check user credentials
    $user = user_data_from_db($credentials);
    if(!(user_email_check($credentials["email"]) &&
        user_password_check($user , $credentials["password"]))){
        $user = array();
    }
    return $user;
}



/**
 * Select first row of user table
 * @param array $criteria
 * @return array|mixed|null
 */

function user_data_from_db($criteria = array()){
    $result = null;
    // extract from database

    if(empty($criteria)){
        return array();
    }

    if(array_key_exists("email",$criteria)){
        $result = user_data_by_email($criteria["email"]);
    }
    return $result;
}

/**
 * Row is selected via email and an associative array of user data is returned
 * @param $email
 * @return mixed
 */

function user_data_by_email($email){
    $sql_query = 'SELECT * FROM '. "user"." WHERE email='$email'";
    return fetch_first($sql_query);
}