<div class="modal fade" tabindex="-1" role="dialog" id="updateTaskmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modifier une tâche</h4>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Titre de la tâche</label>
                        <input type="text" class="form-control" name="title" placeholder="Titre" id="update_form__task_title">
                    </div>
                    <div class="form-group">
                        <label for="detail" class="control-label">Detail</label>
                        <div>
                            <textarea class="form-control" rows="5" name="detail" placeholder="Detail" required="required"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="developpeur" class="control-label">Développeur</label>
                        <select class="form-control select_dev" name="develop">
                            <option disabled selected value> -- Selectionner un membre -- </option>
                            <?php
                            foreach ($developers as $developer) {
                                ?>
                                <option value="<?= $developer['id'] ?>"><?= $developer['first_name'] ?> <?= $developer['name'] ?></option>
                                <?php
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dev" class="control-label">Dépendences</label>
                        <div>
                            <ul class="list-group list_member">
                                <li class="list-group-item">
                                    <div class="dropdown dropdown-input">
                                        <select class="form-control select_task_dependency" name="tasks">
                                            <option disabled selected value> -- Selectionner une tâche -- </option>
                                            <?php
                                            foreach ($tasks as $task) {
                                                ?>
                                                <option value="<?= $task['id'];?>"><?= $task['title'];?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </li>
                                <!-- <li class="list-group-item" >Tâche 5 - lorem <a  class="pull-right remove_task"><span class="glyphicon glyphicon-remove"></span></a></li> -->
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
