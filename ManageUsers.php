<!DOCTYPE html>
<html>
<head>
	<title>Gestion des utilisateurs</title>
<link rel="stylesheet" type="text/css" href="css/manageusers.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
<script>
  $(window).on("load resize ", function() {
    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
    $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
</script>
<script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
</script>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/manage_users.js"></script>
<script>
  $(document).ready(function(){
  	  $.ajax({
        url: "manage_users_up.php"
        }).done(function(data) {
        $('#manage_users').html(data);
      });
    setInterval(function(){
      $.ajax({
        url: "manage_users_up.php"
        }).done(function(data) {
        $('#manage_users').html(data);
      });
    },5000);
  });
</script>
</head>
<body>
<?php include'header.php';?>	
<main>
	<h1 class="slideInDown animated">Ajouter un nouveau enrolement <br> ou le supprimer</h1>
	<div class="form-style-5 slideInDown animated">
		<div class="alert">
		<label id="alert"></label>
		</div>
		<form>
			<fieldset>
			<legend><span class="number">1</span> Numero d'empreinte d'utilisateur:</legend>
				<label>Entrer un numero d'empreinte:</label>
				<input type="number" name="fingerid" id="fingerid" placeholder="Numero d'empreinte...">
				<button type="button" name="fingerid_add" class="fingerid_add">Ajouter un numero d'empreinte</button>
			</fieldset>
			<fieldset>
				<legend><span class="number">2</span> Informations d'utilisateur</legend>
				<input type="text" name="name" id="name" placeholder="Nom d'utilisateur...">
				<input type="text" name="number" id="number" placeholder="Numero de serie...">
				<input type="email" name="email" id="email" placeholder="Adresse email...">
			</fieldset>
			<fieldset>
			<legend><span class="number">3</span> Informations supplémentaires</legend>
			<label>
				Heure d'enrolement:
				<input type="time" name="timein" id="timein">
				<input type="radio" name="gender" class="gender" value="Female">Feminin
	          	<input type="radio" name="gender" class="gender" value="Male" checked="checked">Masculin
	      	</label >
			</fieldset>
			<fieldset>
			<legend><span class="number">4</span>Live Capture</legend>
			<label>
				Prendre une Photo:
				<a href="photo.php">Capture En Direct</a>
	      	</label >
			</fieldset>
			<button type="button" name="user_add" class="user_add">Ajouter utilisateur</button>
			<button type="button" name="user_upd" class="user_upd">Modifier utilisateur</button>
			<button type="button" name="user_rmo" class="user_rmo">Supprimer utilisateur</button>
		</form>
	</div>

	<div class="section">
	<!--User table-->
		<div class="tbl-header slideInRight animated">
		    <table cellpadding="0" cellspacing="0" border="0">
		      <thead>
		        <tr>
	        	  <th>ID</th>
		          <th>Nom</th>
		          <th>Genre</th>
		          <th>Numero So</th>
		          <th>Date</th>
		          <th>Heure</th>
				  <th>Photo</th>
		        </tr>
		      </thead>
		    </table>
		</div>
		<div class="tbl-content slideInRight animated">
		    <table cellpadding="0" cellspacing="0" border="0">
		      <div id="manage_users"></div>
		</div>
	</div>

</main>
</body>
</html>

<?php
// We need to use sessions, so you should always start sessions using the below code.

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
?>