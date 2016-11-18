<?php
if($isMember) {
    include("createTask.template.php");
    include("addUSToKanban.template.php");
}

?>
<h2 data-id="<?=intval($sprint_id);?>"><?=$sprint_name;?>
    <?php if($isMember): ?>
    <button type="button" class="pull-right btn btn-primary" data-toggle="modal" data-target="#createTaskmodal"><a href="#">Creer une nouvelle tâche</a></button>
    <?php endif; ?>
</h2>
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
            <?php
            foreach ($usersStorys as $us) {
                if($us['is_all']) {
                ?>
                    <tr id="all" data-id="<?=$us['id'];?>">
                        <th scope="row" class="text-center">ALL</th>
                        <td>
                            <?php foreach ($tasks as $task):?>
                            <?php if($task["id_us"] == $us['id'] && $task["state"] ==0): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading text-center">
                                    <?= $task['title']; ?> <?=(!empty($task['implementer']))? "<div class=\"name_implementer text-primary\">" . $task['first_name']. " ". $task['name'] ."</div>":"";?>
                                </div>
                                <div class="panel-body text-center">
                                    <?= $task['description']; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
            <?php
                }
            }

            foreach ($usersStorys as $us) {
                if(!$us['is_all']) {
                    ?>
                    <tr data-id="<?=$us['id'];?>">
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
            }


            ?>
            <?php if($isMember): ?>
            <tr class="addUSRow">
                <th class="text-center"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUSToKanbanmodal"><span class="glyphicon glyphicon-plus"></span></button></th>
                <td class="active"></td>
                <td class="active"></td>
                <td class="active"></td>
                <td class="active"></td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
