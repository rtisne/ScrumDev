<?php

/**
 * Generate cryptographically secure token
 * @param string $user_id
 * @return mixed
 */

function generate_token($user_id){
    $reset_timeout = 60 * 60 * 24;
    $key = generate_salt(32,'');
    $data = current_time() + $reset_timeout;
    $data.= $user_id;
    $salt =  strtr(generate_salt(32,''), '+/', '-_');

    $code = hmac_base64($salt.$data, $key);
    return $code;

}




