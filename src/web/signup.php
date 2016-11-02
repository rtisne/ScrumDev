<?php
include("config.php");


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
        $_SESSION['id'] = get_user_by_username($email);
        $_SESSION['name'] = $last_name;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['email'] = $email;
        header("Location: " . get_base_url() . "/listProjects.php");
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

function get_user_by_username($email){
    $sql_query = 'SELECT id FROM '. "user"." WHERE email='$email'";
    $arr = fetch_first($sql_query);
    return $arr;
}

include('templates/header.template.php');
include('templates/signup.template.php');
include('templates/footer.template.php');



?>
