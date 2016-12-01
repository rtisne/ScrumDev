<div class="modal fade" id="edit_user_story" tabindex="-1" role="dialog" aria-labelledby="edit_user_story" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Modification de la user story</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="title">Titre de la user story</label>
                    <input id="update_form__user_story_title" type="text" class="form-control" name="title" value="">
                </div>
                <div class="form-group">
                    <label for="detail" class="control-label">Description</label>
                    <div>
                        <textarea id="update_form__user_story_description" class="form-control" rows="5" name="description" value="" required="required"></textarea>
                    </div>
                </div>

                <?php if($isMember) : ?>

                    <div  class="form-group">
                        <label for="detail" class="control-label">Coût</label>
                        <div>
                            <input id="update_form__user_story_cost" type="number" class="form-control" name="cost" min="1" value="">
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($isProductOwner): ?>
                    <div  class="form-group">
                        <label for="detail" class="control-label">Priorité</label>
                        <div>
                            <input id="update_form__user_story_priority" type="number" class="form-control" name="priority"  min="1" value="">
                        </div>
                    </div>
                <?php endif; ?>

                <div  class="form-group">
                    <label for="detail" class="control-label">Etat</label>
                    <div class="checkbox">
                        <label><input type="checkbox" id="update_form_user_story_state" name="state">Elle a été réalisée</label>
                    </div>
                </div>


                <div  class="form-group">
                    <label for="detail" class="control-label">Commit</label>
                    <input id="update_form_user_story_commit" type="text" class="form-control" name="commit" value="" disabled>

                </div>
                <input  type='hidden' class="user_story_selected" name="user_story_id" value="">

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="submit" name="submit" class="btn btn-primary" name="submit" value="update">Modifier</button>
            </div>

        </div>
        </form>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
