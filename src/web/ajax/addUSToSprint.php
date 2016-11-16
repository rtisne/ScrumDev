<?php
include("../config.php");
if(isset($_GET['idUS']) && isset($_GET['idSprint'])){

    if(getSprintUS(intval($_GET['idSprint']),intval($_GET['idUS'])) == null) {
        $safe_values = array("user_story" => intval($_GET['idUS']) , "sprint"=>intval($_GET['idSprint']));
        print add_user_story_to_sprint_in_db($safe_values);
    }
    else
        print "-1";
    //$search_sql = "SELECT * FROM task WHERE id_us=".intval($_GET['idUS']);
    //print query_to_json($search_sql);
}

function add_user_story_to_sprint_in_db($values){
    $user_story_columns =  array_keys($values);
    $user_story_values = array_values($values);
    return execute_query(create_insert_sql("user_story_in_sprint",$user_story_columns),$user_story_values);

}

function getSprintUS($id_sprint, $id_us) {
    $sql_query = "SELECT * FROM user_story JOIN user_story_in_sprint ON user_story.id = user_story_in_sprint.user_story WHERE user_story_in_sprint.sprint=$id_sprint AND user_story_in_sprint.user_story=$id_us";
    return fetch_all($sql_query);
}
?>
