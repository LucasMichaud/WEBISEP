<?php 

include "models/model.php";

/*Forum*/
function forum() {
  $reqcategories= affichForum();
  if (isset($_POST['publier']))
        {  
        session_start();
        $titre=$_POST['ajout'];
      
    addCategorie($titre);
    $url="index.php?action=forum";
    header("Location:".$url);
  }
  if(isset($_GET['delete']) AND !empty($_GET['delete'])){
      forum_delete();

      $url="index.php?action=forum";
      header("Location:".$url);
    }
    include "views/forum.php";
}
function categorie(){

  $selection =$_GET['var'];
  $request=affichCategorie($selection);
  
  if (isset($_POST['publier']))
        {  
        session_start();
        date_default_timezone_set( 'Europe/Paris' );
        $titre=$_POST['titre'];
      $question=$_POST['Question'];
      $pseudo=$_SESSION['pseudo'];
      $date=date("Y-m-d H:i:s");
    addTopic($selection,$titre,$pseudo,$date,$question);
    $url="index.php?action=categorie&var=".$selection;
    header("Location:".$url);
  }
  else{
    // nothing to do: pas de nouveau topic
  }
  if(isset($_GET['delete']) AND !empty($_GET['delete'])){
      topic_delete();

      $url="index.php?action=categorie&var=".$selection;
      header("Location:".$url);
    }

    include "views/categorie.php";
}

function topic(){
  $selection =$_GET['var'];
  $numtopic=$_GET['numtopic'];
  $request=affichQuestion($selection,$numtopic);
  $reqReponse=affichReponse($numtopic);

    if (isset($_POST['publier']))
    {  
      session_start();
      date_default_timezone_set( 'Europe/Paris' );
      $reponse=$_POST['reponse'];
          $pseudo=$_SESSION['pseudo'];
          $date=date("Y-m-d H:i:s");
          addPost($numtopic,$reponse,$pseudo,$date);

    /*redirection*/
    $url="index.php?action=topic&var=".$selection."&numtopic=".$numtopic;
    header("Location:".$url);
}
if(isset($_GET['deleteMessage']) AND !empty($_GET['deleteMessage'])){
      Reponse_delete();
    $url="index.php?action=topic&var=".$selection."&numtopic=".$numtopic;
    header("Location:".$url);
    }
  include"views/topic.php";
}

/*Accueil*/
function accueil(){
  include 'views/Accueil.php';
}
/*parametre*/
function parametre(){
    include 'views/parametres.php';
}

/*Expertise*/
function expertise(){
  $messages=catalogue();
  include 'views/Expertise.php';
}

/*FAQ*/
function FAQ(){
  $reqFAQ=affichFAQ();
   if (isset($_POST['publier']))
        {
            $question=$_POST['question'];
            $reponse=$_POST['reponse'];
            $reqPublier=addQuestion($question,$reponse);
            header("Location:index.php?action=FAQ");

        }
        else{
          /*nothing to do : pas de nouvelle question*/
        }
    if(isset($_GET['delete']) AND !empty($_GET['delete'])){
      FAQ_delete();
      header("Location:index.php?action=FAQ");
    }
  include 'views/FAQ.php';
}

/*A propos de nous*/
function AProposDeNous(){
	include 'views/About.php';

}

