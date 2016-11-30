<?php
include_once('config.php');
include_once('projectInfos.php');

$user_stories = array();

$tab="backlog";

if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit']) && ($_POST["submit"] == "create") && $isMember){
    project_backlog();

}

if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit']) && ($_POST["submit"] == "delete") && $isMember){
    project_backlog_item_delete();
}

if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['submit']) && ($_POST["submit"] == "update") && $isMember){
    project_backlog_item_update();
}




function project_backlog(){
    extract($_POST);
    if (!empty($title) &&
        !empty($description)) {

        $number_US = get_number_us(intval($_GET[GET_ID_PROJECT]));
        $number_US_Actual = intval($number_US["num"]) + 1;
        $safe_values = array("number" => $number_US_Actual, "title" => $title , "description" => $description, "is_all"  => 0, "state" => 0, "id_project" => intval($_GET[GET_ID_PROJECT]));
        if(!empty($cost)){
            $safe_values["cost"] = intval($cost);

        }
        if(!empty($priority)){
            $safe_values["priority"] = intval($priority);

        }

    add_user_story_in_db($safe_values);
    }

}



function delete_user_story_from_backlog_using_id($user_story_id){

    $sql_query = "";
    if(!user_story_has_empty_task($user_story_id)){
        $sql_query .= "DELETE FROM task  WHERE id_us = $user_story_id;";
    }
    if(!user_story_is_not_assigned_to_srpint($user_story_id)){
        $sql_query .= "DELETE FROM user_story_in_sprint WHERE user_story = $user_story_id ;";
    }
    if(!user_story_not_found($user_story_id)){
        $sql_query .= "DELETE FROM user_story WHERE id = $user_story_id;";
    }
    if(!empty($sql_query)){
        $GLOBALS["database"]->multi_query($sql_query);
    }
}

function user_story_not_found($user_story_id){
    $total_items = fetch_first("SELECT COUNT(*) as total FROM user_story WHERE id=$user_story_id")["total"];
    return (intval($total_items) == 0);
}

function user_story_has_empty_task($user_story_id){
    $total_items = fetch_first("SELECT COUNT(*) as total FROM task WHERE id_us=$user_story_id")["total"];
    return (intval($total_items) == 0);
}
function user_story_is_not_assigned_to_srpint($user_story_id){
    $total_items = fetch_first("SELECT COUNT(*) as total FROM user_story_in_sprint WHERE user_story=$user_story_id")["total"];
    return (intval($total_items) == 0);

}

function project_backlog_item_delete(){
    $user_story_id = $_POST["user_story_id"];
    if(!empty($user_story_id)){
            delete_user_story_from_backlog_using_id($user_story_id);
    }
    header("Refresh:0");

}


function project_backlog_item_update(){
    extract($_POST);
    if (!empty($title) &&
        !empty($user_story_id) &&
        !empty($description)) {
        $safe_values = array( "title" => $title , "description" => $description, "is_all"  => 0 , "id_project" => intval($_GET[GET_ID_PROJECT]));
        if(!empty($cost)){
            $safe_values["cost"] = intval($cost);

        }
        if(!empty($priority)){
            $safe_values["priority"] = intval($priority);
        }
        if(!empty($commit)){
            $safe_values["commit"] = $commit;
        }
        $safe_values["state"] = 1;
        if(empty($state)) {
            $safe_values["state"] = 0;
            $safe_values["commit"] = null;
        }
        update_user_story_in_db($safe_values);

    }
}

function update_user_story_in_db($values){
    $user_story_columns =  array_keys($values);
    $user_story_values = array_values($values);
    $user_story_values["id"] = $_POST["user_story_id"];
    execute_query(create_update_sql("user_story",$user_story_columns),$user_story_values);

}
function user_story_id_by_id($user_story_id){
    $sql_query = "SELECT user_story.id FROM user_story WHERE is_all = 0 AND user_story.id = $user_story_id ";
    return fetch_all($sql_query);
}

handle_backlog_pagination();

/**
 * @param int $page_limit
 */

function handle_backlog_pagination($page_limit = DEFAULT_PAGE_LIMIT ){
    // fetch GET parameters
    global $user_stories, $pagination_item;
    $project_id = $_GET[GET_ID_PROJECT];
    if(!isset($_GET[$pagination_item])){
        $page_number = 1;
    }
    else{
        $page_number = $_GET[$pagination_item];
    }
    if(!empty($page_number)){
        $id_project = intval($_GET[GET_ID_PROJECT]);
        $sql_query = "SELECT * FROM user_story WHERE is_all = 0 AND id_project = $id_project ORDER BY id ASC LIMIT $page_limit OFFSET ". (get_offset($page_number,$page_limit));
        $user_stories = fetch_all($sql_query);
        if(empty($user_stories)){
            return;
        }
        $total_items = fetch_first("SELECT COUNT(*) as total FROM user_story WHERE is_all = 0 AND id_project=$project_id")["total"];

        start_pagination(array("num_items_per_page" => $page_limit,"current_page_number" => $page_number , "items" => $user_stories, "total_items" => $total_items));

    }



}

function get_number_us($id_project){
  $sql_query = "SELECT COUNT(*) as num FROM user_story WHERE user_story.id_project=$id_project AND is_all = 0";
  return fetch_first($sql_query);
}

include("templates/projectHeader.template.php");
include("templates/backlogProject.template.php");
include("templates/pagination.template.php");
include("templates/footer.template.php");


?>
