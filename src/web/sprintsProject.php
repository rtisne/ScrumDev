<?php
include_once('config.php');
include_once('projectInfos.php');

$sprints = ListSprints();


if(isset($_POST['submit']) && $isMember)
    createSprint();



function createSprint() {
    extract($_POST);
    if (!empty($title) ) {

        $number_Sprint = get_number_sprint(intval($_GET['id_project']));
        $number_Sprint_Actual = intval($number_Sprint["num"]) + 1;
        $safe_values = array("number" => $number_Sprint_Actual, "title" => $title , "date_start"=>$date_start, "date_end"=>$date_end, "id_project"=>intval($_GET['id_project']));
		$sprint_id = add_sprint_in_db($safe_values);

        //Create the ALL userstory container for the sprint
        $safe_values = array("number" => -1, "title" => "ALL" , "description" => "", "is_all"  => 1, "state" => 0, "id_project" => intval($_GET['id_project']));
        $us_id = add_user_story_in_db($safe_values);
        $safe_values = array("user_story" => intval($us_id) , "sprint"=>intval($sprint_id));
        add_user_story_to_sprint_in_db($safe_values);

        $kanbanUrl = get_base_url() . "kanban.php?id_project=" . intval($_GET['id_project']) . "&id_sprint=" . $sprint_id;
        header("Location: " . $kanbanUrl);
    }
}

function ListSprints() {

	$id_project = intval($_GET['id_project']);

    $res = get_all_sprint($id_project);

   	$res_f = [];
   	$i = 0;
   foreach ($res as $r) {
   			$res_f[$i] = array("id" => $r["id"],"number" => $r["number"],"title" => $r["title"],'date_start' => $r["date_start"] ,"date_end" => $r["date_end"]);
    		$i = $i +1;
	}
    return $res_f;
}

function add_sprint_in_db($values){
    $sprint_columns =  array_keys($values);
    $sprint_values = array_values($values);
    return execute_query(create_insert_sql("sprint",$sprint_columns),$sprint_values);
}

$tab="sprints";

include("templates/projectHeader.template.php");
include("templates/sprintsProject.template.php");
include("templates/footer.template.php");


function get_all_sprint($id_project){
    $sql_query = "SELECT * FROM sprint WHERE sprint.id_project=$id_project ORDER BY sprint.number ASC";
    return fetch_all($sql_query);
}

function get_number_sprint($id_project){
  $sql_query = "SELECT COUNT(*) as num FROM sprint WHERE sprint.id_project=$id_project ";
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
