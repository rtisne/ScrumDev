<?php

/**
 * Created by PhpStorm.
 * User: ismo
 * Date: 28/10/16
 * Time: 11:11
 */
function check_email($email){
    if(preg_match('/^([*+!.&#$¶\'\\%\/0-9a-z^_`{}=?~:-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $email)){
        return $email;
    }else{
        return FALSE;
    }
}

?>