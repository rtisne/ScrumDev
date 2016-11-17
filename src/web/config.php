<?php
$GLOBALS['base'] = dirname(__FILE__);

// Load database variables
require($GLOBALS['base'] . "/database_config.php");
require($GLOBALS['base'] . "/security_config.php");
require($GLOBALS['base'] . "/database.php");
require($GLOBALS['base'] . "/helpers/session_manager.php");
require($GLOBALS['base'] . "/helpers/user_manager.php");
require($GLOBALS['base'] . "/helpers/crypto_manager.php");
require($GLOBALS['base'] . "/helpers/timer.php");
require($GLOBALS['base'] . "/helpers/token_generator.php");
require($GLOBALS['base'] . "/helpers/csrf_token_manager.php");
require($GLOBALS['base'] . "/helpers/pagination_helper.php");

require($GLOBALS['base'] . "/path.php");

db_connect($GLOBALS['database'], false);
start_session();

?>
