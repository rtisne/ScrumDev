<?php
include_once('config.php');

DeleteSprintinDB($_GET['id_sprint']);

header("Location: " . get_base_url() . "sprintsProject.php?id_project=". intval($_GET['id_project']). "&id_sprint=" .intval($_GET['id_sprint']));


function DeleteSprintinDB($id_sprint) {
    $sql_query = "DELETE FROM user_story_in_sprint WHERE user_story_in_sprint.sprint=$id_sprint";
    perform_query($sql_query);
    $sql_query = "DELETE FROM sprint WHERE sprint.id=$id_sprint";
    return perform_query($sql_query);

}

?>


