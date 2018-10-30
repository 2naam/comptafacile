<h2 class="main-title">Bienvenue <?php 
	echo ''.$user->getPseudo();
?> !</h2>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="message bg-danger <?php echo $erreurClass?>">
				<ul class="list-erreurs">
				<?php
					foreach ($erreurs as &$erreur) {
				?>
					<li>
					<span class="text-danger">
					<?php echo ''.$erreur ?>
					</span>
					</li>
				<?php
					}
				?>
				</ul>
			</div>
			<div class="message bg-success <?php $successClass?>">
				<ul class="list-erreurs">
				<?php
					foreach ($successes as &$success) {
				?>
					<li>
					<span class="text-success">
					<?php echo ''.$success ?>
					</span>
					</li>
				<?php
					}
				?>
				</ul>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<a href="logout.php"><button type="button" class="btn btn-primary">Déconnexion</button></a>
		</div>
		<div class="col-md-6">
		</div>
	</div>
	
</div>