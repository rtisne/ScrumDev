<?php
if(!isset($_GET['id_sprint']))
    header("Location: " . get_base_url() . "index.php");
var_dump(intval($_GET['id_sprint']));
$sprint_infos = getSprintInfos(intval($_GET['id_sprint']));

/* A enlever des que l'insertion d'un sprint est ok
if($sprint_infos == NULL)
    header("Location: " . get_base_url() . "index.php");
*/
$sprint_name =  $sprint_infos['title'];
$sprint_id = $sprint_infos['id'];

$usersStorys = getSprintUS(intval($_GET['id_sprint']));



function getSprintUS($id_sprint) {
    $sql_query = "SELECT * FROM user_story JOIN user_story_in_sprint ON user_story.id = user_story_in_sprint.user_story WHERE user_story_in_sprint.sprint=$id_sprint";
    return fetch_all($sql_query);
}

?>
