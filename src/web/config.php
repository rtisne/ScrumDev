<?php
session_start();
$GLOBALS['base'] = dirname(__FILE__);

// Load database variables
require($GLOBALS['base'] . "/databaseConfig.php");
require($GLOBALS['base'] . "/database.php");
require($GLOBALS['base'] . "/helpers/checker.php");
require($GLOBALS['base'] . "/path.php");

db_connect($GLOBALS['database'], false);

?>
