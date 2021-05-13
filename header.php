<?php 
session_start();
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
</head>
<header>
<div class="header">
	<div class="logo">
		<a href="ManageUsers.php">Bienvenue dans le systeme de reconnaissance biométrique</a>
	</div>
</div>
<div class="topnav" id="myTopnav">
	<a href="index.php">PersonnesEnrollés</a>
    <a href="UsersLog.php">JournalEtudiant</a>
    <a href="ManageUsers.php">Enrolement</a>
	<a href="GestionAgent.php">Gestion des Responsables</a>
    <a href="javascript:void(0);" class="icon" onclick="navFunction()">
	  <i class="fa fa-bars"></i></a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                <p class="zal">Bienvenue, <?=$_SESSION['name']?>! vous avez la main</p>				
</div>
</header>
<script>
	function navFunction() {
	  var x = document.getElementById("myTopnav");
	  if (x.className === "topnav") {
	    x.className += " responsive";
	  } else {
	    x.className = "topnav";
	  }
	}
</script>


	

	
