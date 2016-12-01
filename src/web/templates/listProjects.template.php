<h2>Liste des Projets<a href="<?php echo get_base_url(). 'createProject.php'?>"><button type="button" class="pull-right btn btn-primary">Creer un nouveau Projet</button></a></h2>
<?php
foreach ($projects as $projet) {
    ?>
    <a href="<?= $projet['link']; ?>" class="panel_link">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= $projet['title']; ?> <?= ($projet['isEditable'])?"<span class=\"pull-right glyphicon glyphicon-wrench\">":"<a href=\"unlinkToProject.php?idProject=".$projet['id']."\"><span class=\"pull-right glyphicon glyphicon-remove\"></span></a>"; ?></h3>

            </div>
            <div class="panel-body">

                <?= $projet['description']; ?>

            </div>
        </div>
    </a>

    <?php
}

?>