/*Lucas*/
function maison() {
    include "views/maison.php";
}
function vertical() {
    include "views/vertical.php";
}
function general() {
    include "views/general.php";
}
function actionLamp() {
    if(isset($_GET['idl']) AND !empty($_GET['idl'])) {
        $getidl = (int) $_GET['idl'];
        $checkl = checkl($getidl);
        if($checkl->rowCount() == 1) {
            offl($getidl);
        } else {
            onl($getidl);
        } 
    include "views/maison.php";
    } 
}
function actionWindow() {
    if(isset($_GET['idw']) AND !empty($_GET['idw'])) {
        $getidw = (int) $_GET['idw'];
        $checkw = checkw($getidw);
        if($checkw->rowCount() == 1) {
            offw($getidw);
        } else {
            onw($getidw);
        } 
    include "views/maison.php";
    } 
}
function addRoom() {
  include "views/General.php";
  include "views/addRoom.php";
  if (!empty($_SESSION['id'])) {
    if (isset($_POST['roomName'])) {
        $roomTempState = 0;
        roomTemp($roomTempState);
        $idm = intval($_SESSION['id']);
        insertRoom($roomTempState,$idm,$idh);
        $message = "Pièce ajoutée";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
  }
}
function editRoom() {
  $idr = (int) $_GET['idr'];
  $idh = (int) $_GET['idh'];
  include "views/editRoom.php";
}

function roomTemp($roomTempState) {
    if (empty($_POST['roomTemp'])) {
        $roomTempState = 0;
    }
    return $roomTempState;
}

function room_add() {
  room_insert();
}

function room_remove() {
  room_delete();
}

function room_fetch() {
  $output = '';
  $row = 0;
  $result = room_select();
  $idh = $_GET['idh'];
  $output .= '  
    <div>  
      <div id="top">Nom de la pièce</div>
      <div id="bot"><table> '; 
  while($row = mysqli_fetch_array($result)) {  
    if(mysqli_num_rows($result) > 0) {    
      $output .= '
        <tr>
          <td class="room_name" data-id1="'.$row["RoomID"].'" contenteditable>'.$row["RoomName"].'</td>   
          <td><a href="index.php?action=maison&idh='.$idh.'"><button type="button" name="btn_delete_room" data-id2="'.$row["RoomID"].'" class="btn_delete_room"><i class="material-icons">delete</i></button></a></td>  
        </tr>';   
    }
    else {  
      $output .= '
            <tr>  
              <td class="noName" id="room_name" contenteditable>Pas de nom</td>    
              <td><button type="button" name="btn_add_room" id="btn_add_room"><i class="material-icons">add</i></button></td>  
            </tr>';
    }
    $roomTempText = "";
    if ($row["RoomTempState"] == 1) {
      $roomTempText = "checked";
    }
    $output .= '        
          <tr>      
            <td>Température ?</td>   
            <td>
              <label class="switch">
                <input type="checkbox" data-id3="'.$row["RoomID"].'" '.$roomTempText.' class="btn_temp">
                <span class="slider"></span>
              </label>
            </td>  
          </tr>
        </table>
        </div>  
      </div>';
    
  }
  echo $output;  
}

function room_edit() {
  $id = (int) $_POST["id"];  
  $text = $_POST["text"];    
  room_update($id,$text);
}

function room_temp() { 
  $id = (int) $_POST["id"];  
  $text = $_POST["text"];    
  temp_edit($id,$text);
}

function lamp_add() {
  lamp_insert();
}

function lamp_remove() {
  lamp_delete();
}

function lamp_fetch() {
  $output = '';
  $result = lamp_select();
  $output .= '  
      <div>  
            <div id="top">Lampes</div>
            <div id="bot"><table> ';  
  if(mysqli_num_rows($result) > 0)  
  {  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>    
                     <td class="lamp_name" data-id1="'.$row["LampID"].'" contenteditable>'.$row["LampName"].'</td>   
                     <td><button type="button" name="btn_delete_lamp" data-id2="'.$row["LampID"].'" class="btn_delete_lamp"><i class="material-icons">delete</i></button></td>  
                </tr>  
           ';  
      }  
  }  
 else  
  {  
      $output .= '<tr>  
                          <td>No Lamp</td>  
                     </tr>';  
  }  
  $output .='  
           <tr>  
                <td id="lamp_name" contenteditable>Nouvelle Lampe</td>    
                <td><button type="button" name="btn_add_lamp" id="btn_add_lamp"><i class="material-icons">add</i></button></td>  
           </tr>
           </table>
        </div>  
      </div>';  
  echo $output;  
}

function lamp_edit() {
  $id = (int) $_POST["id"];  
  $text = $_POST["text"];    
  lamp_update($id,$text);
}  

function window_add() {
  window_insert();
}

function window_remove() {
  window_delete();
}

