<?php
include_once("config.php");

if(isset($_SESSION['name']))
    header("Location: " . get_base_url() . "listProjects.php");
else
    header("Location: " . get_base_url() . "signin.php");
?>
