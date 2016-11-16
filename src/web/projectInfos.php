<?php
if(!isset($_GET['id_project']) && is_valid($_GET['id_project']))
    header("Location: " . get_base_url() . "index.php");

$project_ids = has_session_var("project_ids") ? get_session_var("project_ids") : array();
$project_id = $project_ids[$_GET['id_project']];
$project_infos = getProjectInfos(intval($project_id));
if($project_infos == NULL)
    header("Location: " . get_base_url() . "index.php");

$project_name =  $project_infos['title'];
$project_desc =  $project_infos['description'];
$product_owner_id =  $project_infos['product_owner'];

$isCreator = ($project_infos['creator'] == $_SESSION['id']);
$isProductOwner = ($project_infos['product_owner'] == $_SESSION['id']);
$isMember = ($project_infos['creator'] == $_SESSION['id']);

if(!$isCreator)
{
    $project_members_request = getProjectMembers(intval($_GET['id_project']));
    $project_members = array();
    while($row = $project_members_request->fetch_array())
        if($row['member'] == $_SESSION['id'] )
            $isMember = true;
}

function is_valid($project_id){
    global $project_ids;

    if(empty($project_ids))
        return false;
    return array_key_exists($project_id,$project_ids);
}


?>