function window_fetch() {
  $output = '';
  $result = window_select();
  $output .= '  
      <div>  
           <div id="top">Fenêtres</div>
            <div id="bot"><table> '; 
  if(mysqli_num_rows($result) > 0)  
  {  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>    
                     <td class="window_name" data-id1="'.$row["WindowID"].'" contenteditable>'.$row["WindowName"].'</td>   
                     <td><button type="button" name="btn_delete_window" data-id2="'.$row["WindowID"].'" class="btn_delete_window"><i class="material-icons">delete</i></button></td>  
                </tr>  
           ';  
      }  
  }  
 else  
  {  
      $output .= '<tr>  
                          <td>No Window</td>  
                     </tr>';  
  }  
  $output .='  
           <tr>  
                <td id="window_name" contenteditable>Nouvelle Fenêtre</td>    
                <td><button type="button" name="btn_add_window" id="btn_add_window"><i class="material-icons">add</i></button></td>  
           </tr>
           </table>
        </div> 
      </div>';  
  echo $output;  
}

function window_edit() {
  $id = (int) $_POST["id"];  
  $text = $_POST["text"];    
  window_update($id,$text);
}

function captor_add() {
  captor_insert();
}

function captor_remove() {
  captor_delete();
}

function captor_fetch() {
  $output = '';
  $result = captor_select();
  $output .= '  
      <div>  
           <div id="top">Capteurs</div>
            <div id="bot"><table> ';
  if(mysqli_num_rows($result) > 0)  
  {  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>    
                     <td class="captor_name" data-id1="'.$row["CaptorID"].'" contenteditable>'.$row["CaptorName"].'</td>   
                     <td><button type="button" name="btn_delete_captor" data-id2="'.$row["CaptorID"].'" class="btn_delete_captor"><i class="material-icons">delete</i></button></td>  
                </tr>  
           ';  
      }  
  }  
 else  
  {  
      $output .= '<tr>  
                          <td>No Captor</td>  
                     </tr>';  
  }  
  $output .='  
           <tr>  
                <td id="captor_name" contenteditable>Nouveau Capteur</td>    
                <td><button type="button" name="btn_add_captor" id="btn_add_captor"><i class="material-icons">add</i></button></td>  
           </tr>
           </table>
        <div> 
      </div>';  
  echo $output;  
}

function captor_edit() {
  $id = $_POST["id"];  
  $text = $_POST["text"];    
  captor_update($id,$text);
}

function house_add() {
  house_insert();
}

function house_remove() {
  house_delete();
}

function house_fetch() {
  $output = '';
  $row = 0;
  $result = house_select();
  $output .= '  
      <table id="houses">
            <th>Nom</th>
            <th>Adresse</th>
            <th>Code Postal</th>
            <th>Ville</th>
            <th></th>'; 
  
  if(mysqli_num_rows($result) > 0) { 
    while($row = mysqli_fetch_array($result)) {     
      $output .= '
        <tr>
          <td class="house_name" data-id1="'.$row["HouseID"].'" contenteditable>'.$row["HouseName"].'</td>
          <td class="house_address" data-id2="'.$row["HouseID"].'" contenteditable>'.$row["HouseAddress"].'</td>
          <td class="house_postal" data-id3="'.$row["HouseID"].'" contenteditable>'.$row["HousePostal"].'</td> 
          <td class="house_town" data-id4="'.$row["HouseID"].'" contenteditable>'.$row["HouseTown"].'</td>   
          <td><button type="button" name="btn_delete_house" data-id5="'.$row["HouseID"].'" class="btn_delete_house"><i class="material-icons">delete</i></button></td>
            
        </tr>';   
    }
  }
  else {  

  }
    $output .= '
            <tr> 
              <td id="house_name" contenteditable>Nouvelle maison</td>
              <td id="house_address" contenteditable>Adresse</td>
              <td id="house_postal" contenteditable>Code Postal</td>
              <td id="house_town" contenteditable>Ville</td>   
              <td><button type="button" name="btn_add_house" id="btn_add_house"><i class="material-icons">add</i></button></td>  
            </tr>
          </table>';
  $image = house_select();
 
  echo $output;  
}

function house_edit() {
  $id = (int) $_POST["id"];  
  $text = $_POST["text"];
  $column_name = $_POST["column_name"];   
  house_update($id,$text,$column_name);
}


