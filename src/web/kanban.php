<?php
include_once('config.php');
include_once('projectInfos.php');

$allUsersStorys = getAllUsersStorys(intval($_GET['id_project']));
$usersStorys = getSprintUS(intval($_GET['id_sprint']));
$tasks = getTaskForSprint(intval($_GET['id_sprint']));
$developers = getDevelopers(intval($_GET['id_project']));


function getAllUsersStorys($id_project) {
    $sql_query = "SELECT * FROM user_story WHERE user_story.id_project=$id_project";
    return fetch_all($sql_query);
}

function getSprintUS($id_sprint) {
    $sql_query = "SELECT * FROM user_story WHERE user_story.id_sprint=$id_project";
    return fetch_all($sql_query);
}

function getTaskForSprint($id_sprint) {
    $sql_query = "SELECT * FROM task WHERE task.id_us=$id_sprint";
    return fetch_all($sql_query);
}

function getDevelopers($id_project) {
    return getProjectMembers();
}

$tab="sprints";

include("templates/projectHeader.template.php");
include("templates/kanban.template.php");
include("templates/footer.template.php");

?>
