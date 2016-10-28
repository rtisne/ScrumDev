<?php


/**
 * @param $email
 * @return bool
 */
function check_email($email){
    return preg_match('/^([*+!.&#$¶\'\\%\/0-9a-z^_`{}=?~:-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $email);
}

/**
 * @param $user
 * @param $password
 * @return bool
 */

function check_password($user, $password){
    return password_verify($password,$user["password"]);
}

?>