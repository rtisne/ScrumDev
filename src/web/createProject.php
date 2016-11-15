<?php
include_once("config.php");
if(!isset($_SESSION['id']))
    header("Location: " . get_base_url() . "index.php");

if(isset($_POST['submit']))
    createProject();

function createProject() {
    extract($_POST);
    if (!empty($name) && !empty($description)) {
        $safe_values = array("title" => $name , "description"=>$description, "creator"=>$_SESSION['id'], "product_owner" =>intval($product_owner), "date_added" =>'2016-10-10',"date_available" =>'2016-10-10');
        $project_id = add_project_in_db($safe_values);
        if(isset($_POST['member'])){
            foreach( $_POST['member'] as $m ) {
                $values = array("project" => $project_id , "member"=>intval($m));
                add_member_to_project($values);
            }
        }
        header("Location: " . get_base_url() . "listProjects.php");
    }
}

/**
 * @param array $values
 */
function add_project_in_db($values){
    $project_columns =  array_keys($values);
    $project_values = array_values($values);
    return execute_query(create_insert_sql("project",$project_columns),$project_values);

}

function add_member_to_project($values){
    $link_columns =  array_keys($values);
    $link_values = array_values($values);
    return execute_query(create_insert_sql("member_relations",$link_columns),$link_values);
}

$page_title = "Creer un nouveau projet";
$project_owner = array("id" => $_SESSION['id'], "first_name" => $_SESSION['first_name'], "name" => $_SESSION['name']);
$project_po = array("id" => $_SESSION['id'], "first_name" => $_SESSION['first_name'], "name" => $_SESSION['name']);
$product_owner_id = $_SESSION['id'];
include('templates/header.template.php');
include('templates/createProject.template.php');
include('templates/footer.template.php');
?>
