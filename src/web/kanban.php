<?php
include_once('config.php');
include_once('projectInfos.php');
include_once('sprintInfos.php');

$allUsersStorys = getAllUsersStorys(intval($_GET['id_project']));
//$tasks = getTaskForSprint(intval($_GET['id_sprint']));
$developers = getDevelopers(intval($_GET['id_project']));


function getAllUsersStorys($id_project) {
    $sql_query = "SELECT * FROM user_story WHERE user_story.id_project=$id_project";
    return fetch_all($sql_query);
}


function getTaskForSprint($id_sprint) {
    $sql_query = "SELECT * FROM task WHERE task.id_us=$id_sprint";
    return fetch_all($sql_query);
}

function getDevelopers($id_project) {
    return getProjectMembers($id_project);
}

$tab="sprints";

include("templates/projectHeader.template.php");
include("templates/kanban.template.php");
include("templates/footer.template.php");

?>
