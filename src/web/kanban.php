<?php
include_once('config.php');
include_once('projectInfos.php');
include_once('sprintInfos.php');


if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit']) && ($_POST["submit"] == "create") && $isMember){
    createTask();

}
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit']) && ($_POST["submit"] == "delete") && $isMember){
    deleteTask();

}
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit']) && ($_POST["submit"] == "update") && $isMember){
    updateTask();
}


if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit']) && ($_POST["submit"] == "stories_states") && $isMember){
    get_stories_state();
}

if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit']) && ($_POST["submit"] == "stories_change_states") && $isMember){
    update_task_state();
}


function createTask() {
    extract($_POST);
    if (!empty($title) && !empty($detail)) {
        $safe_values = array("title" => $title , "description"=>$detail, "state"=>0, "id_us"=>intval(getAllID(intval($_GET['id_sprint']))['id']));
        if(!empty($develop)){
            $safe_values["implementer"] = $develop;
        }
		$task_id = add_task_in_db($safe_values);

        if(isset($_POST['tasks'])){
            $task_already_in = array();
            foreach( $_POST['tasks'] as $m ) {
                if(!in_array($m, $task_already_in)) {
                    $values = array("task" => intval($task_id) , "depend_to"=>intval($m));
                    add_task_dependency($values);
                    array_push($task_already_in,$m);
                }
            }
        }
        header("Refresh:0");
    }
}

function updateTask(){
    extract($_POST);
    if (!empty($title) &&
        !empty($detail)) {
        $safe_values = array("title" => $title , "description"=>$detail, "state"=>0, "id_us"=>intval(getAllID(intval($_GET['id_sprint']))['id']));
        if(!empty($develop)){
            $safe_values["implementer"] = $develop;
        }
        update_task_in_db($safe_values);
        remove_dependencies(intval($_POST["task_id"]));
        if(isset($_POST['tasks'])){
            $task_already_in = array();
            foreach( $_POST['tasks'] as $m ) {
                if(!in_array($m, $task_already_in)) {
                    $values = array("task" => intval($task_id) , "depend_to"=>intval($m));
                    add_task_dependency($values);
                    array_push($task_already_in,$m);
                }
            }
        }
        header("Refresh:0");
    }
}

function update_task_in_db($values){
    $task_columns =  array_keys($values);
    $task_values = array_values($values);
    $task_values["id"] = isset($_POST["task_id"])?$_POST["task_id"]:$_POST["id"];

    execute_query(create_update_sql("task",$task_columns),$task_values);

}

function remove_dependencies($task_id){
    $sql_query = "DELETE FROM task_dependency WHERE task='".$task_id."'";
    return perform_query($sql_query);
}

function deleteTask(){
    $task_id = intval($_POST["task_id"]);
    $sql_query = "DELETE FROM task_dependency WHERE task='".$task_id."' OR depend_to='".$task_id."'";
    $arr = perform_query($sql_query);
    $sql_query = "DELETE FROM task WHERE id='".$task_id."'";
    $arr = perform_query($sql_query);
    header("Refresh:0");
}

function add_task_in_db($values){
    $task_columns =  array_keys($values);
    $task_values = array_values($values);
    return execute_query(create_insert_sql("task",$task_columns),$task_values);
}


$ids_us = array();
foreach ($usersStorys as $userstory) {
    array_push($ids_us, intval($userstory['id']));
}
$allUsersStorys = getAllUsersStorys(intval($_GET[GET_ID_PROJECT]));
$tasks = getTaskForSprint($ids_us);
$developers = getDevelopers(intval($_GET[GET_ID_PROJECT]));
$result = getCreator(intval($_GET[GET_ID_PROJECT]));
$creator = array_shift($result);
array_push($developers, $creator);

function getAllUsersStorys($id_project) {
    $sql_query = "SELECT * FROM user_story WHERE user_story.id_project=$id_project";
    return fetch_all($sql_query);
}

function getTaskForSprint($ids_sprints) {
    $ids = join(",",$ids_sprints);
    $sql_query = "SELECT task.id, task.title, task.description, task.state, task.id_us, task.implementer, user.name, user.first_name, GROUP_CONCAT(depend_to) as dependencies FROM task LEFT JOIN user ON task.implementer = user.id LEFT JOIN task_dependency ON task.id = task_dependency.task WHERE task.id_us IN ($ids) GROUP BY task.id";
    return fetch_all($sql_query);
}

function getDevelopers($id_project){
    $sql_query = "SELECT user.id, user.name, user.first_name FROM user INNER JOIN member_relations ON  user.id = member_relations.member WHERE member_relations.project='".$id_project."'";
    return fetch_all($sql_query);
}

function getCreator($id_project) {
    $sql_query = "SELECT user.id, user.name, user.first_name FROM user JOIN project on user.id=project.creator WHERE project.id=$id_project";
    return fetch_all($sql_query);
}

function getAllID($id_sprint){
    $sql_query = "SELECT user_story.id FROM user_story JOIN user_story_in_sprint on user_story.id = user_story_in_sprint.user_story WHERE user_story.is_all = 1 AND user_story_in_sprint.sprint = ". $id_sprint."";
    return fetch_first($sql_query);
}

function add_task_dependency($values) {
    $task_dependency_columns =  array_keys($values);
    $task_dependency_values = array_values($values);
    return execute_query(create_insert_sql("task_dependency",$task_dependency_columns),$task_dependency_values);
}

function get_stories_state(){
    $sql_query = "";
    header('Content-Type: application/json');
    print json_encode($data);
}

function update_task_state(){
    $state = $_POST["state"];
    $user_story = $_POST["user_story_id"];
    $valid_state = ["TODO","DOING","TESTING","DONE"];

    if(!empty($state)  && in_array($state,$valid_state)){
        $safe_values = ["state" => array_search($state,$valid_state) , "id_us" => $user_story]; // assume that $valid_state does not contains duplicate items
        update_task_in_db($safe_values);
    }
    if(user_story_has_done($user_story)){
        perform_query("UPDATE user_story SET state=1 WHERE id=$user_story");

    }
}

function user_story_has_done($user_story_id){
    $sql_query = "SELECT state from task WHERE id_us = $user_story_id";
    $all_state = fetch_all($sql_query);
    foreach($all_state as $state){
        if($state["state"] != 3){
            return false;
        }
    }
    return true;
}

function get_last_time(){
}
$tab="sprints";

include("templates/projectHeader.template.php");
include("templates/kanban.template.php");
include("templates/footer.template.php");

?>
