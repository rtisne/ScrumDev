<?php
include("createUserStory.template.php");
?>
<h2>Backlog<button type="button" class="pull-right btn btn-primary" data-toggle="modal" data-target="#createUSmodal"><a href="#">Creer une UserStory</a></button></h2>
<div class="row">
     <div class="col-sm-12">

    <table class="table table-bordered">
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
            <td scope="row" class="text-center"><?php echo $story["title"] ?></td> 
            <td><?php echo $story["description"] ?></td> 
            <td class="text-center"><?php echo $story["cost"] ?></td> 
            <td class="text-center"><?php echo $story["priority"] ?></td> 
            <td class="text-center"><?php echo  $story["state"] ?></td> 
            <td class="text-center"><?php echo "" ?></td>
        </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
    </div>
</div>
