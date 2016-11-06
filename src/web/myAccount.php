<?php
include('config.php');


if(!isset($_SESSION['id']))
    header("Location: " . get_base_url() . "index.php");

if(isset($_POST['submit']))
    ModifAccount();






function ModifAccount()
{
	    extract($_POST);

	    $_SESSION['name'] = $_POST['last_name'];
	    $_SESSION['first_name'] = $_POST['first_name'];

		$passwordH = password_hash(trim($_POST['password']),PASSWORD_DEFAULT);
	    $safe_values = array("name" => $_POST['last_name'], "first_name"=>$_POST['first_name'], "email"=>$_POST['email'], "password" =>$passwordH);
        update_user_in_db($safe_values);
        header("Location: " . get_base_url() . "listProjects.php");

}



include("templates/header.template.php");

$values = getUserInfos($_SESSION['id']);
$user_name =  $values['name'];
$first_name =  $values['first_name'];
$email = $values['email'];

include("templates/modifAccount.template.php");
include("templates/footer.template.php");



function update_user_in_db($values){
    $user_columns =  array_keys($values);
    $user_values = array_values($values);
    $user_values["id"] = intval($_SESSION['id']);
    execute_query(create_update_sql("user",$user_columns),$user_values);

}




function getUserInfos($user_id){
    $sql_query = "SELECT * FROM user WHERE id = ".intval($user_id)."";
    $arr = fetch_first($sql_query);
    return $arr;
}


?>