function favHouse() {
    include "views/General.php";
    if (isset($_POST['fav'])) {
        $idh = $_POST['fav'];
        $idm = intval($_SESSION['id']);
        house_fav($idh,$idm);
        header('Location: index.php?action=parametre');
    }
    include "views/parametres.php";
}


function thermometer() {
  $roomTempReq = "liieirf";
  /*$temp = $_POST["temp"];  
  temp_update($temp);*/
}


/*Partie Minh Nam*/
function inscription(){
  
    if(isset($_POST['forminscription']))
{
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);

    $adresse = htmlspecialchars($_POST['adresse']);
    $code = htmlspecialchars($_POST['code']);
    $ville = htmlspecialchars($_POST['ville']);

    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);
    
    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['adresse']) AND !empty($_POST['code']) AND !empty($_POST['ville']))
    {
        inscrire($nom,$prenom,$adresse,$code,$ville);
        $pseudoexist=ExistPseudo($pseudo);
        if($pseudoexist==0)
        {
            $pseudolength = strlen($pseudo);
            if($pseudolength<=255)
            {
                if ($mail == $mail2)
                {
                    if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                    {
                        
                        $mailexist=ExistMail($mail);
                        if($mailexist==0)
                        {
                            if ($mdp==$mdp2)
                            {
                                $pattern = '/(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/';
                                if(preg_match($pattern, $_POST['mdp'] )) 
                                {
                                    $longueurKey = 15;
                                    $key = "";
                                    for($i=1;$i<$longueurKey;$i++)
                                    {
                                        $key .= mt_rand(0,9);
                                    }
                                    AddUser($pseudo,$mail,$mdp,$key,$nom,$prenom,$adresse,$code,$ville);
                                    $header="MIME-Version: 1.0\r\n";
                                    $header.='From:"WebISep"<domisepg4@gmail.com>'."\n";
                                    $header.='Content-Type:text/html; charset="uft-8"'."\n";
                                    $header.='Content-Transfer-Encoding: 8bit';
                                    $message='
                                    <html>
                                        <body>
                                            <div align="center">
                                                <a href="http://localhost/SiteDomisep/index.php?action=confirmation&pseudo='.urlencode($pseudo).'&key='.$key.'">Confirmer votre compte</a>
                                            </div>
                                        </body>
                                    </html>
                                    ';
                                    mail($mail, "Confirmation de compte", $message, $header);
                                    $erreur = "Votre compte a bien été crée <a href=\"index.php?action=connexion\">Me connecter</a>" ;

                                }
                                else{
                                    $erreur = " Votre mot de passe ne contient pas un caractère spécial, une lettre minuscule, une lettre majuscule, un chiffre ou ne dépasse pas 6 caractères. ";}
                            }
                            else{ $erreur = "Vos mots de passe ne correspondent pas";}
                        }
                        else{$erreur = "Adresse mail déjà utilisée";
                        }
                    }
                    else {
                        $erreur = "Votre adresse mail n'est pas valide";
                    }  
                }
                else{
                    $erreur = "Vos adresses mails ne correspondent pas";
                }
            }
            else{ $erreur = "Votre pseudo ne doit pas dépasser 255 caractères";
            }
        }
        else{ $erreur = "Votre pseudo a déjà été utilisé";
        }
    }
    else
    {
        $erreur= "Tous les champs doivent être complétés";
    }
}
include "views/Inscription.php";

}

