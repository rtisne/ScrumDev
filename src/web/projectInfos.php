<?php
if(!isset($_GET[GET_ID_PROJECT])){
    header("Location: " . get_base_url() . "index.php");
}

$project_infos = getProjectInfos(intval($_GET[GET_ID_PROJECT]));
if($project_infos == NULL){
    header("Location: " . get_base_url() . "index.php");
}

$project_name =  $project_infos['title'];
$project_desc =  $project_infos['description'];
$product_owner_id =  $project_infos['product_owner'];
$project_creator = $project_infos['creator'];

if(!isset($_SESSION['id'])) {
    $isCreator = null;
    $isProductOwner = null;
    $isMember = null;

} else {
    $isCreator = ($project_creator == $_SESSION['id']);
    $isProductOwner = ($product_owner_id == $_SESSION['id']);
    $isMember = ($project_creator == $_SESSION['id']);

    if(!$isCreator)
    {
        $project_members_request = getProjectMembers(intval($_GET[GET_ID_PROJECT]));
        $project_members = array();
        while($row = $project_members_request->fetch_array()){
            if($row['id'] == $_SESSION['id'] ){
                $isMember = true;
            }
        }

    }
}

?>
