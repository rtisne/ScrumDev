<?php
include_once('config.php');
include_once('projectInfos.php');


$tab="graphs";

include("templates/projectHeader.template.php");

$id_project = intval($_GET[GET_ID_PROJECT]);

$nb_sprint = get_number_sprint($id_project);

if($nb_sprint["num"] <= 1)
{
  echo "<p> Vous n'avez qu'un seul sprint, affichage du graphique impossible </p>";
}
else
{
  include("templates/graphProject.template.php");
}


include("templates/footer.template.php");



function get_number_sprint($id_project){
  $sql_query = "SELECT COUNT(*) as num FROM sprint WHERE sprint.id_project=$id_project ";
  return fetch_first($sql_query);
}

?>
