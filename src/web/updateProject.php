<?php
include('config.php');

if(!isset($_SESSION['id']))
    header("Location: " . get_base_url() . "index.php");

if(isset($_POST['submit']))
    updateProject();



function updateProject() {
    extract($_POST);
    if (!empty($name) && !empty($description)) {
        $safe_values = array("title" => $name , "description"=>$description, "creator"=>$_SESSION['id'], "product_owner" =>intval($product_owner));
        update_project_in_db($safe_values);
        remove_members(intval($_GET['project_id']));
        if(isset($_POST['member'])){
            foreach( $_POST['member'] as $m ) {
                $values = array("project" => intval($_GET['project_id']) , "member"=>intval($m));
                add_member_to_project($values);
            }
        }
        header("Location: " . get_base_url() . "listProjects.php");
    }
}


function update_project_in_db($values){
    $project_columns =  array_keys($values);
    $project_values = array_values($values);
    $project_values["id"] = intval($_GET['project_id']);
    execute_query(create_update_sql("project",$project_columns),$project_values);

}

function add_member_to_project($values){
    $link_columns =  array_keys($values);
    $link_values = array_values($values);
    return execute_query(create_insert_sql("member_relations",$link_columns),$link_values);
}

function remove_members(){
    $sql_query = "DELETE FROM member_relations WHERE project='".intval($_GET['project_id'])."'";
    $arr = perform_query($sql_query);
}

$project_infos = getProjectInfos(intval($_GET['project_id']));
if($project_infos == NULL)
    header("Location: " . get_base_url() . "listProjects.php");
if($project_infos['creator'] != $_SESSION['id'])
        header("Location: " . get_base_url() . "index.php");

$project_members_request = getProjectMembers(intval($_GET['project_id']));
$project_members = array();
while($row = $project_members_request->fetch_array())
    array_push($project_members,array("id" => $row['member'], "first_name" => $row['first_name'], "name" => $row['name']));

$page_title = "Modifier le projet";
$project_name =  $project_infos['title'];
$project_desc =  $project_infos['description'];
$product_owner_id =  $project_infos['product_owner'];
$project_owner = array("id" => $_SESSION['id'], "first_name" => $_SESSION['first_name'], "name" => $_SESSION['name']);
include('templates/header.template.php');
include('templates/createProject.template.php');
include('templates/footer.template.php');



function getProjectInfos($project_id){
    $sql_query = "SELECT * FROM project WHERE id = ".intval($project_id)."";
    $arr = fetch_first($sql_query);
    return $arr;
}

function getProjectMembers($project_id){
    $sql_query = "SELECT * FROM user INNER JOIN member_relations ON  user.id = member_relations.member WHERE member_relations.project='".$project_id."'";
    $arr = perform_query($sql_query);
    return $arr;
}
?>
