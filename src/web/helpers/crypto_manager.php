<?php

define('ENCODING',"BASE_64");
define('MAXIMUM_TRIES',100);


    function hmac_base64($data, $key) {

        if (!is_scalar($data) || !is_scalar($key)) {
            throw new \InvalidArgumentException('Both parameters passed  must be scalar values.');
        }

        $hmac = base64_encode(hash_hmac('sha256', $data, $key, TRUE));
        // Modify the hmac so it's safe to use in URLs.
        return str_replace(['+', '/', '='], ['-', '_', ''], $hmac);
    }

    //Generates cryptographically secure pseudo-random bytes

    function secure_random_bytes($length = 32) {
        if(intval($length) <= 8 ){
            $length = 32;
        }
        if (function_exists('random_bytes')) {
            return bin2hex(Security::randomBytes($length));
        }
        if (function_exists('mcrypt_create_iv')) {
            return bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
        }
        if (function_exists('openssl_random_pseudo_bytes')) {
            return bin2hex(openssl_random_pseudo_bytes($length));
        }
    }

    function generate_salt($length, $alphabet = '', $unique = FALSE) {

        $attempt = 0;

        if(!$alphabet){
            $alphabet  =' ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $alphabet .= 'abcdefghijklmnopqrstuvwxyz';
            $alphabet .= '0123456789+/';
        }
        $maxCharIndex = strlen($alphabet) - 1;
        $random_string = '';

        do {
            if ($attempt == MAXIMUM_TRIES) {
                throw new RuntimeException('Unable to generate a unique random name');
            }

            for ($i = 1; $i < $length; $i++) {
                $random_number = random_int(0, $maxCharIndex);
                $random_string .= $alphabet[$random_number];
            }
            $attempt++;
            ;
        } while($unique);

        return $random_string;
    }



function comparison_between_hash($hash_one, $hash_two){
        return (!function_exists('hash_equals')) ? compare_hash($hash_one,$hash_two) : hash_equals($hash_one,$hash_two);
    }

    function compare_hash($str_one, $str_two)
    {
        if (!is_string($str_one)) {
            trigger_error(sprintf("Expected str_one to be a string, %s given", gettype($str1)), E_USER_WARNING);
            return false;
        }

        if (!is_string($str_two)) {
            trigger_error(sprintf("Expected str_two to be a string, %s given", gettype($str2)), E_USER_WARNING);
            return false;
        }

        if (strlen($str_one) != strlen($str_two)) {
            return false;

        } else {
            $res = $str_one ^ $str_two;
            $ret = 0;
            for ($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
            return !$ret;
        }
    }

