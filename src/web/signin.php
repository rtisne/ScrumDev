<?php
include_once("config.php");



$csrf_token = null;

if(get_session_var("id")){
    header("Location: " . get_base_url() . "listProjects.php");

}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' &&
    $_SERVER['REQUEST_METHOD'] === "POST"){
    user_logout();
}


if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit'])){
    user_login();
}
else{
    user_token_initialization();
}



function user_token_initialization(){
    global $csrf_token;
    $csrf_token = get_token(CSRF_TOKEN."12")["value"];
}

function user_login(){
    //check that mandatory fields are not empty
    $email = $_POST['email'];
    $password = $_POST['password'];
    $csrf_token_value = $_POST['token'];
    $csrf_token = array("id" => CSRF_TOKEN."12", "value" => $csrf_token_value);

    if(!is_token_valid($csrf_token)){
        trigger_error("CSRF attack detected.");
    }

    if (!empty($email) &&
        !empty($password)
         ) {

        $credentials =  array("email" => $email, "password" => $password);
        if(!empty($user = user_credentials_check($credentials)))
        {

            set_session_vars($user);
            header("Location: " . get_base_url() . "listProjects.php");
        }
        else{
            header("Location: " . get_base_url() . "index.php");

        }

    }
}

function user_logout() {
    destroy_current_session();

}



include('templates/header.template.php');
include('templates/signin.template.php');
include('templates/footer.template.php');


?>
