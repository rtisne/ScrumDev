
<div class="modal fade" tabindex="-1" role="dialog" id="addUSToKanbanmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ajouter une user story</h4>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="developpeur" class="control-label">Liste des US</label>
                        <select class="form-control select_po" name="product_owner">
                            <?php foreach ($allUsersStorys as $userStory): ?>
                                    <option value="lala"><?= $userStory['title'];?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
