<?php
include("config.php");





if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['REQUEST_METHOD'] === "POST"){
    user_logout();
}


if(isset($_POST['submit']))
    user_login();
else
    user_token_initialization();



function user_token_initialization(){
    // TODO
}

function user_login(){
    //check that mandatory fields are not empty
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) &&
        !empty($password)
         ) {
        // Check for security TODO
        $credentials =  array("email" => $email, "password" => $password);
        if(!empty($user = user_credentials_check($credentials)))
        {
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['email'] = $user['email'];
            header("Location: " . get_base_url() . "/listProjects.php");
        }
        else
            header("Location: " . get_base_url() . "/index.php");

    }
}


function user_logout() {
    destroy_current_session();

}



include('templates/header.template.php');
include('templates/signin.template.php');
include('templates/footer.template.php');


?>
