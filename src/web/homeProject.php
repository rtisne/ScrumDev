<?php
include_once('config.php');
include_once('projectInfos.php');

$tab="home";

$desc_project = get_description_project($_GET['id_project']);

$date_actual = date("Y-m-d");
$sprint = get_actual_sprint($_GET['id_project'],$date_actual);





include("templates/projectHeader.template.php");
include("templates/homeProject.template.php");
include("templates/footer.template.php");




function get_description_project($id_project){
    $sql_query = "SELECT description FROM project WHERE project.id=$id_project";
	return fetch_first($sql_query);
}


function get_actual_sprint($id_project, $date){
    $sql_query = "SELECT * FROM sprint WHERE sprint.id_project=$id_project AND sprint.date_start <= '$date' AND sprint.date_end >= '$date'";
    return fetch_first($sql_query);
}



function get_nb_US($id_sprint){

  $sql_query = "SELECT COUNT(*) as num  FROM user_story JOIN user_story_in_sprint ON user_story.id = user_story_in_sprint.user_story WHERE user_story_in_sprint.sprint=$id_sprint";
  $res = fetch_first($sql_query);
  return intval($res["num"]);

}

function get_nb_US_down($id_sprint){

  $sql_query = "SELECT COUNT(*) as num  FROM user_story JOIN user_story_in_sprint ON user_story.id = user_story_in_sprint.user_story WHERE user_story_in_sprint.sprint=$id_sprint AND user_story.state = 1";
  $res = fetch_first($sql_query);
  return intval($res["num"]);
}


function print_US_progression_sprint($id_sprint)
{
  return get_nb_US_down($id_sprint)."/".get_nb_US($id_sprint)." US finies";
}

?>

