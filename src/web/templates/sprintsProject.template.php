<?php
include("createSprint.template.php");
?>
<h2>Sprints<button type="button" class="pull-right btn btn-primary" data-toggle="modal" data-target="#createSprintmodal"><a href="#">Creer un nouveau sprint</a></button></h2>
<div class="panel panel-default">
    <table class="table table-bordered">
        <colgroup>
            <col class="col-xs-1">
            <col class="col-xs-11">
        </colgroup>
        <thead class="thead-backlog">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center"></th>
            </tr>
        </thead>

<?php
foreach ($sprints as $sprint) {
    ?>

        <tbody>
            <tr>
                <th scope="row" class="text-center"><?= $sprint['number']; ?></th>
                <td>
                    <div class="row sprint_item">
                        <div class="col-md-4 desc_sprint">
                            <div class="sprint_title"><a href="<?= get_base_url() . "kanban.php?id_project=" . intval($_GET['id_project']) . "&id_sprint=" . $sprint['id'];?>"><?= $sprint['title']; ?></a></div>
                            <div><?= print_US_progression_sprint($sprint['id']); ?></div>
                        </div>
                        <div class="col-md-3 col-md-offset-3">
                            <div class="row">
                                <div class="col-md-3">
                                    Début:
                                </div>
                                <div class="col-md-9 text-right">
                                    <?= $sprint['date_start']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Fin:
                                </div>
                                <div class="col-md-9 text-right">
                                    <?= $sprint['date_end']; ?>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-2 desc_sprint pull-right">
                                <a href="<?= get_base_url() . "deleteSprint.php?id_project=" . intval($_GET['id_project']) . "&id_sprint=" . $sprint['id'];?>" class="btn btn-primary btn-block" >Remove</a>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>

    <?php
}

?>

    </table>
</div>
