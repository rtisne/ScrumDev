<?php
include('config.php');

if(!isset($_SESSION['id']))
    header("Location: " . get_base_url() . "/index.php");


include("templates/header.template.php");
$projects = ListProject();
include("templates/listProjects.template.php");
include("templates/footer.template.php");

function ListProject() {

	$id_user = $_SESSION['id'];
    
    $res = get_all_project($id_user);

   	$res_f = [];
   	$i = 0;
   foreach ($res as $r) {
    	
    	if( $r[2] == $id_user)
    	{
    		$res_f[$i] = array("link" => "google.com","title" => $r[0],'isEditable' => true ,"description" => $r[1]);	
    	}
    	else
    	{
   			$res_f[$i] = array("link" => "google.com","title" => $r[0],'isEditable' => false ,"description" => $r[1]);
   		}

   		$i = $i +1;
	}
    return $res_f; 
}


function get_all_project($id){
    $sql_query = "SELECT title,description,creator FROM project JOIN member_relations ON project.id = member_relations.project
    				JOIN user ON member_relations.member = user.id WHERE user.id=$id ORDER BY project.title ASC";
    $arr = perform_query($sql_query);
	$rows = [];
	while($row = mysqli_fetch_array($arr))
	{
    	$rows[] = $row;
	}
    return $rows;
}

?>
