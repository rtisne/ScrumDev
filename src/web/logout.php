<?php
include('config.php');
session_destroy();
header("Location: " . get_base_url() . "index.php");
?>
