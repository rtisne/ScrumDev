<div class="modal fade" id="commit_popup" tabindex="-1" role="dialog" data-toggle="popover" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Toutes les tâches de la UserStory ont été terminées, voulez-vous changer son état ?</h4>
                </div>
                <div class="modal-body">
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
                    <input  type='hidden' class="user_story_selected" name="user_story" value="">

                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" name="submit" class="btn btn-primary" name="submit" value="updateUSState">Modifier</button>
                </div>

            </div>
        </form>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
