<?php include "./templates/top.php"; ?>

<?php include "./templates/navbar.php"; ?>

<div class="container">
	<div class="row justify-content-center" style="margin:100px 0;">
		<div class="col-md-4">
			<h4>Inscription</h4>
			<p class="message"></p>
			<form id="admin-register-form">
			  <div class="form-group">
			    <label for="name">Nom</label>
			    <input type="text" class="form-control" name="name" id="name" placeholder="Entrer votre nom">
			  </div>
			  <div class="form-group">
			    <label for="email">Email </label>
			    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
			    <small id="emailHelp" class="form-text text-muted">Votre email restera secret.</small>
			  </div>
			  <div class="form-group">
			    <label for="password">Mot de passe</label>
			    <input type="password" class="form-control" name="password" id="password" placeholder="Votre mdp">
			  </div>
			  <div class="form-group">
			    <label for="cpassword">Confirmation du mot de passe</label>
			    <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="votre mdp">
			  </div>
			  <input type="hidden" name="admin_register" value="1">
			  <button type="button" class="btn btn-primary register-btn">S'inscrire</button>
			</form>
		</div>
	</div>
</div>





<?php include "./templates/footer.php"; ?>

<script type="text/javascript" src="./js/main.js"></script>