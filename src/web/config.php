<?php
$GLOBALS['base'] = dirname(__FILE__);

// Load database variables
require($GLOBALS['base'] . "/databaseConfig.php");
require($GLOBALS['base'] . "/database.php");
require($GLOBALS['base'] . "/helpers/session_manager.php");
require($GLOBALS['base'] . "/helpers/user_manager.php");
require($GLOBALS['base'] . "/path.php");

db_connect($GLOBALS['database'], false);
start_session();

?>
