<?php
include("Recup.php");
?>

<h4 class="title-element">Récupération de mot de passe</h4>
<?php if($section == 'code') { ?>
Un code de vérification vous a été envoyé par mail: <?= $_SESSION['recup_mail'] ?>
<br/>
<form method="post">
   <input type="text" placeholder="Code de vérification" name="verif_code"/><br/>
   <input type="submit" value="Valider" name="verif_submit"/>
</form>
<?php } elseif($section == "changemdp") { ?>
Nouveau mot de passe pour <?= $_SESSION['recup_mail'] ?>
<form method="post">
<table>
          <tr>
            <td align="right">
              <label for ="mdp">Mot de passe </label>
            </td>
            <td>
              <input type="password" placeholder="mot de passe" id="change_mdp" name="change_mdp"/>
              <progress max="100" value ="0" id="strength" style="width: 161px"></progress>
            </td>
          </tr>
          <tr>
            <td align="right">
              <label for ="mdp2">Confirmation du mot de passe </label>
            </td>
            <td>
              <input type="password" placeholder="Confirmez votre mdp" name="change_mdpc"/>
            </td>
          </tr>
        </table>
        <tr>
        <td align="right">
        <input type="submit" value="Valider" name="change_submit"/>
      </td>
    </tr>
</form>
<?php } else { ?>
<form method="post">
   <input type="email" placeholder="Votre adresse mail" name="recup_mail"/><br/>
   <input type="submit" value="Valider" name="recup_submit"/>
</form>
<?php } ?>
<?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>'; } else { echo ""; } ?>


<script>


var mdp = document.getElementById("change_mdp")
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