function connexion(){
    $bdd = bdd();
    if(isset($_POST['formconnexion']))
    {
        $pseudoconnect = htmlspecialchars(($_POST['pseudoconnect']));
        $mdpconnect=sha1($_POST['mdpconnect']);
        if(!empty($pseudoconnect) AND !empty($mdpconnect))
        {
            $requser=SeConnecter($pseudoconnect,$mdpconnect);
            if($requser->rowCount()==1)
            {
                $userinfo = $requser->fetch();
                if($userinfo['confirme']==1 AND $userinfo['admin']==0)
                {
                    session_start();
                    $_SESSION['id'] = $userinfo['id'];
                    $_SESSION['pseudo'] = $userinfo['pseudo'];
                    $_SESSION['mail'] = $userinfo['mail'];
                    $_SESSION['admin'] = $userinfo['admin'];
                    header("Location: index.php?action=profil");
                }
                elseif ($userinfo['confirme']==1 AND $userinfo['admin']==1)
                {
                    session_start();
                    $_SESSION['id'] = $userinfo['id'];
                    $_SESSION['pseudo'] = $userinfo['pseudo'];
                    $_SESSION['mail'] = $userinfo['mail'];
                    $_SESSION['admin'] = $userinfo['admin'];
                    header("Location: index.php?action=administration");
                }
                else
                {   
                    $erreur = "Votre compte n'a pas été confirmé !";
                }
            }
            else
            {
                $erreur= "Votre pseudo et mot de passe ne correspondent pas ";
            }
        }
        else
        {
            $erreur = "Tous les champs doivent être complétés";
        }
    }
      include "views/Connexion.php";
}

function profil (){
  include "views/profil.php";
}

function deconnexion(){
  include "views/deconnexion.php";  
}

function editionprofil(){
    if(isset($_POST['publier'])){
    session_start();
    $VerifId=$_SESSION['id'];
    EditProfil($VerifId);}
    include "views/editionprofil.php";
}

function contact(){

if(isset($_POST['sendmail']))
 {
   if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['message'])) 
   {
        $header="MIME-Version: 1.0\r\n";
        $header.='From:"WebISep"<domisepg4@gmail.com>'."\n";
        $header.='Content-Type:text/html; charset="uft-8"'."\n";
        $header.='Content-Transfer-Encoding: 8bit';
      $message='
      <html>
         <body>
            <div align="center">
               <u>Nom de l\'expéditeur :</u>'.$_POST['pseudo'].'<br />
               <u>Mail de l\'expéditeur :</u>'.$_POST['mail'].'<br />
               <br />
               '.nl2br($_POST['message']).'
               <br />
            </div>
         </body>
      </html>
      ';
      mail("domisepg4@gmail.com", "DomIsep", $message, $header);
      $msg="Votre message a bien été envoyé !";
   } 
   else 
   {
      $msg="Tous les champs doivent être complétés !";
   }
 }  
 include"views/Contact.php";
}

function administration(){
    $bdd=bdd();
    if(isset($_GET['id']) AND $_GET['id']>0)
    {
        Administrationutilisateur();
    }
    if(isset($_GET['confirme']) AND !empty($_GET['confirme']))
    {
       Administrationconfirme();   
    }
    if(isset($_GET['delete']) AND !empty($_GET['delete']))
    {
        Administrationdelete();
    }
    $membres = $bdd->query('SELECT * FROM membres');
    include "views/Administration.php";
}


