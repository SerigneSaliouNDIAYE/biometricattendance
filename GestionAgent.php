<!DOCTYPE html>
<html>
<head>
	<title>Gestion des Agents</title>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
<link rel="stylesheet" type="text/css" href="css/manageusers2.css">
<script>

  $(window).on("load resize ", function() {
    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
    $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js" 
integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" 
crossorigin="anonymous">
</script>
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
	<h1 class="slideInDown animated">Ajouter un nouveau Responable <br> ou le supprimer</h1>
	<div class="form-style-5 slideInDown animated">
		<div class="alert">
		<label id="alert"></label>
		</div>
		<form method="post" action="action.php">
			<fieldset>
			<legend><span class="number">1</span> Username and password:</legend>
				<label>Entrer un nom d'utilisateur et son password:</label>
				<input type="text" name="username" id="nom" placeholder="Nom d'utilisateur de l'agent...">
				<input type="text" name="password" id="password" placeholder="Donner un mot de passe...">
			</fieldset>
			<fieldset>
				<legend><span class="number">2</span> Informations sur le responsable</legend>
				<input type="text" name="nom" id="name" placeholder="Nom de l'agent...">
				<input type="text" name="prenom" id="number" placeholder="prenom de l'agent...">
				<input type="text" name="fonction" id="number" placeholder="fonction de l'agent...">
			</fieldset>
			<button type="submit" name="ajouter" class="user_add">Ajouter responsable</button>
			<button type="submit" name="modifier" class="user_upd">Modifier responsable</button>
			<button type="submit" name="supprimer" class="user_rmo">Supprimer responsable</button>
		</form>
	</div>

<section class="section">
  <!--User table-->
  <h1 class="slideInDown animated">Voici la liste de tous les responsable</h1>
  <div class="tbl-header slideInRight animated">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
          <th>IdResponsable</th>
          <th>Nom</th>
          <th>password</th>
          <th>Prenom</th>
          <th>Username</th>
		  <th>Fonction</th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="tbl-content slideInDown animated">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
        <?php
          //Connect to database
          require'connectDB.php';

            $sql = "SELECT * FROM agent WHERE NOT username='' ORDER BY idagent DESC";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo '<p class="error">SQL Error</p>';
            }
            else{
              mysqli_stmt_execute($result);
                $resultl = mysqli_stmt_get_result($result);
              if (mysqli_num_rows($resultl) > 0){
                  while ($row = mysqli_fetch_assoc($resultl)){
          ?>
                      <TR>
                      <TD><?php echo $row['idagent']?></TD>
                      <TD><?php echo $row['nom'];?></TD>
                      <TD><?php echo $row['password'];?></TD>
                      <TD><?php echo $row['prenom'];?></TD>
                      <TD><?php echo $row['username'];?></TD>
					  <TD><?php echo $row['fonction'];?></TD>
                      </TR>
        <?php
                }   
            }
          }
        ?>
      </tbody>
    </table>
  </div>
</section>
</main>
</body>
</html>