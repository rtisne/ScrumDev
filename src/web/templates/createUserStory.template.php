<div class="modal fade" tabindex="-1" role="dialog" id="createUSmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Creer une user story</h4>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Titre de la user story</label>
                        <input type="text" class="form-control" id="title" placeholder="Titre">
                    </div>
                    <div class="form-group">
                        <label for="detail" class="control-label">Detail</label>
                        <div>
                            <textarea class="form-control" rows="5" name="detail" placeholder="Detail" required="required"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="detail" class="control-label">Coût</label>
                        <div>
                            <input type="number" class="form-control" name="cout" min="1" value="1">
                        </div>
                    </div>
                     <!-- Si cest le Po -->
                    <div class="form-group">
                        <label for="detail" class="control-label">Priorité</label>
                        <div>
                            <input type="number" class="form-control" name="priorite" min="1" value="1">
                        </div>
                    </div>
                    <!-- Si en état fini -->
                   <div class="form-group">
                       <label for="detail" class="control-label">Commit</label>
                       <input type="text" class="form-control"  placeholder="numéro du commit">
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
