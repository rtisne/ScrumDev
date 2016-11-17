<?php
include_once('config.php');
include_once('projectInfos.php');

define("PAGE_DEFAULT_LIMIT", 20);


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
        !empty($description)) {

        $number_US = get_number_us(intval($_GET['id_project']));
        $number_US_Actual = intval($number_US["num"]) + 1;
        $safe_values = array("number" => $number_US_Actual, "title" => $title , "description" => $description, "is_all"  => 0, "state" => 0, "id_project" => intval($_GET['id_project']));
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
        $id_project = intval($_GET['id_project']);
        $sql_query = "SELECT * FROM user_story WHERE is_all = 0 AND id_project = $id_project ORDER BY id ASC LIMIT $page_limit OFFSET ". (get_offset($page_number,$page_limit));
        $user_stories = fetch_all($sql_query);
        start_pagination($sql_query,array("num_items_per_page" => $page_limit,"current_page_number" => $page_number , "items" => $user_stories));
    }

}

function get_number_us($id_project){
  $sql_query = "SELECT COUNT(*) as num FROM user_story WHERE user_story.id_project=$id_project ";
  return fetch_first($sql_query);
}

include("templates/projectHeader.template.php");
include("templates/backlogProject.template.php");
include("templates/pagination.template.php");
include("templates/footer.template.php");


?>
