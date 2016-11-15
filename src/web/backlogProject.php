<?php
include_once('config.php');
include_once('projectInfos.php');

define("PAGE_DEFAULT_LIMIT", 5);


$user_stories = array();

$tab="backlog";

if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit']))
    project_backlog();


function project_backlog_user_stories(){
    $user_stories = backlog_user_stories();

    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? json_encode($user_stories) : $user_stories;
}

function project_backlog(){
    extract($_POST);
if (!empty($title) &&
    !empty($description) &&
    !empty($cost) &&
    !empty($priority)
 ) {
    $safe_values = array("title" => $title , "description"=>$description, "cost"=>intval($cost), "priority" =>intval($priority), "state" => 0, "num_sprint" => 1);
    add_user_story_in_db($safe_values);
    }

}

function init_backlog(){
    global $user_stories;
    $user_stories = project_backlog_user_stories();
}

/**
 * @param array $values
 */

function add_user_story_in_db($values){
    $user_story_columns =  array_keys($values);
    $user_story_values = array_values($values);
    execute_query(create_insert_sql("user_story",$user_story_columns),$user_story_values);

}

function backlog_user_stories_by_project_id($project_id){
    // TODO
    $sql_query = "";
    return fetch_all($sql_query);
}


function backlog_user_stories_by_backlog_id(){
    // TODO
}
handle_backlog_pagination();

/**
 * @param int $page_limit
 */

function handle_backlog_pagination($page_limit = PAGE_DEFAULT_LIMIT ){
    // fetch GET parameters
    global $user_stories, $pagination_item;
    if(!isset($_GET[$pagination_item]))
        $page_number = 1;
    else
        $page_number = $_GET[$pagination_item];

    if(!empty($page_number)){
        $sql_query = "SELECT * FROM user_story ORDER BY id ASC LIMIT $page_limit OFFSET ". (get_offset($page_number,$page_limit));
        $user_stories = fetch_all($sql_query);
        start_pagination($sql_query,array("num_items_per_page" => $page_limit,"current_page_number" => $page_number , "items" => $user_stories));
    }

}


include("templates/projectHeader.template.php");
include("templates/backlogProject.template.php");
include("templates/pagination.template.php");
include("templates/footer.template.php");


?>
