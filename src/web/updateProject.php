<?php
include_once('config.php');
include_once('projectInfos.php');

if(!$isCreator){
    header("Location: " . get_base_url() . "index.php");
}

if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit']) && ($_POST["submit"] == "update") && $isCreator){
    updateProject();

}
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit']) && ($_POST["submit"] == "delete") && $isCreator){
    deleteProject();
}

function updateProject() {
    extract($_POST);
    if (!empty($name) && !empty($description)) {
        $safe_values = array("title" => $name , "description"=>$description, "creator"=>$_SESSION['id'], "product_owner" =>intval($product_owner));
        update_project_in_db($safe_values);
        remove_members(intval($_GET['id_project']));
        if(isset($_POST['member'])){
            foreach( $_POST['member'] as $m ) {
                $values = array("project" => intval($_GET[GET_ID_PROJECT]) , "member"=>intval($m));
                add_member_to_project($values);
            }
        }
        header("Location: " . get_base_url() . "homeProject.php?id_project=" . $_GET[GET_ID_PROJECT]);
    }
}


function update_project_in_db($values){
    $project_columns =  array_keys($values);
    $project_values = array_values($values);
    $project_values["id"] = intval($_GET['id_project']);
    execute_query(create_update_sql("project",$project_columns),$project_values);

}

function add_member_to_project($values){
    $link_columns =  array_keys($values);
    $link_values = array_values($values);
    return execute_query(create_insert_sql("member_relations",$link_columns),$link_values);
}

function remove_members(){
    $sql_query = "DELETE FROM member_relations WHERE project='".intval($_GET[GET_ID_PROJECT])."'";
    $arr = perform_query($sql_query);
}

function deleteProject(){
    $idProject = intval($_GET['id_project']);
    perform_query("DELETE td.*, t.*, usis.*, us.*, s.*, mr.*, p.* FROM project p LEFT JOIN member_relations mr ON p.id = mr.project LEFT JOIN sprint s ON p.id = s.id_project LEFT JOIN user_story_in_sprint usis ON s.id = usis.user_story LEFT JOIN user_story us ON p.id = us.id_project LEFT JOIN task t ON us.id = t.id_us LEFT JOIN task_dependency td ON t.id = td.task WHERE p.id = $idProject");
    header("Location: " . get_base_url() . "index.php");
}

$project_members_request = getProjectMembers(intval($_GET['id_project']));
$project_members = array();
while($row = $project_members_request->fetch_array()){
    array_push($project_members,array("id" => $row['id'], "first_name" => $row['first_name'], "name" => $row['name']));

}

$page_title = "Modifier le projet";
$project_owner = array("id" => $_SESSION['id'], "first_name" => $_SESSION['first_name'], "name" => $_SESSION['name']);

$tab = "config";
include('templates/projectHeader.template.php');
include('templates/updateProject.template.php');
include('templates/footer.template.php');

?>
