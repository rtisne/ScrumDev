<h2 class="text-center">Modification des paramètres du compte</h2>
<form class="form-horizontal" method="post" >
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Nom</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nom" required="required" value="<?=(isset($user_name))?$user_name:""?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Prenom</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Prenom" required="required" value="<?=(isset($first_name))?$first_name:""?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="required" value="<?=(isset($email))?$email:""?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default" name="submit" >Modifier</button>
        </div>
    </div>
</form>
