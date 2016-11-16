<?php
include("../config.php");
if(isset($_GET['idRelation'])){

    if(getSprintUS(intval($_GET['idRelation'])) != null) {
        print remove_user_story_to_sprint_in_db(intval($_GET['idRelation']));
    }
    else
        print "-1";
}

function remove_user_story_to_sprint_in_db($id_relation){
    return perform_query("DELETE FROM user_story_in_sprint WHERE id = $id_relation");

}

function getSprintUS($id_relation) {
    $sql_query = "SELECT * FROM user_story_in_sprint WHERE user_story_in_sprint.id=$id_relation";
    return fetch_all($sql_query);
}
?>
