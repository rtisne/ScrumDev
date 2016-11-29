<?php
include_once('config.php');
include_once('projectInfos.php');


$tab="graphs";

include("templates/projectHeader.template.php");

$id_project = intval($_GET[GET_ID_PROJECT]);



include("templates/graphProject.template.php");
include("templates/footer.template.php");





?>
