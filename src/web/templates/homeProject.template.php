<h2>Description</h2>

<p><?= $desc_project['description']; ?></p>


<h2>Sprint Actuel</h2>

<h3><?= $sprint['title']; ?></h3>
<div> <?= print_US_progression_sprint($sprint['id']); ?></div>
<div> Début : <?= $sprint['date_start']; ?> </div>
<div> Fin : <?= $sprint['date_end']; ?> </div>


<h2> Contributeurs : </h2>
<div> Créateur du projet : <?php echo $project_creator['first_name']; echo" "; echo $project_creator['name']; ?> </div>
<div> Product Owner : <?php echo $product_owner['first_name']; echo" "; echo $product_owner['first_name']; ?> </div>
<h4> Liste des membres : </h4>
<?php 
	foreach ($list_member as $member) {
           echo "<div>";
           echo $member["name"];
           echo " ";
           echo $member["first_name"];
           echo "</div>";
     }
?>

