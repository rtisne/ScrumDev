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
    global $project_id;
    extract($_POST);

    if (!empty($title) &&
    !empty($description) &&
    !empty($number)&&
    !empty($kind) &&
    isset($project_id)
 ) {


    $safe_values = array("number" => intval($number), "title" => $title , "description" => $description, "is_all"  => intval($kind), "state" => 0, "id_project" => intval($project_id));


    if(!empty($cost))
        $safe_values["cost"] = intval($cost);
    if(!empty($priority))
        $safe_values["priority"] = intval($priority);

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

}


function backlog_user_stories_by_id($story_id){
    // TODO
}

handle_backlog_pagination();

/**
 * @param int $page_limit
 */

function handle_backlog_pagination($page_limit = PAGE_DEFAULT_LIMIT ){
    global $project_id;
    // fetch GET parameters
    global $user_stories, $pagination_item;
    if(!isset($_GET[$pagination_item]))
        $page_number = 1;
    else
        $page_number = $_GET[$pagination_item];

    if(!empty($page_number)){
        $sql_query = "SELECT * FROM user_story WHERE id_project=$project_id  ORDER BY id ASC LIMIT $page_limit OFFSET ". (get_offset($page_number,$page_limit));
        $user_stories = fetch_all($sql_query);
        start_pagination($sql_query,array("num_items_per_page" => $page_limit,"current_page_number" => $page_number , "items" => $user_stories));
    }

}


include("templates/projectHeader.template.php");
include("templates/backlogProject.template.php");
include("templates/pagination.template.php");
include("templates/footer.template.php");


?>
