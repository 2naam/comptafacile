<div class="container">
	<h1 class="main-title">Bienvenue sur Compta Facile !! </h1>
	<div class="row">
		<div class="col-md-12 message-erreur bg-danger <?php echo $erreurClass ?>">
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
		
	</div>
	<div class="row form-row"> <!-- Class permettant de centrer les formulaires sur la page avec BootStrap -->
		<div class="col-md-6 col-xs-12">
	
			<div class="well"> <!-- Permet de mettre les formulaires en avant par rapport au background -->
				<form id="creation" name="creation" method="POST" action="actions/inscription.php" > <!-- Permet de creer un formulaire pour recuperer les données -->
					<h2>Inscription</h2>
					<div class="form-group">
						<label for="email">Email</label>
						<input class="form-control" type="text" id="email" name="email" placeholder="Entrez votre email" value="<?php if(isset ($_SESSION['email'])){echo $_SESSION['email'];}?>"/>
					</div>
					<div class="form-group">
						<label for="pseudo">Pseudo</label>
						<input class="form-control" type="text" id="pseudo" name="pseudo" placeholder="Entrez votre pseudo" value="<?php if(isset ($_SESSION['pseudo'])){echo $_SESSION['pseudo'];}?>"/>
					</div>
					<div class="form-group">
						<label for="password">Mot de passe</label>
						<input class="form-control" type="password" id="password" name="password" placeholder="Entrez votre Mot de passe" />
					</div>
					<div class="form-group">
						<label for="password2">Confirmation du mot de passe</label>
						<input class="form-control" type="password" id="password2" name="password2" placeholder="Confirmez votre Mot de passe" />
					</div>
					<div>
						<button type="submit" class="btn btn-default">S'enregistrer</button>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-6 col-xs-12">
			<div class="well">
				<form id="creation" name="creation" method="POST" action="actions/connexion.php" >
					<h2>Connexion</h2>
					<div class="form-group">
						<label for="pseudo">Pseudo</label>
						<input class="form-control" type="text" id="pseudo" name="pseudo" placeholder="Entrez votre pseudo" value="<?php if(isset ($_SESSION['pseudo'])){echo $_SESSION['pseudo'];}?>"/>
					</div>
					<div class="form-group">
						<label for="password">Mot de passe</label>
						<input class="form-control" type="password" id="password" name="password" placeholder="Entrez votre Mot de passe" />
					</div>
					<div>
						<button type="submit" class="btn btn-default">Se connecter</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>