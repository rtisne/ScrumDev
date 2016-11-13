<div class="modal fade" tabindex="-1" role="dialog" id="createTaskmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Creer une tâche</h4>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Titre de la tâche</label>
                        <input type="text" class="form-control" id="title" placeholder="Titre">
                    </div>
                    <div class="form-group">
                        <label for="detail" class="control-label">Detail</label>
                        <div>
                            <textarea class="form-control" rows="5" name="detail" placeholder="Detail" required="required"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="developpeur" class="control-label">Développeur</label>
                        <select class="form-control select_po" name="product_owner">
                            <option value="lala">Romain TISNE</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dev" class="control-label">Dépendences</label>
                        <div>
                            <ul class="list-group list_member">
                                <li class="list-group-item">
                                    <div class="dropdown dropdown-input">
                                        <select class="form-control select_po" name="product_owner">
                                            <option value="lala">Tâche 2 - Faire la base de données</option>
                                            <option value="lala">Tâche 1 - Faire les templates des pages</option>
                                        </select>
                                    </div>
                                </li>
                                <li class="list-group-item">Tache 3 - Faire ca et ca</li>
                                <li class="list-group-item" >Tâche 5 - lorem <a  class="pull-right remove_task"><span class="glyphicon glyphicon-remove"></span></a></li>
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
