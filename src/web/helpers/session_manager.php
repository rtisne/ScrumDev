<?php


define('APP_SESSION_ID',md5("SCRUM_SESSION_ID"));
define('APP_SERVER_SESSION_ID', "SERVER_SESSION_ID"); // mark session for check
define('APP_COOKIE_DOMAIN', "localhost"); // cookie domain
define('APP_COOKIE_PATH', "/"); // path over which cookies will be sent
define('APP_COOKIE_EXPIRATION', 0); //lifetime of the session cookie - 0 is when browser closes
define('APP_COOKIE_SECURE', false); // send cookie over secure channel
define('APP_COOKIE_HTTP_ONLY', false); // attempt to send the httponly flag when setting the session cookie.
define("DATABASE","_database");
define("CACHE", "_memcached");

/**
 * register session variables
 * @param string $vars session variables are represented by associative array
 */


function set_session_vars($vars){
    foreach ($vars as $key => $value){
        set_session_var($key,$value);
    }
}

/**
 * @param string $key session variable name
 * @return null
 */

function get_session_var($key){
    if(!session_has_already_started())
        return;
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
}

/**
 * put variable into session
 * @param string $key the name of the session variable
 * @param $value
 */
function set_session_var($key, $value){
    if(!session_has_already_started())
        return;
    $_SESSION[$key] = $value;

}

/**
 * Removes a session variable.
 * @param string $key the name of the session variable
 * @return mixed the deleted value
 */
function delete_session_var($key){
    if(!session_has_already_started())
        return;
    if (isset($_SESSION[$key])) {
        $value = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $value;
    } else {
        return null;
    }

}

/**
 * Check whether the session variable is set or not
 * @param $key
 * @return bool|void
 */
function has_session_var($key)
{
    if(!session_has_already_started())
        return;
    return array_key_exists($key,$_SESSION) && isset($_SESSION[$key]);
}


/**
 * Start a new session or resume existing session
 */

function start_session(){
    if(session_has_already_started())
        return;
    session_name(APP_SESSION_ID);

    session_start();
}

/**
 * Check if session already exists
 * @return bool
 */

function session_has_already_started(){
    if (version_compare(phpversion(), '5.4.10', '>=')) {
        return session_status() === PHP_SESSION_ACTIVE ;
    }else{
        return session_id() === '' ;
    }
    return false;
}


/**
 * Destroy all session variables and session itself
 */

function destroy_current_session()
{
    if (session_has_already_started()) {
        session_unset();
        session_destroy();
    }
}



/**
 * @param $path
 * @throws InvalidArgumentException if save_path is not a valid directory
 */

function set_session_save_path($path){
    if (is_dir($path)) {
        session_save_path($path);
    } else {
        throw new InvalidArgumentException("Session save path is not a valid directory: " .$path);
    }
}


/**
 * Sets the session cookie arguments
 * @param array $cookie_params
 * @throws InvalidArgumentException if the arguments are incomplete.
 */

function set_session_cookies_params($cookie_params = array("lifetime" => APP_COOKIE_EXPIRATION
                                                            , "path" => APP_COOKIE_PATH
                                                            ,"domain" => APP_COOKIE_DOMAIN
                                                            ,"secure" => APP_COOKIE_SECURE
                                                            ,"http_only" => APP_COOKIE_HTTP_ONLY ))
{
    extract($cookie_params);
    if(isset($lifetime, $path, $domain, $secure, $http_only))
        session_set_cookie_params($lifetime, $path,$domain,$secure ,$http_only);
    else
        throw new InvalidArgumentException('cookie_params may have the following possible keys : lifetime, path, domain, secure and http_only.');

}

/**
 * Get a number of elements into the current session
 * @return int|void
 */

function get_num_items_in_session(){
    if(!session_has_already_started())
        return;
    return count($_SESSION);

}




