<div class="row equal">
	<div class="col-md-6">
		<div class="panel panel-default panel-equal">
			<div class="panel-heading"><h3 class="panel-title">Description du projet</h3></div>

			<div class="panel-body"><?= $desc_project['description']; ?></div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="panel panel-default panel-equal">
			<div class="panel-heading"><h3 class="panel-title">Sprint Actuel</h3></div>

			<div class="panel-body">

				<div class="row sprint_item">
					<div class="col-md-4 desc_sprint">
						<div class="sprint_title"><a href="<?= get_base_url() . "kanban.php?id_project=" . intval($_GET['id_project']) . "&id_sprint=" . $sprint['id'];?>"><?= $sprint['title']; ?></a></div>
						<div><?= print_US_progression_sprint($sprint['id']); ?></div>
					</div>
					<div class="col-md-5 col-md-offset-3">
						<div class="row">
							<div class="col-md-3">
								Début:
							</div>
							<div class="col-md-9 text-right">
								<?= $sprint['date_start']; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								Fin:
							</div>
							<div class="col-md-9 text-right">
								<?= $sprint['date_end']; ?>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row equal">
	<div class="col-md-6">
		<div class="panel panel-default panel-equal">
			<div class="panel-heading"><h3 class="panel-title">Contributeurs </h3></div>
			<div class="panel-body">

				<div class="row margin-bottom">
					<div class="col-md-4">
						<strong>Créateur du projet:</strong>
					</div>
					<div class="col-md-6">
						<?php echo $project_creator['first_name']; echo" "; echo $project_creator['name']; ?>
					</div>
				</div>
				<div class="row margin-bottom">
					<div class="col-md-4">
						<strong>Product Owner:</strong>
					</div>
					<div class="col-md-6">
						<?php echo $product_owner['first_name']; echo" "; echo $product_owner['name']; ?>
					</div>
				</div>
				<div class="margin-bottom"><strong> Liste des membres: </strong></div>
				<div class="list-group">
					<li class="list-group-item"><?= $project_creator['first_name'];?> <?=$project_creator['name'];?></li>
					<?php foreach ($list_member as $member): ?>
						<li class="list-group-item"><?= $member["first_name"];?> <?=$member["name"];?></li>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default panel-equal">
			<div class="panel-heading"><h3 class="panel-title">BurnDown Chart</h3></div>
			<div class="panel-body">
				(sprint 3)
			</div>
		</div>
	</div>
</div>