function recuperation(){
$bdd=bdd();
session_start();
if(isset($_GET['section'])) {

$section = htmlspecialchars($_GET['section']);

} else {

$section = "";

}

if(isset($_POST['recup_submit'],$_POST['recup_mail'])) {
   if(!empty($_POST['recup_mail'])) {
      $recup_mail = htmlspecialchars($_POST['recup_mail']);
      if(filter_var($recup_mail,FILTER_VALIDATE_EMAIL)) {
          $mailexist = $bdd->prepare('SELECT id,pseudo FROM membres WHERE mail = ?');
          $mailexist->execute(array($recup_mail));
          $mailexist_count = $mailexist->rowCount();
         if($mailexist_count == 1) {
            $pseudo = $mailexist->fetch();
            $pseudo = $pseudo['pseudo'];
            
            $_SESSION['recup_mail'] = $recup_mail;
            $recup_code = "";
            for($i=0; $i < 8; $i++) { 
               $recup_code .= mt_rand(0,9);
            }
            $mail_recup_exist=Testmailexist($recup_mail);
            if($mail_recup_exist == 1) {
               Mailexist($recup_code,$recup_mail);
            } else {
               Mailnotexist($recup_mail,$recup_code);
             }
            

        $header="MIME-Version: 1.0\r\n";
        $header.='From:"WebISep"<domisepg4@gmail.com>'."\n";
        $header.='Content-Type:text/html; charset="uft-8"'."\n";
        $header.='Content-Transfer-Encoding: 8bit';
        $message = '
        <html>
        <head>
          <title>Récupération de mot de passe</title>
          <meta charset="utf-8" />
        </head>
        <body>
          <font color="#303030";>
            <div align="center">
              <table width="600px">
                <tr>
                  <td>
                    
                    <div align="center">Bonjour <b>'.$pseudo.'</b>,</div>
                    Voici votre code de récupération: <b>'.$recup_code.'</b>
                    
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    <font size="2">
                      Ceci est un email automatique, merci de ne pas y répondre
                    </font>
                  </td>
                </tr>
              </table>
            </div>
          </font>
        </body>
        </html>
        ';
        mail($recup_mail, "Mot de passe oublié", $message, $header);
        header("Location:index.php?action=recuperation&section=code");

      }
      else
      {
        $error = "Cette adresse mail n'existe pas";
      }
    }
    else{
      $error="Adresse mail invalide";
    }
  }
  else
  {
    $error= "Veuillez entrer votre adresse mail";
  }
}


if(isset($_POST['verif_submit'],$_POST['verif_code'])) {
   if(!empty($_POST['verif_code'])) {
      $verif_code = htmlspecialchars($_POST['verif_code']);
      $verif_req=Verificationcode($verif_code);
      if($verif_req == 1) {
         Verificationconfirmed();
         header('Location:index.php?action=recuperation&section=changemdp');
      } else {
         $error = "Code invalide";
      }
   } else {
      $error = "Veuillez entrer votre code de confirmation";
   }
}
if(isset($_POST['change_submit'])) {  
   if(isset($_POST['change_mdp'],$_POST['change_mdpc'])) {
      $verif_confirme=TestVerification();
      if($verif_confirme == 1) {
         $mdp = htmlspecialchars($_POST['change_mdp']);
         $mdpc = htmlspecialchars($_POST['change_mdpc']);
         if(!empty($mdp) AND !empty($mdpc)) {
            if($mdp == $mdpc) {
              $pattern = '/(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/';
              $mdp = sha1($mdp);
              if(preg_match($pattern, $_POST['change_mdp'] )) 
              {
                Reinitialisationmdp($mdp);
                header('Location:index.php?action=connexion');
             }
             else
             {
                  $error = " Votre mot de passe ne contient pas un caractère spécial, une lettre minuscule, une lettre majuscule, un chiffre ou ne dépasse pas 6 caractères. ";
             }
            } else {
               $error = "Vos mots de passes ne correspondent pas";
            }
         } else {
            $error = "Veuillez remplir tous les champs";
         }
      } else {
         $error = "Veuillez valider votre mail grâce au code de vérification qui vous a été envoyé par mail";
      }
   } else {
      $error = "Veuillez remplir tous les champs";
   }
}
 include"views/Recuperation.php";
}

function confirmation()
{
  $bdd = bdd();
  if(isset($_GET['pseudo'], $_GET['key']) AND !empty($_GET['pseudo']) AND !empty($_GET['key']))
  {
    $pseudo = htmlspecialchars(urldecode($_GET['pseudo']));
    $key = intval($_GET['key']);
    $requser = $bdd->prepare("SELECT * FROM membres WHERE pseudo  = ? AND confirmkey = ?");
    $requser->execute(array($pseudo, $key));
    $userexist= $requser->rowCount();
    if($userexist == 1)
    {
      $user = $requser->fetch();
      if($user['confirme']==0)
      {
        $updateuser = $bdd->prepare("UPDATE membres SET confirme = 1 WHERE pseudo = ? AND confirmkey = ? ");
        $updateuser-> execute(array($pseudo,$key));
        header('Location:index.php?action=connexion');
        echo "Votre compte a bien été crée";
        
      }
      else
      {
        echo "Votre compte a déjà été confirmé";
      }
    }
    else
    {
      echo "L'utilisateur n'existe pas";
    }
  }
}

function statistique(){
        include"views/Statistique.php";
}


?>
