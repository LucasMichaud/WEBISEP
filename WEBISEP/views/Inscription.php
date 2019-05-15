<?php
include("General.php");
?>

<html>
	<head>
		<title>Inscription</title>
		<link rel="stylesheet" href="design/Inscription.css" />
		<meta charset="utf-8">
	</head>
	<body>
				
<div class="tabl">
		<div class="cadre" align="center">
			<div id="already"><a href="index.php?action=connexion" >Déjà inscrit ?</a></div>
			<h2>Inscription</h2>
			<form method="POST" action="">
				
				<div id="profil">
				<table>
					<tr>
						<td align="right">
							<label for ="pseudo">Pseudo: </label>
						</td>
						<td>
							<input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if (isset($pseudo)) {echo $pseudo;} ?>" />
						</td>
					</tr>

					<tr>
						<td align="right">
							<label for ="prenom">Prénom: </label>
						</td>
						<td>
							<input type="text" placeholder="Votre prénom" id="prenom" name="prenom" value="<?php if (isset($prenom)) {echo $prenom;} ?>" />
						</td>
					</tr>

					<tr>
						<td align="right">
							<label for ="Nom">Nom: </label>
						</td>
						<td>
							<input type="text" placeholder="Votre nom" id="nom" name="nom" value="<?php if (isset($nom)) {echo $nom;} ?>" />
						</td>
					</tr>


					<tr>
						<td align="right">
							<label for ="mail">Mail: </label>
						</td>
						<td>
							<input type="text" placeholder="Votre mail" id="mail" name="mail" value="<?php if (isset($mail)) {echo $mail;} ?>" />
						</td>
					</tr>
					<tr>
						<td align="right">
						
						</td>
						<td>
							<input type="email" placeholder="Confirmez l'adresse email" id="mail2" name="mail2" value="<?php if (isset($mail2)) {echo $mail2;} ?>"/>
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for ="mdp">Mot de passe :</label>
						</td>
						<td>
							<input type="password" placeholder="Mot de passe" id="mdp" name="mdp"/>
						</td>
					</tr>
					<tr>
						<td></td>
						<td><progress max="100" value ="0" id="strength" style="width: 166px"></progress></td>
					<tr>
						<td align="right">
							
						</td>
						<td>
							<input type="password" placeholder="Confirmez le mot de passe" id="mdp2" name="mdp2"/>
						</td>
					</tr>
				</table>
				</div>
				<div id="block">
				<div id="address">
					<table>
					<tr>
						<td align="right">
							<label for ="adresse">Adresse :</label>
						</td>
						<td>
							<input type="text" placeholder="Adresse" id="adresse" name="adresse"/>
						</td>
					</tr>

					<tr>
						<td align="right">
							<label for ="codepostal">Code Postal :</label>
						</td>
						<td>
							<input type="number" placeholder="Code Postal" id="code" name="code"/>
						</td>
					</tr>

					<tr>
						<td align="right">
							<label for ="ville">Ville :</label>
						</td>
						<td>
							<input type="text" placeholder="Ville" id="ville" name="ville"/>
						</td>
					</tr>
				</table>
				</div>
				<div id="end">
					<table>
					<tr>
						<td>
							<div for="condition">Accepter les CGU</label>
						</td>
						<td>
							<input type="checkbox" name="condition" value="condition" required>
						
						</td>
					</tr>
				</table>
							<span id="cgu_info">Vous devez accepter les CGU pour continuer</span>
				
				</div>
			</table>
			<input type="submit" name="forminscription" value="Je m'inscris" />
		</div>
		</form>
		<?php
		if(isset(($erreur)))
		{
			echo '<font color = "red">'.$erreur."</font>";
		}
		?>
		</div>
	</div>
	</body>
</html>


<script>
    
/*vérif mdp*/
   document.getElementById("mdp2").addEventListener("input", function(e){
    var mdpVerif= e.target.value;
    var paragrapheErreur = document.getElementById("erreur");
    var color='red';
    if (mdpVerif != document.getElementById("mdp").value) { /*si les mdp sont différents*/
      paragrapheErreur= "\u2717"; /*croix rouge ✗*/
    }
    else{
      color='green';
      paragrapheErreur = "\u2713";/*coche vert ✔*/
    }
    var aide= document.getElementById("erreur");
    aide.textContent = paragrapheErreur;
    aide.style.color = color; 
   });
       
/*vérif mail*/
   document.getElementById("mail2").addEventListener("input", function(e){
    var mailVerif= e.target.value;
    var paragrapheErreur = document.getElementById("erreurMail");
    var color='red';
    if (mailVerif != document.getElementById("mail").value) {
      paragrapheErreur.innerHTML = "\u2717"; /*croix rouge ✗*/
    }
    else{
      color='green';
      paragrapheErreur.innerHTML = "\u2713";/*coche vert ✔*/
      
    }
    var aide= document.getElementById("erreurMail");
    aide.textContent = paragrapheErreur.innerHTML;
    aide.style.color = color; 
   });
      </script>
      <script>
window.onload = function() {
  document.getElementById("pseudo").focus();
};
</script>

<script>


var mdp = document.getElementById("mdp")
mdp.addEventListener('keyup',function()
{
	checkPassword(mdp.value)
})

function checkPassword(motdepasse){
	var bar = document.getElementById("strength")
	var str = 0;
	if(motdepasse.match(/[a-z]+/))
	{
		str+=1
	}
	if(motdepasse.match(/[A-Z]+/))
	{
		str+=1
	}
	if(motdepasse.match(/[0-9]+/))
	{
		str+=1
	}
	if(motdepasse.match(/[!@£$%^&()~<>?~<>?]+/))
	{
		str+=1
	}
	if(motdepasse.length>5){
		str+=1
	} 
	switch(str)
	{
		case 0:
			bar.value=0;
			break
		case 1:
			bar.value=20;
			break
		case 2:
			bar.value=40;
			break
		case 3:
			bar.value=60;
			break
		case 4:
			bar.value=80;
			break
		case 5:
			bar.value=100;
			break
	}
}

	</script>

	<script type="text/javascript">
		const inputElt = document.querySelector("input[type=checkbox]");
		const spanInfoElt = document.getElementById("cgu_info");

		inputElt.addEventListener("change", changeFunction);

		function changeFunction(event) {
		    console.log("Case cochée ? -> " + event.target.checked);
		    if (event.target.checked) {
		        spanInfoElt.textContent = "Vous pouvez continuer";
		        spanInfoElt.style.color = "green";
		    } else {
		        spanInfoElt.textContent = "Vous devez accepter les CGU pour continuer";
		        spanInfoElt.style.color = "red";
		    }
		}
	</script>