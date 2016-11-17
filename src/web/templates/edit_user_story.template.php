<div class="modal fade" id="edit_user_story" tabindex="-1" role="dialog" aria-labelledby="edit_user_story" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="detail" class="control-label"></label>
                    <div>
                        <input type="number" class="form-control" name="number" min="1" value= $story["number"]>>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">Titre de la user story</label>
                    <input type="text" class="form-control" name="title" value="">
                </div>
                <div class="form-group">
                    <label for="detail" class="control-label">Description</label>
                    <div>
                        <textarea class="form-control" rows="5" name="description" value="" required="required"></textarea>
                    </div>
                </div>

                <?php if($isMember) : ?>

                    <div class="form-group">
                        <label for="detail" class="control-label">Coût</label>
                        <div>
                            <input type="number" class="form-control" name="cost" min="1" value="">
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($isProductOwner): ?>
                    <div class="form-group">
                        <label for="detail" class="control-label">Priorité</label>
                        <div>
                            <input type="number" class="form-control" name="priority"  min="1" value="">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

