<nav class="navbar navbar-default navbar-static-top">
     <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href=<?php echo get_base_url(). '/index.php'?>>Scrumify</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php
            if(isset($_SESSION['name']))
            {
            ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $_SESSION['name'] . " " . $_SESSION['first_name'];?></a>
                    <ul class="dropdown-menu">
                        <li><a href= <?php echo get_base_url(). 'myAccount.php'?>>Paramètre du compte</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a id="logout_link" href="">Déconnexion</a></li>

                    </ul>
                </li>
            <?php
            }else {
            ?>
            <li><a href=<?php echo get_base_url(). 'signin.php'?>>Connexion</a></li>
            <li><a href=<?php echo get_base_url(). 'signup.php'?>>Inscription</a></li>
            <?php
            }
            ?>
          </ul>
        </div>
    </div>
</nav>
