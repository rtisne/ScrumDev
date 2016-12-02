<?php
include ('jpgraph/jpgraph.php');
include ('jpgraph/jpgraph_line.php');
include_once('config.php');

$id_project = intval($_GET['idProject']);


$res_attendu =  create_tab_res_attendu($id_project);
$res_real = create_tab_res_real($id_project);


//Création du tableau Label + mise en forme du tableau attendu
$nb_sprint =  get_number_sprint($id_project);
		
for ($i = 0; $i <= $nb_sprint['num']; $i++) 
		{
	    	$res_attendu_final[$i] = 0;	
		}

$i = 1;
foreach ($res_attendu as $k => $v) {

		$label_sprint[0] = "Initial";
		$res_attendu_final[0] = $res_attendu[0];
		
		if ($k > 0)
		{
    		$label = get_name_sprint($k);
    		$label_sprint[$i] = $label["title"];
    		$res_attendu_final[$i] = $res_attendu[$k];
    		$i = $i +1; 
		}
}


// Mise en forme du tableau real

$nb_sprint =  get_number_sprint($id_project);	
		
for ($i = 0; $i <= $nb_sprint['num']; $i++) 
		{
	    	$res_real_final[$i] = 0;
		}

$i = 1;
foreach ($res_real as $k => $v) {

		$res_real_final[0] = $res_real[0];
		
		if ($k > 0)
		{
    		$res_real_final[$i] = $res_real[$k];
    		$i = $i +1; 
		}
}




$graph = new Graph(500,450);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Burndown Chart');
$graph->SetBox(false);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);
$graph->yaxis->scale->SetAutoMin(0);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");

$graph->xaxis->SetTickLabels($label_sprint);

$graph->xgrid->SetColor('#E3E3E3');

// Create the first line
$p1 = new LinePlot($res_attendu_final);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend('résultat attendu');

// Create the second line
$p2 = new LinePlot($res_real_final);
$graph->Add($p2);
$p2->SetColor("#B22222");
$p2->SetLegend('résultat reel');


$graph->legend->SetFrameWeight(1);
// Output line
$graph->Stroke();



function get_number_sprint($id_project){
  $sql_query = "SELECT COUNT(*) as num FROM sprint WHERE sprint.id_project=$id_project ";
  return fetch_first($sql_query);
}

function get_sprint_with_id($id_project){
	$sql_query = "SELECT id FROM sprint WHERE sprint.id_project=$id_project";
	return fetch_all($sql_query);
}

function get_name_sprint($id_sprint){
  $sql_query = "SELECT title FROM sprint WHERE sprint.id=$id_sprint";
  return fetch_first($sql_query);
}

function get_total_effort_sprint($id_sprint){

  $sql_query = "SELECT SUM(user_story.cost) as effort  FROM user_story JOIN user_story_in_sprint ON user_story.id = user_story_in_sprint.user_story WHERE user_story_in_sprint.sprint=$id_sprint";
  $res = fetch_first($sql_query);
  return intval($res["effort"]);
}


function get_total_effort_project($id_project){

  $sql_query = "SELECT SUM(user_story.cost) as effort  FROM user_story WHERE user_story.id_project=$id_project";
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
	
	$tmp = get_sprint_with_id($id_project);
	//var_dump($tmp);
  	foreach ($tmp as $r) {

   		$res_attendu[$r["id"]] = 0;

	}

	$tmp = get_res_attendu($id_project);
  	foreach ($tmp as $r) {
  		if($r["first_sprint"] != null){
   		$res_attendu[$r["first_sprint"]] += $r["cost"];
   	}
	}

	$tmp = $res_attendu[0];

	foreach ($res_attendu as $k => $v) {
		if ($k > 0)
		{
    		$tmp = $tmp - $res_attendu[$k];
    		$res_attendu[$k] = $tmp;
    		/*$res_attendu[$k] = $tmp - $res_attendu[$k];
    		$tmp = $res_attendu[$k];*/
		}
	}
	return $res_attendu;
}

function create_tab_res_real($id_project)
{
	
	$res_real[0] = get_total_effort_project($id_project);
	
	$tmp = get_sprint_with_id($id_project);
	//var_dump($tmp);
	foreach ($tmp as $r) {

   		$res_real[$r["id"]] = 0;

	}

	$tmp = get_res_real($id_project);
	//var_dump($tmp);
  	foreach ($tmp as $r) {
  		if($r["first_sprint"] != null){
  			$res_real[$r["first_sprint"]] += $r["cost"];
  		}
   	

	}
	
	$tmp = $res_real[0];

	foreach ($res_real as $k => $v) {
		if ($k > 0)
		{
    		$tmp = $tmp - $res_real[$k];
    		$res_real[$k] = $tmp;

    		/*$res_real[$k] = $tmp - $res_real[$k];
    		$tmp = $res_real[$k];*/
		}
	}

	return $res_real;
}

?>