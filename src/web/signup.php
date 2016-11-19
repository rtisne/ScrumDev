<?php
include_once("config.php");

if(get_session_var("id"))
    header("Location: " . get_base_url() . "listProjects.php");

if(isset($_POST['submit']))
    signup();


function signup(){

    // collect user form data

    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $password =$_POST['password'];

    //check that mandatory fields are not empty

    if (!empty($email) &&
        !empty($password) &&
        !empty($last_name) &&
        !empty($first_name) ) {

        // Hash password
        $password = password_hash(trim($password),PASSWORD_DEFAULT);

        $safe_values = array("name" => $last_name , "first_name"=>$first_name, "email"=>$email, "password" =>$password);
        add_user_in_db($safe_values);
        $user = user_data_by_email($email);
        set_session_vars($user);
        header("Location: " . get_base_url() . "listProjects.php");
    }
}

/**
 * @param array $values
 */
function add_user_in_db($values){
    $user_columns =  array_keys($values);
    $user_values = array_values($values);
    execute_query(create_insert_sql("user",$user_columns),$user_values);

}


include('templates/header.template.php');
include('templates/signup.template.php');
include('templates/footer.template.php');



?>
