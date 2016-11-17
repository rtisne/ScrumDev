<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scrumify</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
</head>
<body>
<?php include('navbar.template.php');?>
<div class="home_container col-md-12">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="project_name">
                <strong class="name"> <?= $project_name; ?></strong>
            </h1>
        </div>
    </div>
    <ul class="nav nav-tabs project_tab">
        <li <?= ($tab=="home")?"class=\"active\"":"";?>><a href="<?= get_base_url() . "homeProject.php?id_project=" . $_GET['id_project']?>"><span class="glyphicon glyphicon-home"></span>  Home</a></li>
        <li <?= ($tab=="backlog")?"class=\"active\"":"";?>><a href="<?= get_base_url() . "backlogProject.php?id_project=" . $_GET['id_project']?>"><span class="glyphicon glyphicon-list-alt"></span>  Backlog</a></li>
        <li <?= ($tab=="sprints")?"class=\"active\"":"";?>><a href="<?= get_base_url() . "sprintsProject.php?id_project=" . $_GET['id_project']?>"><span class="glyphicon glyphicon-calendar"></span>  Sprints</a></li>
        <li <?= ($tab=="graphs")?"class=\"active\"":"";?>><a href="#"><span class="glyphicon glyphicon-stats"></span>  Graphs</a></li>
        <?php if($isCreator){?><li <?= ($tab=="config")?"class=\"active\"":"";?>><a href="<?= get_base_url() . "updateProject.php?id_project=" . $_GET['id_project']?>"><span class="glyphicon glyphicon-cog"></span>  Configuration</a></li><?php } ?>
    </ul>
</div>
<div class="container project_container col-md-8 col-md-offset-2">