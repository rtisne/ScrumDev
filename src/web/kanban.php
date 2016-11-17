<?php
include_once('config.php');
include_once('projectInfos.php');
include_once('sprintInfos.php');


if(isset($_POST) && $isMember)
    createTask();

function createTask() {
    extract($_POST);
    if (!empty($title) && !empty($detail)) {
        $safe_values = array("title" => $title , "description"=>$detail, "state"=>0, "id_us"=>intval(getAllID(intval($_GET['id_sprint']))['id']));
        if(!empty($develop))
            $safe_values["implementer"] = $develop;
		$task_id = add_task_in_db($safe_values);

        if(isset($_POST['tasks'])){
            foreach( $_POST['tasks'] as $m ) {
                $values = array("task" => intval($task_id) , "depend_to"=>intval($m));
                add_task_dependency($values);
            }
        }

        $kanbanUrl = get_base_url() . "kanban.php?id_project=" . intval($_GET['id_project']) . "&id_sprint=" . intval($_GET['id_sprint']);
        header("Location: " . $kanbanUrl);
    }
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
$allUsersStorys = getAllUsersStorys(intval($_GET['id_project']));
$tasks = getTaskForSprint($ids_us);
$developers = getDevelopers(intval($_GET['id_project']));
$result = getCreator(intval($_GET['id_project']));
$creator = array_shift($result);
array_push($developers, $creator);

function getAllUsersStorys($id_project) {
    $sql_query = "SELECT * FROM user_story WHERE user_story.id_project=$id_project";
    return fetch_all($sql_query);
}

function getTaskForSprint($ids_sprints) {
    $ids = join(",",$ids_sprints);
    $sql_query = "SELECT task.id, task.title, task.description, task.state, task.id_us, task.implementer, user.name, user.first_name FROM task LEFT JOIN user ON task.implementer = user.id WHERE task.id_us IN ($ids)";
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
    $arr = fetch_first($sql_query);
    return $arr;
}

function add_task_dependency($values) {
    $task_dependency_columns =  array_keys($values);
    $task_dependency_values = array_values($values);
    return execute_query(create_insert_sql("task_dependency",$task_dependency_columns),$task_dependency_values);
}

$tab="sprints";

include("templates/projectHeader.template.php");
include("templates/kanban.template.php");
include("templates/footer.template.php");

?>
