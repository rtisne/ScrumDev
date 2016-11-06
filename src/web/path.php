<?php

function get_current_url(){
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['REQUEST_URI']
    );
}

function get_base_url(){
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        absolute_path()
    );
}

function absolute_path(){
    $abs_path=substr(__FILE__,0,strrpos(__FILE__,'/'));
    $doc_root=substr($_SERVER['DOCUMENT_ROOT'], strrpos($_SERVER['DOCUMENT_ROOT'], $_SERVER['PHP_SELF']));
    $current_dir=substr($abs_path,strlen($doc_root));
    return "/" . $current_dir;
}

