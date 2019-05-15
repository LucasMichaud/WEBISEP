<?php include("General.php");
?>

<html>
<head>
	<title><?php echo $_SESSION['pseudo']?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="design/categorie.css" />


</head>
<body>
	<?php  if(isset($_SESSION["admin"]) AND $_SESSION["admin"] == 1) { ?>
	<h1>Messagerie administrative </h1><br><br>
<div class="ensemble">
<?php

/*afficher les topic*/
$request=affichAllBillet();
while ($liste=$request->fetch()) {	
	?>

	<div class="topic">
	<h2 class="titre"><a class="clicable" href="index.php?action=messagerie&numbillet=<?php echo $liste['id_billet']?>"><?php echo $liste['titre'] ?></a></h2>
	<div class="corp">
	<a class="info">publié le <?php echo $liste['date_billet'] ?></a><br>
	<a class="info">par <span><?php echo $liste['author'] ?></span></a><br>
	<p class="text"><?php
	echo $liste['Question'] ?></p><br>
	</div>
<?php
$mID=$liste['id_billet'];
    if (isset($_SESSION['admin']) && ($_SESSION['admin'])==1) {
    	$url="index.php?action=billet&delete=<?= $mID?>";?>
    	<a class="delete" href="index.php?action=billet&delete=<?= $mID?>"><i class="material-icons">delete</i></a>
<?php
} ?>
	</div><br>
<?php
}   

?>				
	<?php } else { ?>


	<h1>Messagerie de <?php echo $_SESSION['pseudo']; ?> </h1><br><br>
<div class="ensemble">
<?php

/*afficher les topic*/
$id= $_SESSION['pseudo'];
$request=affichBillet($id);
while ($liste=$request->fetch()) {	
	?>

	<div class="topic">
	<h2 class="titre"><a class="clicable" href="index.php?action=messagerie&numbillet=<?php echo $liste['id_billet']?>"><?php echo $liste['titre'] ?></a></h2>
	<div class="corp">
	<a class="info">publié le <?php echo $liste['date_billet'] ?></a><br>
	<a class="info">par <span><?php echo $liste['author'] ?></span></a><br>
	<p class="text"><?php
	echo $liste['Question'] ?></p><br>
	</div>
<?php
$mID=$liste['id_billet'];
    if (isset($_SESSION['admin']) && ($_SESSION['admin'])==1) {
    	$url="index.php?action=billet&delete=<?= $mID?>";?>
    	<a class="delete" href="index.php?action=billet&delete=<?= $mID?>"><i class="material-icons">delete</i></a>
<?php
} ?>
	</div><br>
<?php
}   

?>

<!-- ajouter un topic -->
<?php 
if(empty($_SESSION['id']))
{
	?>
	<br><p>Vous devez être connecter pour pouvoir poser un question...</p>
	<?php
} 
else{
?>
<br><br><div class="adminpart" align="center">
	<h2>Un problème ?</h2>
    <form method='POST' action="" ; >

        <label for="titre">Objet :</label><br>
        <input type="text" name="titre" id="titre" size="80" required><br><br>

		<label for="Question">Ajouter votre message :</label><br>
        <textarea type="text" name="Question" id="Question" cols="62" rows="4" required></textarea><br><br>



        <input type="submit"  name='publier' class="publier" value="Publier" />

    </form>
</div><br>
</div>
    <?php } ?>
<?php } ?>
</body>
</html>