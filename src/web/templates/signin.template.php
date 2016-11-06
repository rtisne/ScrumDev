<h2 class="text-center">Connexion</h2>
<form class="form-horizontal" method="post">
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" placeholder="Email" name="email">
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default" name="submit" >Se connecter</button>
        </div>
    </div>
    <input type="hidden" id="login_token" name="token" value=<?php echo htmlspecialchars($csrf_token) ?> >

</form>
