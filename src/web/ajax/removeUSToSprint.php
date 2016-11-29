<?php
include("../config.php");
if(isset($_GET['idUS']) && isset($_GET['idSprint'])){

    if(getSprintUS(intval($_GET['idUS']), intval($_GET['idSprint'])) != null) {
        print remove_user_story_to_sprint_in_db(intval($_GET['idUS']), intval($_GET['idSprint']));
    }
    else
        print "-1";
}

function remove_user_story_to_sprint_in_db($id_us, $id_sprint){
    return perform_query("DELETE FROM user_story_in_sprint WHERE user_story_in_sprint.user_story=$id_us && user_story_in_sprint.sprint=$id_sprint");

}

function getSprintUS($id_us, $id_sprint) {
    $sql_query = "SELECT * FROM user_story_in_sprint WHERE user_story_in_sprint.user_story=$id_us && user_story_in_sprint.sprint=$id_sprint";
    return fetch_all($sql_query);
}
?>
