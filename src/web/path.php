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
    /*$script_len=strlen('SCRIPT');
    $file = substr($file, 1 + $i);
    $test = realpath($dir.$test);*/

    $abs_path = file_exists(__FILE__) ? __FILE__ : rtrim(realpath('.'), DIRECTORY_SEPARATOR);
    $pos = strrpos($abs_path, DIRECTORY_SEPARATOR);
    $dir = substr($abs_path, 0,1+ $pos);

    $doc_root=substr($_SERVER['DOCUMENT_ROOT'],strrpos($_SERVER['DOCUMENT_ROOT'], $_SERVER['PHP_SELF']));
    $current_dir=substr($dir,strlen($doc_root));
    return '/'. get_absolute_path($current_dir) ;
}

function get_absolute_path($path) {
    $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
    $parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
    $absolutes = array();
    foreach ($parts as $part) {
        if ('.' == $part) continue;
        if ('..' == $part) {
            array_pop($absolutes);
        } else {
            $absolutes[] = $part;
        }
    }
    $path = implode(DIRECTORY_SEPARATOR, $absolutes);
    return (substr($path,-1)!='/') ? $path = $path . '/' : $path;
}


function get_current_url_without_query_string(){
    return strtok(get_current_url(),'?');
}