<?php
include("createUserStory.template.php");
?>
<h2>Backlog<button type="button" class="pull-right btn btn-primary" data-toggle="modal" data-target="#createUSmodal"><a href="#">Creer une UserStory</a></button></h2>
<div class="panel panel-default">
    <table class="table table-bordered">
        <colgroup>
            <col class="col-xs-1">
            <col class="col-xs-5">
            <col class="col-xs-1">
            <col class="col-xs-1">
            <col class="col-xs-2">
            <col class="col-xs-2">
        </colgroup>
        <thead class="thead-backlog">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nom</th>
                <th class="text-center">Coût</th>
                <th class="text-center">Priorité</th>
                <th class="text-center">Etat</th>
                <th class="text-center">Commit</th>
            </tr>
        </thead>

        <tbody> 
            <?php foreach ($user_stories as $story) : ?>
                <tr>
                    <td scope="row" class="text-center"><?php echo $story["number"] ?></td> 
                    <td><?php echo $story["title"] ?></td> 
                    <td class="text-center"><?php echo $story["cost"] ?></td> 
                    <td class="text-center"><?php echo $story["priority"] ?></td> 
                    <td class="text-center"><?=  ($story["state"])? "Finie" : "En cours"; ?></td> 
                    <td class="text-center"><?php echo "" ?></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>
