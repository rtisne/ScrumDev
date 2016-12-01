<?php
include('config.php');
$idProject = intval($_GET['idProject']);
$idUser = $_SESSION['id'];
perform_query("DELETE FROM member_relations WHERE member = $idUser AND project = $idProject");
perform_query("UPDATE task JOIN user_story ON task.id_us = user_story.id SET implementer=null WHERE implementer=$idUser AND user_story.id_project=$idProject");
header("Location: " . get_base_url() . "index.php");


?>