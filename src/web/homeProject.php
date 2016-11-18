<?php
include_once('config.php');
include_once('projectInfos.php');

$tab="home";

$desc_project = get_description_project($_GET['id_project']);

$date_actual = date("Y-m-d");
$sprint = get_actual_sprint($_GET['id_project'],$date_actual);

$project_creator = get_creator_project($_GET['id_project']);
$product_owner = get_PO_project($_GET['id_project']);
$list_member = ListMember();




include("templates/projectHeader.template.php");
include("templates/homeProject.template.php");
include("templates/footer.template.php");

function ListMember() {

	$id_project = intval($_GET['id_project']);

    $res = get_all_member($id_project);

   	$res_f = [];
   	$i = 0;
   foreach ($res as $r) {
   			$res_f[$i] = array("name" => $r["name"],"first_name" => $r["first_name"],"email" => $r["email"]);
    		$i = $i +1;
	}
    return $res_f;
}

function get_all_member($id_project){
    $sql_query = "SELECT * FROM user INNER JOIN member_relations ON  user.id = member_relations.member WHERE member_relations.project='".$id_project."'";
		return fetch_all($sql_query);
}

function get_creator_project($id_project){
    $sql_query = "SELECT * FROM user JOIN project ON user.id = project.creator WHERE project.id=$id_project";
	return fetch_first($sql_query);
}

function get_PO_project($id_project){
    $sql_query = "SELECT * FROM user JOIN project ON user.id = project.product_owner WHERE project.id=$id_project";
	return fetch_first($sql_query);
}

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

