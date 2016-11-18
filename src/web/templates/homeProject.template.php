<h2>Description</h2>

<p><?= $desc_project['description']; ?></p>


<h2>Sprint Actuel</h2>

<h3><?= $sprint['title']; ?></h3>
<div> <?= print_US_progression_sprint($sprint['id']); ?></div>
<div> Début : <?= $sprint['date_start']; ?> </div>
<div> Fin : <?= $sprint['date_end']; ?> </div>
