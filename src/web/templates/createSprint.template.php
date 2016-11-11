<div class="modal fade" tabindex="-1" role="dialog" id="createSprintmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Creer un sprint</h4>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Titre du sprint</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Titre">
                    </div>
                    <div class="form-group">
                        <label for="title">Date de début</label>
                        <div class="input-group date">
                          <input type="text" class="form-control" id="date_start" name="date_start" ><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Date de fin</label>
                        <div class="input-group date">
                          <input type="text" class="form-control" id="date_end" name="date_end"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" name="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
