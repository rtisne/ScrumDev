<?php
include_once('config.php');
include_once('projectInfos.php');

$tab="graphs";

$id_project = intval($_GET[GET_ID_PROJECT]);


$res_attendu =  create_tab_res_attendu($id_project);
$res_real = create_tab_res_real($id_project);





var_dump($res_attendu);
var_dump($res_real);




include("templates/projectHeader.template.php");
//include("templates/homeProject.template.php");
include("templates/footer.template.php");










function get_number_sprint($id_project){
  $sql_query = "SELECT COUNT(*) as num FROM sprint WHERE sprint.id_project=$id_project ";
  return fetch_first($sql_query);
}

function get_total_effort_sprint($id_sprint){

  $sql_query = "SELECT SUM(user_story.cost) as effort  FROM user_story JOIN user_story_in_sprint ON user_story.id = user_story_in_sprint.user_story WHERE user_story_in_sprint.sprint=$id_sprint";
  $res = fetch_first($sql_query);
  return intval($res["effort"]);
}

function get_total_effort_project($id_project){

  $sql_query = "SELECT SUM(user_story.cost) as effort  FROM user_story JOIN user_story_in_sprint ON user_story.id = user_story_in_sprint.user_story JOIN sprint on user_story_in_sprint.sprint = sprint.id WHERE sprint.id_project=$id_project";
  $res = fetch_first($sql_query);
  return intval($res["effort"]);
}


function get_res_attendu($id_project)
{
$sql_query = "SELECT id, title, cost,(SELECT sprint 
                        FROM user_story_in_sprint 
                        JOIN sprint ON user_story_in_sprint.sprint = sprint.id 
                        WHERE user_story=us.id 
                        ORDER BY sprint.date_start LIMIT 1) as first_sprint 
FROM user_story as us 
WHERE id_project=$id_project AND number<>-1";

	return fetch_all($sql_query);
}

function get_res_real($id_project)
{
$sql_query = "SELECT id, title, cost,(SELECT sprint 
                        FROM user_story_in_sprint 
                        JOIN sprint ON user_story_in_sprint.sprint = sprint.id 
                        WHERE user_story=us.id ORDER BY sprint.date_start DESC LIMIT 1) as first_sprint 
FROM user_story as us 
WHERE id_project=$id_project AND number<>-1 AND state=1";

	return fetch_all($sql_query);
}





function create_tab_res_attendu($id_project)
{
	$res_attendu[0] = get_total_effort_project($id_project);

	$tmp = get_res_attendu($id_project);

  	foreach ($tmp as $r) {

   		$res_attendu[$r["first_sprint"]] += $r["cost"];

	}

	$tmp = $res_attendu[0];

	foreach ($res_attendu as $k => $v) {
		if ($k > 0)
		{
    	
    		$res_attendu[$k] = $tmp - $res_attendu[$k];
    		$tmp = $res_attendu[$k];
		}
	}

	return $res_attendu;
}

function create_tab_res_real($id_project)
{
	$res_real[0] = get_total_effort_project($id_project);

	$tmp = get_res_real($id_project);

  	foreach ($tmp as $r) {

   	$res_real[$r["first_sprint"]] += $r["cost"];

	}

	$tmp = $res_real[0];

	foreach ($res_real as $k => $v) {
		if ($k > 0)
		{
    	
    		$res_real[$k] = $tmp - $res_real[$k];
    		$tmp = $res_real[$k];
		}
	}
	return $res_real;
}


?>
