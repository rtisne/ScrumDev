<?php
include_once('config.php');
include_once('projectInfos.php');

$sprints = ListSprints();

if(isset($_POST['submit']) && $isMember)
    createSprint();

function createSprint() {
    extract($_POST);
    if (!empty($title) ) {

        $safe_values = array("title" => $title , "date_start"=>$date_start, "date_end"=>$date_end, "id_project"=>intval($_GET['id_project']));
		$sprint_id = add_sprint_in_db($safe_values);
        $kanbanUrl = get_base_url() . "kanban.php?id_project=" . intval($_GET['id_project']) . "&ampid_sprint=" . $sprint_id;
        header("Location: " . $kanbanUrl);
    }
}

function ListSprints() {

	$id_project = intval($_GET['id_project']);

    $res = get_all_sprint($id_project);

   	$res_f = [];
   	$i = 0;
   foreach ($res as $r) {

   			$res_f[$i] = array("id" => $r[0],"title" => $r[1],'date_start' => $r[2] ,"date_end" => $r[3]);
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
    $sql_query = "SELECT * FROM sprint WHERE sprint.id_project=$id_project ORDER BY sprint.date_start ASC";
    $arr = perform_query($sql_query);
	$rows = [];
	while($row = mysqli_fetch_array($arr))
	{
    	$rows[] = $row;
	}

    return $rows;
}

?>
