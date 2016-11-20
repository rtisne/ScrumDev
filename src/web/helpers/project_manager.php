<?php

define("GET_ID_PROJECT", "id_project");

function get_all_project_items($id){
    $sql_query = "SELECT * FROM project JOIN member_relations ON project.id = member_relations.project
    				JOIN user ON member_relations.member = user.id WHERE user.id=$id ORDER BY project.title ASC";
    $arr = perform_query($sql_query);
    $rows = [];
    while($row = mysqli_fetch_array($arr))
    {
        $rows[] = $row;
    }

    $sql_query = "SELECT * FROM project WHERE creator=$id ORDER BY project.title ASC";
    $arr = perform_query($sql_query);

    while($row = mysqli_fetch_array($arr))
    {
        $rows[] = $row;
    }

    return $rows;
}

function get_all_sprint_items($project_id) {
    $sql_query = "SELECT * FROM sprint WHERE sprint.id_project=$project_id ORDER BY sprint.date_start ASC";
    $res = fetch_all($sql_query);
    $res_f = [];
    $i = 0;
    foreach ($res as $r) {
        $res_f[$i] = array("sprint_id" => $r["id"], "id" => $r["number"],"title" => $r["title"],'date_start' => $r["date_start"] ,"date_end" => $r["date_end"]);
        $i = $i +1;
    }
    return $res_f;
}