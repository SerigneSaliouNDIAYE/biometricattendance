<?php
require'connectDB.php';

if (isset($_POST['ajouter'])) {
$username =$_POST['username'];
$password =$_POST['password'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$fonction= $_POST['fonction'];
if(!empty($username)&&(!empty($password))&&(!empty($nom))&&(!empty($prenom))&&(!empty($fonction))){
$sql = "INSERT INTO agent (nom, password,prenom,username,fonction) values ('$nom','$password','$prenom','$username','$fonction')";
if ($conn->query($sql)){
echo "Les donneés sont ajouter avec succées";
header('Location: GestionAgent.php');
}
else{
echo "Error: ". "Renseigner les champs "."
". $conn->error;
header('Location: GestionAgent.php');
}
$conn->close();
}
else{
echo "Password should not be empty";
die();
}


}
header('Location: GestionAgent.php');
?>