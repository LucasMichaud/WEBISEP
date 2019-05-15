<?php include("General.php");
?>

<html>
<head>
	<title><?php echo $_GET['var']?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="design/topic.css" />



</head>
<body>
	<div class="enemble">
		<?php  if(isset($_SESSION["admin"]) AND $_SESSION["admin"] == 1) { ?>
	<h1>Messagerie administrative </h1><br>
<?php }  else { ?>
	<h1>Messagerie de <?php echo $_SESSION['pseudo']; ?> </h1><br>
<?php } ?>
	<div class="probleme">


<?php 


/*La question*/
$numbillet=$_GET['numbillet'];
  $request=affichProbleme($numbillet);
  $reqReponse=affichAnswer($numbillet);

while ($liste=$request->fetch()) {?>
	<div class="topic">
		<h2><a><?php echo $liste['titre'] ?></a></h2>
		<a>publié le <?php echo $liste['date_billet'] ?></a><br>
		<a class="info">par <span><?php echo $liste['author'] ?></span></a><br>
		<p class="question"><?php
		echo $liste['Question'] ?></p><br>
	</div>
</div>


	<!-- les réponses au topic -->
	<div class="totalmessage">
		<?php 
		while ($listeMessage= $reqReponse -> fetch()) {?>
			<div class="message">
				<div class="gauche">
					<a>réponse de : <?php echo $listeMessage['pseudo'] ?><br> le <?php echo $listeMessage['date_message'] ?></a><br>
				</div>
				<div class="droite">
					<a><?php echo $listeMessage['reponse'] ?><br><br></a>
				</div>

				<?php
				$mID=$listeMessage['id'];
				if (isset($_SESSION['admin']) && ($_SESSION['admin'])==1) {
					?>
					<a class="delete" href="index.php?action=topic&numbillet=<?=$numbillet?>&deleteMessage=<?= $mID?>"><i class="material-icons">delete</i> </a>
				<?php } ?>
			</div>
		<?php }?>
	</div><br><br>

<?php
}

/*repondre aux messages*/
if(empty($_SESSION['id']))
{ ?>
	<br><p>Vous devez être connecter pour pouvoir répondre...</p>

	<?php
} 
else{

?>
<!-- formulaire de réponse -->
<div class="adminpart" align="center">
    <form method='POST' action="" ; >
    	<label>Connecté en tant que <?php echo $_SESSION['pseudo'] ?></label><br><br>

        <label for="reponse">Ajouter une réponse :</label><br>
        <textarea type="text" name="reponse" id="reponse" cols="65" rows="4" required></textarea><br><br>

        <input type="submit"  name='publier' class="publier" value="Publier" />

    </form>
</div><br>
</div>
<?php } ?>
</body>
</html>