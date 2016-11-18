
<div class="modal fade" id="delete_user_story" tabindex="-1" role="dialog" aria-labelledby="delete_user_story" aria-hidden="true">
      <div class="modal-dialog">
          <form action="" method="post">

          <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Supprimer la user story</h4>
      </div>
          <div class="modal-body">

       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Etes ous sur de vouloir supprimer cette user story?</div>
              <input type='hidden' class="user_story_selected" name="number" value="">
      </div>

          <div class="modal-footer ">
        <button type="submit" class="backlog-delete-button btn btn-success" name="submit" value="delete"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="backlog-delete-button btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>

      </div>
          </form>

          <!-- /.modal-content -->
  </div>
      <!-- /.modal-dialog -->
    </div>