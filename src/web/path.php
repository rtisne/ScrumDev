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
    $doc_root=substr($_SERVER['DOCUMENT_ROOT'],strrpos($_SERVER['DOCUMENT_ROOT'], $_SERVER['PHP_SELF']));
    $current_dir=substr($abs_path,strlen($doc_root));
    if($current_dir != ""){
        (substr($current_dir,-1)!='/') ? $current_dir.='/' : $current_dir;
    }
    return "/" . $current_dir ;
}


function get_current_url_without_query_string(){
    return strtok(get_current_url(),'?');
}


function generate_url(array $url, array $query_string){

    $url['query'] = http_build_query($query_string, '', '&');
    $scheme = isset($url['scheme']) ? $url['scheme'].'://' : '';
    $host = isset($url['host']) ? $url['host'] : '';
    $port = isset($url['port']) ? ':'.$url['port'] : '';
    $path = isset($url['path']) ? $url['path'] : '';
    $query = isset($url['query']) && $url['query'] ? '?'.$url['query'] : '';
    $fragment = isset($url['fragment']) ? '#'.$url['fragment'] : '';
    return $scheme.$host.$port.$path.$query.$fragment;
}


function check_url_security($url_param){
    $url = parse_url($url_param);
    if (isset($url['query'])) {
        parse_str($url['query'], $query_string);
    } else {
        $query_string = array();
    }

    return check_query_string_security($query_string);
}


function check_query_string_security($query_string){
    foreach ($query_string as $query_string_key => $query_string_value){
        $result = preg_match("/_hash$/",$query_string_key) && check_encoded_value($query_string_key,$query_string_value) ;
        if(!$result){
            return false;

        }
    }

    return true;
}

function check_encoded_value($query_string_key,$query_string_value){
    if(!$_SESSION){
        trigger_error("Session is not set to check if this url is secure");

    }
    $values = get_session_var("session_" . $query_string_key);
    $value = $values[$_GET[$query_string_key]] . preg_replace("/_hash$/","",$query_string_key);
    return comparison_between_hash(hmac_base64($value,PROJECT_SECRET_KEY),$query_string_value);
}