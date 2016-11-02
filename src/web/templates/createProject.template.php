<h2 class="text-center">Creer un nouveau projet</h2>
<form class="form-horizontal" method="post">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Nom</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" placeholder="Nom du projet" required="required">
        </div>
    </div>
    <div class="form-group">
        <label for="description" class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="5" name="description" placeholder="Description du projet" required="required"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="dev" class="col-sm-2 control-label">Membres</label>
        <div class="col-sm-10">
            <ul class="list-group list_member">
                <li class="list-group-item">
                    <div class="dropdown">
                        <input type="text" id="add_member_input" class="form-control" placeholder="Nom Prenom" aria-describedby="basic-addon2">


                        <ul class="dropdown-menu" id="dropdown_proposal" aria-labelledby="dLabel">
                        </ul>
                    </div>
                </li>
                <li class="list-group-item" data-id="<?= $_SESSION['id'] ?>"><?= $_SESSION['first_name'] . " " . $_SESSION['name']?></li>
            </ul>
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Product Owner</label>
        <div class="col-sm-10">
            <select class="form-control" name="product_owner">
                <option value="<?= $_SESSION['id'] ?>"><?= $_SESSION['first_name'] . " " . $_SESSION['name']?></option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="submit" class="btn btn-default">Creer</button>
        </div>
    </div>
</form>
</div>
