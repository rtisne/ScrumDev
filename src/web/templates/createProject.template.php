<h2 class="text-center">Creer un nouveau projet</h2>
<form class="form-horizontal">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Nom</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" placeholder="Nom du projet">
        </div>
    </div>
    <div class="form-group">
        <label for="description" class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="5" placeholder="Description du projet"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="dev" class="col-sm-2 control-label">Membres</label>
        <div class="col-sm-10">
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="dropdown">
                        <div class="input-group" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <input type="text" class="form-control" placeholder="Nom Prenom" aria-describedby="basic-addon2">
                            <span class="input-group-addon" id="add_dev">Ajouter membres</span>
                        </div>

                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li class="li"><a>Romain TISNE (romain.tisne@etu.u-bordeaux.fr)</a></li>
                            <li class="li"><a>Thomas LABROUSSE (thomas.labrousse@etu.u-bordeaux.fr)</a></li>
                            <li class="li"><a>Ismael TRAORE (ismael.traore@etu.u-bordeaux.fr)</a></li>
                        </ul>
                    </div>
                </li>
                <li class="list-group-item">Romain TISNE <span class="pull-right glyphicon glyphicon-remove"></span></li>
                <li class="list-group-item">Thomas LABROUSSE <span class="pull-right glyphicon glyphicon-remove"></span></li>
                <li class="list-group-item">Ismael TRAORE <span class="pull-right glyphicon glyphicon-remove"></span></li>
            </ul>
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Product Owner</label>
        <div class="col-sm-10">
            <select class="form-control">
                <option>Romain TISNE</option>
                <option>Thomas LABROUSSE</option>
                <option>Ismael TRAORE</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Creer</button>
        </div>
    </div>
</form>
</div>
