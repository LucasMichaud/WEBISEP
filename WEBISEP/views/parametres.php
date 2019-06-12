
<html>
<head>
  <link rel="stylesheet" href="design/parametre.css" />
    <meta charset="utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
<title>paramètres</title> 
</head>
<body>
   
<?php if (isset($_SESSION['id'])) {
  $getid = intval($_SESSION['id']); ?>
  <div id="content">
 
   <fieldset>
       <legend>Notifications</legend>
 
       <p>
           Vous voulez recevoir vos notifications par :

           <input type="radio" name="notifications" value="sms" id="sms" /> <label for="sms">sms</label>
           <input type="radio" name="notifications" value="email" id="email" /> <label for="email">e-mail</label>
           <input type="radio" name="notifications" value="les deux" id="les deux" /> <label for="les deux">sms et e-mail</label>
           <input type="radio" name="notifications" value="aucune" id="aucune" /> <label for="aucune">Ne recevoir <strong> aucunes </strong>   notifications</label>
       </p>
   </fieldset>

<fieldset>
  <legend>Langues</legend>
     <p>
       <label for="langue">Choix de la <strong>langue</strong></label><br />
       <select name="langue" id="langue">
           <option value="français">français</option>
           <option value="espagnol">español</option>
           <option value="italien">italiano</option>
           <option value="anglais">english</option>
           <option value="chinois">中国</option>
       </select>
   </p>
</fieldset>
</form>
</div>
<?php } 
else{
    header('Location:index.php?action=connexion');
}
  ?>
</body>
</html>

