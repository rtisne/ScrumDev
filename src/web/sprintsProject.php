<?php
include('config.php');


if(isset($_POST['submit']))
    createSprint();

function createSprint() {
    extract($_POST);
    if (!empty($title) ) {
        
        $safe_values = array("title" => $title , "date_start"=>$date_start, "date_end"=>$date_end);
        //$safe_values = array("title" => "Sprint1" , "date_start"=>"2016-01-01", "date_end"=>"2016-01-15");

        var_dump($safe_values);
		//$sprint_id = add_sprint_in_db($safe_values);
		var_dump($sprint_id);
    }
}

function add_sprint_in_db($values){
    $sprint_columns =  array_keys($values);
    $sprint_values = array_values($values);
    return execute_query(create_insert_sql("sprint",$sprint_columns),$sprint_values);
}


$project_name = "The project name";
$tab="sprints";

include("templates/projectHeader.template.php");
include("templates/sprintsProject.template.php");
include("templates/footer.template.php");


function get_all_sprint($id){
    $sql_query = "SELECT * FROM sprint WHERE .id=$id ORDER BY project.title ASC";
    $arr = perform_query($sql_query);
	$rows = [];
	while($row = mysqli_fetch_array($arr))
	{
    	$rows[] = $row;
	}

    $sql_query = "SELECT * FROM project WHERE creator=$id ORDER BY project.title ASC";
    $arr = perform_query($sql_query);

    while($row = mysqli_fetch_array($arr))
	{
    	$rows[] = $row;
	}

    return $rows;
}

?>
