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
                    <label for="detail" class="control-label">Numéro</label>
                    <div>
                        <input type="number" class="form-control" name="number" min="1" value="1">
                    </div>
                </div>
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

                     <?php if($isMember) : ?>

                    <div class="form-group">
                        <label for="detail" class="control-label">Coût</label>
                        <div>
                            <input type="number" class="form-control" name="cost" min="1" value="1">
                        </div>
                    </div>
                     <?php endif; ?>

                    <?php if($isProductOwner): ?>
                    <div class="form-group">
                        <label for="detail" class="control-label">Priorité</label>
                        <div>
                            <input type="number" class="form-control" name="priority"  min="1" value="1">
                        </div>
                    </div>
                    <?php endif; ?>


        <div class="clearfix">

                <div class="btn-group inline pull-right" data-toggle="buttons">
                    <label id= "story_kind" class="btn btn-primary" >
                        <input type="checkbox" name="kind" autocomplete="off" value="1"> All
                    </label>
                </div>
                </div>


            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" name="submit" >Valider</button>
                </div>
            </form>

        </div>
    </div>
</div>
