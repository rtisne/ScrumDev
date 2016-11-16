<?php
include("createTask.template.php");
include("addUSToKanban.template.php");
?>
<h2 data-id="<?=intval($sprint_id);?>"><?=$sprint_name;?><button type="button" class="pull-right btn btn-primary" data-toggle="modal" data-target="#createTaskmodal"><a href="#">Creer une nouvelle tâche</a></button></h2>
<div class="panel panel-default">
    <table class="table table-bordered kanban">
        <colgroup>
            <col class="col-xs-1">
            <col class="col-xs-2">
            <col class="col-xs-2">
            <col class="col-xs-2">
            <col class="col-xs-2">
        </colgroup>
        <thead>
            <tr class="bg-primary">
                <th class="text-center">#US</th>
                <th class="text-center">TODO</th>
                <th class="text-center">DOING</th>
                <th class="text-center">TESTING</th>
                <th class="text-center">DONE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row" class="text-center">ALL</th>
                <td>
                    <!-- <div class="panel panel-default">
                        <div class="panel-heading text-center">Titre de la tâche fezfez fezfezfezfez fez fez</div>
                        <div class="panel-body text-center">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </div>
                    </div> -->
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php
            foreach ($usersStorys as $us) {
                ?>
                <tr>
                    <th scope="row" class="text-center">
                        <div class="popover-markup">
                             <a class="trigger">US#<?=$us['number'];?></a>
                             <div class="content hide">
                                <div class="form-group">
                                    <p><?=$us['title'];?></p>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block" id="removeUS" data-id="<?=$us['id'];?>">
                                    Remove
                                </button>
                            </div>

                        </div>
                    </th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <?php
            }


            ?>
            <tr class="addUSRow">
                <th class="text-center"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUSToKanbanmodal"><span class="glyphicon glyphicon-plus"></span></button></th>
                <td class="active"></td>
                <td class="active"></td>
                <td class="active"></td>
                <td class="active"></td>
            </tr>
        </tbody>
    </table>
</div>
