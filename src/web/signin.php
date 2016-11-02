<?php
include("config.php");


if(isset($_POST['submit']))
    signin();

function signin(){
    //check that mandatory fields are not empty
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) &&
        !empty($password)
         ) {
        // Check for security TODO
        $credentials =  array("email" => $email, "password" => $password);
        if(!empty($user = login_check($credentials)))
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

function login_check($credentials){
    // Check user credentials
    $user = extract_user_from_db($credentials);
    if(!(check_email($credentials["email"]) &&
    check_password($user , $credentials["password"])))
        $user = array();
    return $user;
}

function extract_user_from_db($criteria = array()){
    $result = null;
    // extract from database

    if(empty($criteria))
        return array();

    if(array_key_exists("email",$criteria))
        $result = get_user_by_username($criteria["email"]);

    return $result;
}

function get_user_by_username($email){
    $sql_query = 'SELECT * FROM '. "user"." WHERE email='$email'";
    $arr = fetch_first($sql_query);
    return $arr;
}



include('templates/header.template.php');
include('templates/signin.template.php');
include('templates/footer.template.php');


?>
