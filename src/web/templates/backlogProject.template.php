<?php
include("createUserStory.template.php");
include ("delete_user_story.template.php");
include ("edit_user_story.template.php");
?>
<h2>Backlog<button type="button" class="pull-right btn btn-primary" data-toggle="modal" data-target="#createUSmodal"><a href="#">Creer une UserStory</a></button></h2>
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
                <th class="text-center" colspan="2"> </th>

            </tr>
        </thead>

        <tbody> 
            <?php foreach ($user_stories as $story) : ?>
                <tr>

                    <td scope="row backlog_item" class="text-center"><?php echo $story["number"] ?></td> 
                    <td><?php echo $story["title"] ?></td> 
                    <td class="text-center"><?php echo $story["cost"] ?></td> 
                    <td class="text-center"><?php echo $story["priority"] ?></td> 
                    <td class="text-center"><?=  ($story["state"])? "Finie" : "En cours"; ?></td> 
                    <td class="text-center"><?php echo "" ?></td>
                    <td><button class="backlog_management btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit_user_story" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                    <td><button  data-id="<?php echo $story["id"] ?>"  class="delete_user_story_button backlog_management btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete_user_story" ><span class="glyphicon glyphicon-trash"></span></button></p></td>


                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

