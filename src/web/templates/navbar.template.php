<nav class="navbar navbar-default navbar-static-top">
     <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Scrumify</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php
            if(isset($_SESSION['name']))
            {
            ?>
            <li><a href="../myAccount.php"><?php echo $_SESSION['name'] . " " . $_SESSION['first_name'];?></a></li>
            <?php
            }else {
            ?>
            <li><a href="../signin.php">Connexion</a></li>
            <li><a href="../signup.php">Inscription</a></li>
            <?php
            }
            ?>
          </ul>
        </div>
    </div>
</nav>
