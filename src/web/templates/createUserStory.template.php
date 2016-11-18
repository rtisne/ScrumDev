<div class="modal fade" tabindex="-1" role="dialog" id="createUSmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Créer une user story</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                        <label for="title">Titre de la user story</label>
                        <input type="text" class="form-control" name="title" placeholder="Titre">
                    </div>
                    <div class="form-group">
                        <label for="detail" class="control-label">Description</label>
                        <div>
                            <textarea class="form-control" rows="5" name="description" placeholder="Detail" required="required"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="detail" class="control-label">Coût</label>
                        <div>
                            <input type="number" class="form-control" name="cost" value="">
                        </div>
                    </div>
                    <?php if($isProductOwner): ?>
                   <div class="form-group">
                       <label for="detail" class="control-label">Priorité</label>
                       <div>
                           <input type="number" class="form-control" name="priority" value="">
                       </div>
                   </div>
                   <?php endif; ?>
                    <?php if(0) : ?>
                   <div class="form-group">
                       <label for="detail" class="control-label">Commit</label>
                       <input type="text" class="form-control"  placeholder="numéro du commit">
                   </div>
                    <?php endif; ?>

            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" name="submit" value="create">Valider</button>
                </div>
            </form>

        </div>
    </div>
</div>
