<?php
if(!isset($_GET['id_project']))
    header("Location: " . get_base_url() . "index.php");

$project_infos = getProjectInfos(intval($_GET['id_project']));
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
?>
