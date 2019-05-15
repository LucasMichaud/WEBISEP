<?php
include("General.php");
?>
<html>
	<head>
		<title>Connexion</title>
	<link rel="stylesheet" href="design/Connexion.css" />
		<meta charset="utf-8">
	</head>
	<body>
		
		<div class="cadre" >
			<a href="index.php?action=inscription" style="text-decoration: none;color: black;font-size: 0.7em;">Pas encore de compte?</a>
			<a href="index.php?action=recuperation" style="text-decoration: none;color: black;font-size: 0.7em;">Mot de passe oublié ?</a>
			<h2 align="center">Connexion</h2>
			<br /><br /><br />
			<form method="POST" action="">
				<div class="log" align='center'>
				<input type="text" id="pseudo" name="pseudoconnect" placeholder="pseudo" />
				<input type="password" name="mdpconnect" placeholder="Mot de passe" />
				</div>
				<br><br>
				<input type="submit" name="formconnexion" value="Se connecter" />
		</form>
		<?php
		if(isset(($erreur)))
		{
			echo '<font color = "red">'.$erreur."</font>";
		}
		?>
		</div>
	</body>
</html>

 <script>
window.onload = function() {
  document.getElementById("pseudo").focus();
};
</script>