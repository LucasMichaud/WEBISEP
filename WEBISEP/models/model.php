<?php 

include "bdd.php";

/*fonction pour forum.php*/
function affichForum(){
	$bdd=bdd();
	$reqcategories=$bdd -> prepare('SELECT* FROM categorie ');
	$reqcategories->execute(array());
	return $reqcategories;
}

function forum_delete() {
	$bdd=bdd();
    $delete = $_GET['delete'];
    $reqDelete = $bdd->prepare("DELETE FROM categorie WHERE id = ?");
    $reqDelete->execute(array($delete));
    return($reqDelete);
}

function affichNbTopic($num){
	$bdd=bdd();
	$reqNbmessage=$bdd ->prepare("SELECT COUNT(titre) FROM topic WHERE id_categorie=?");
	$reqNbmessage->execute(array($num));
	$nbmessage=$reqNbmessage ->fetch();
	return $nbmessage;
}

function addCategorie($titre){
	 $bdd=bdd();
    $reqPublier = $bdd->prepare('INSERT INTO categorie(nom)  VALUES(?)');
    $reqPublier->execute(array($titre));
}



/*fonction pour categorie.php*/
function affichCategorie($selection){
	$bdd=bdd();
	$request=$bdd-> prepare("SELECT* FROM topic JOIN categorie ON topic.id_categorie=categorie.id WHERE categorie.nom='$selection'");
	$request->execute(array());
	return $request;
}
function topic_delete() {
	$bdd=bdd();
    $delete = $_GET['delete'];
    $reqDelete = $bdd->prepare("DELETE FROM topic WHERE id_topic = ?");
    $reqDelete->execute(array($delete));
    return($reqDelete);
}

/*fonctionne aussi dans le topic.php*/
function nbrMessage($num){
	$bdd=bdd();
	/*compter le nbre de message par categorie*/
	$reqNbmessage=$bdd ->prepare("SELECT COUNT(reponse) FROM message WHERE id_topic=?");
	$reqNbmessage->execute(array($num));
	$nbmessage=$reqNbmessage ->fetch();
	return $nbmessage;
}

function addTopic($selection,$titre,$pseudo,$date,$question){
	$bdd=bdd();
	$request2=$bdd-> prepare("SELECT* FROM categorie WHERE categorie.nom='$selection'");
	$request2->execute(array());
	$liste=$request2->fetch();
	$idTopic=$liste['id']; /*pour l'id de la catégorie.*/

	$reqPublier = $bdd->prepare('INSERT INTO topic(titre,author,date_topic,id_categorie,Question)  VALUES(?,?,?,"'.$idTopic.'",?)');
    $reqPublier->execute(array($titre,$pseudo,$date,$question));
}



/*partie topic.php*/
function affichQuestion($selection,$numtopic){
	$bdd=bdd();
	$request=$bdd-> query("SELECT* FROM topic JOIN categorie ON topic.id_categorie=categorie.id WHERE categorie.nom='$selection' AND topic.id_topic='$numtopic'");
	return $request;

}

function affichReponse($numtopic){
	$bdd=bdd();
	$reqReponse=$bdd -> prepare("SELECT * FROM message JOIN topic ON message.id_topic=topic.id_topic WHERE topic.id_topic='$numtopic' ORDER BY message.date_message");
	$reqReponse->execute(array());
	return $reqReponse;
}
function Reponse_delete() {
	$bdd=bdd();
    $deleteMessage = $_GET['deleteMessage'];
    $reqDelete = $bdd->prepare("DELETE FROM message WHERE id = ?");
    $reqDelete->execute(array($deleteMessage));
    return($reqDelete);
}
function addPost($id,$reponse,$pseudo,$date){
     $bdd=bdd();
    $reqPublier = $bdd->prepare('INSERT INTO message(reponse,pseudo,id_topic,date_message)  VALUES(?,?,"'.$id.'",?)');
    $reqPublier->execute(array($reponse,$pseudo,$date));
        }

/*Page Expertise*/
function catalogue(){    
     $bdd=bdd();
    $messages = $bdd->prepare('SELECT * FROM catalogue');
    $messages->execute(array());
    return $messages;
    } 

function affichFAQ(){
     $bdd=bdd();
	$reqFAQ = $bdd->prepare('SELECT * FROM post');
	$reqFAQ->execute(array());
	return $reqFAQ;
}

function addQuestion($question,$reponse){
     $bdd=bdd();
    $reqPublier = $bdd->prepare('INSERT INTO post(Question,Reponse)  VALUES(?,?)');
    $reqPublier->execute(array($question,$reponse));
    return $reqPublier;
    }
/*function FAQ_delete() {
    $connect = connect();
    $sql = "DELETE FROM post WHERE ID = '".$_POST["id"]."'";  
    mysqli_query($connect, $sql);
}*/
function FAQ_delete() {
	$bdd=bdd();
    $delete = $_GET['delete'];
    $reqDelete = $bdd->prepare("DELETE FROM post WHERE ID = ?");
    $reqDelete->execute(array($delete));
    return($reqDelete);
}

/*Lucas*/
function rooms() {
	$bdd = bdd();
	$rooms = $bdd->prepare("SELECT * FROM room WHERE HouseID = ? AND MemberID = ?");
	$rooms->execute(array($_GET['idh'],$_SESSION['id']));
	return $rooms;
}
function lamps(int $idr) {
	$bdd = bdd();
	$lamps = $bdd->prepare('SELECT * FROM lamp WHERE RoomID=?');
	$lamps->execute(array($idr));
	return $lamps;
}
function windows(int $idr) {
	$bdd = bdd();
	$windows = $bdd->prepare('SELECT * FROM window WHERE RoomID=?');
	$windows->execute(array($idr));
	return $windows;
}
function captors(int $idr) {
    $bdd = bdd();
    $captors = $bdd->prepare('SELECT * FROM captor WHERE RoomID=?');
    $captors->execute(array($idr));
    return $captors;
}
function checkl(int $getidl) {
	$bdd = bdd();
	$checkl = $bdd->prepare('SELECT LampID FROM lamp WHERE LampID = ? AND LampCondition = 1');
    $checkl->execute(array($getidl));
    return $checkl;
}
function offl($getidl) {
	$bdd = bdd();
	$offl = $bdd->prepare('UPDATE lamp SET LampCondition = 0 WHERE LampID  = ?');
    $offl->execute(array($getidl));
    return $offl;
}
function onl(int $getidl) {
	$bdd = bdd();
	$onl = $bdd->prepare('UPDATE lamp SET LampCondition = 1 WHERE LampID = ?');
    $onl->execute(array($getidl));
    return $onl;
}
function checkw(int $getidw) {
	$bdd = bdd();
	$checkw = $bdd->prepare('SELECT WindowID FROM window WHERE WindowID = ? AND WindowCondition = 1');
	$checkw->execute(array($getidw));
	return $checkw; 
}
function offw(int $getidw) {
	$bdd = bdd();
	$offw = $bdd->prepare('UPDATE window SET WindowCondition = 0 WHERE WindowID  = ?');
    $offw->execute(array($getidw));
    return $offw;
}
function onw(int $getidw) {
	$bdd = bdd();
	$onw = $bdd->prepare('UPDATE window SET WindowCondition = 1 WHERE WindowID = ?');
    $onw->execute(array($getidw));
    return $onw;
}
function insertRoom($roomTempState,$idm,$idh) {
    $bdd = bdd();
    $req = $bdd->prepare("INSERT INTO room (`RoomName`, `RoomTempState`,MemberID,HouseID) VALUES (? , ?, ?, ?)");
    $req->execute(array($_POST['roomName'],$roomTempState,$idm,$idh));
    
    $reqId = $bdd->prepare("SELECT `RoomID` FROM `room` WHERE `RoomName` = :RoomName AND HouseID = :HouseID AND MemberID = :MemberID");
	$reqId->execute(['RoomName' => $_POST['roomName'],'HouseID' => $idh,'MemberID' => $idm]);		
	$roomId= $reqId->fetch();

	$nbLamp = $_POST['nbLamp'];
    for ($i=0;$i<$nbLamp;$i++) {
		$reqLamp = $bdd->prepare("INSERT INTO `lamp`(`LampName`, `RoomID`) VALUES (:LampName,:RoomID)");
		$reqLamp->execute(['LampName'=> $_POST['nbLamp'.$i],'RoomID' => $roomId['RoomID']]);
    }
	$nbWindow = $_POST['nbWindow'];
    for ($i=0;$i<$nbWindow;$i++) {
		$reqWindow = $bdd->prepare("INSERT INTO `window`(`WindowName`, `RoomID`) VALUES (:WindowName,:RoomID)");
		$reqWindow->execute(['WindowName'=> $_POST['nbWindow'.$i],'RoomID' => $roomId['RoomID']]);
    }
    $nbCaptor = $_POST['nbCaptor'];
    for ($i=0;$i<$nbCaptor;$i++) {
		$reqCaptor = $bdd->prepare("INSERT INTO `captor`(`CaptorName`, `RoomID`) VALUES (:CaptorName,:RoomID)");
		$reqCaptor->execute(['CaptorName'=> $_POST['nbCaptor'.$i],'RoomID' => $roomId['RoomID']]);
    } 
}

function room_update($id,$text) {
    $connect = connect();
    $sql = "UPDATE room SET RoomName ='$text' WHERE RoomID ='$id'";  
    if(mysqli_query($connect, $sql))  {  
      echo 'Data Updated';  
    }    
}
function room_delete() {
    $connect = connect();
    $sql = "DELETE FROM room WHERE RoomID = '".$_POST["id"]."'";  
    mysqli_query($connect, $sql);
}
function room_insert() {
    $connect = connect();
    $sql = "INSERT INTO room(RoomID,RoomName) VALUES(".$_GET['idr'].",'".$_POST["room_name"]."')";  
    mysqli_query($connect, $sql);
}
function temp_edit($id,$temp) {
    $connect = connect();
    $sql = "UPDATE room SET RoomTempState ='$temp' WHERE RoomID ='$id'";  
    if(mysqli_query($connect, $sql))  {  
      echo 'Data Updated';  
    } 
}
function room_select() {
    $connect = connect(); 
    $sql = "SELECT * FROM room WHERE RoomID =".$_GET['idr'];  
    $result = mysqli_query($connect, $sql);
    return $result;
}
function lamp_update($id,$text) {
	$connect = connect();
	$sql = "UPDATE lamp SET LampName ='".$text."' WHERE LampID ='".$id."'";  
 	if(mysqli_query($connect, $sql))  {  
      echo 'Data Updated';  
 	}    
}
function lamp_delete() {
	$connect = connect();
    $sql = "DELETE FROM lamp WHERE LampID = '".$_POST["id"]."'";  
    mysqli_query($connect, $sql);
}
function lamp_insert() {
	$connect = connect();
    $sql = "INSERT INTO lamp(LampName,RoomID) VALUES('".$_POST["lamp_name"]."',".$_GET['idr'].")";  
    mysqli_query($connect, $sql); 
}
function lamp_select() {
	$connect = connect(); 
	$sql = "SELECT * FROM lamp WHERE RoomID =".$_GET['idr']." ORDER BY LampName ASC";  
 	$result = mysqli_query($connect, $sql);
 	return $result;
}
function window_update($id,$text) {
	$connect = connect();
	$sql = "UPDATE window SET WindowName ='$text' WHERE WindowID ='$id'";  
 	if(mysqli_query($connect, $sql))  {  
      echo 'Data Updated';  
 	}    	  
}
function window_delete() {
	$connect = connect();
    $sql = "DELETE FROM window WHERE WindowID = '".$_POST["id"]."'";  
    mysqli_query($connect, $sql);  
}
function window_insert() {
	$connect = connect();
    $sql = "INSERT INTO window(WindowName,RoomID) VALUES('".$_POST["window_name"]."',".$_GET['idr'].")";  
    mysqli_query($connect, $sql);  
}
function window_select() {
	$connect = connect(); 
	$sql = "SELECT * FROM window WHERE RoomID =".$_GET['idr']." ORDER BY WindowName ASC";  
 	$result = mysqli_query($connect, $sql);
 	return $result;
}
function captor_update($id,$text) {
	$connect = connect();
	$sql = "UPDATE captor SET CaptorName ='$text' WHERE CaptorID ='$id'";  
 	if(mysqli_query($connect, $sql))  {  
      echo 'Data Updated';  
 	}   
}
function captor_delete() {
	$connect = connect();
    $sql = "DELETE FROM captor WHERE CaptorID = '".$_POST["id"]."'";  
    mysqli_query($connect, $sql);
}
function captor_insert() {
	$connect = connect();
    $sql = "INSERT INTO captor(CaptorName,RoomID) VALUES('".$_POST["captor_name"]."',".$_GET['idr'].")";  
    mysqli_query($connect, $sql);
}
function captor_select() {
	$connect = connect(); 
	$sql = "SELECT * FROM captor WHERE RoomID =".$_GET['idr']." ORDER BY CaptorName ASC";  
 	$result = mysqli_query($connect, $sql);
 	return $result;
}


function house_update($id,$text,$column_name) {
	$connect = connect();
	$sql = "UPDATE house SET ".$column_name."='".$text."' WHERE HouseID='".$id."'";  
 	if(mysqli_query($connect, $sql))  {  
      echo 'Data Updated';  
 	}   
}
function house_delete() {
	$connect = connect();
    $sql = "DELETE FROM house WHERE HouseID = '".$_POST["id"]."'";  
    mysqli_query($connect, $sql);
}
function house_insert() {
	$connect = connect();
    $sql = "INSERT INTO house(HouseName,MemberID,HouseAddress,HousePostal,HouseTown) VALUES('".$_POST["house_name"]."',".$_POST["idm"].",'".$_POST["house_address"]."','".$_POST["house_postal"]."','".$_POST["house_town"]."')";  
    mysqli_query($connect, $sql);
}
function house_select() {
	$connect = connect(); 
	$sql = "SELECT * FROM house WHERE MemberID =".$_POST["idm"];  
 	$result = mysqli_query($connect, $sql);
 	return $result;
}
function house($idm) {
	$bdd = bdd();
	$house = $bdd->prepare("SELECT * FROM house WHERE MemberID = ? ");
	$house->execute(array($idm));
	return $house;
}
function house_active($idh,$idm) {
	$bdd = bdd();
	$house = $bdd->prepare("SELECT HouseName FROM house WHERE HouseID = ? AND MemberID = ? ");
	$house->execute(array($idh,$idm));
	return $house;
}

function house_fav($idh,$idm) {
	$bdd = bdd();
	$fav = $bdd->prepare("UPDATE membres SET fav = ? WHERE id = ?");
	$fav->execute(array($idh,$idm));
} 	

function fav($idm) {
	$bdd = bdd();
	$fav = $bdd->prepare("SELECT fav FROM membres WHERE id = ?");
	$fav->execute(array($idm));
	return $fav;
}

function temp_update($temp) {
	$connect = connect();
	$sql = "UPDATE room SET RoomTemp ='$temp' WHERE RoomID =".$_GET['idr'];
	mysqli_query($connect, $sql);
}

/*Minh Nam*/


function inscrire($nom, $prenom, $adresse, $code,$ville)
{
	$bdd=bdd();
	$reqnom = $bdd->prepare("SELECT * FROM membres WHERE nom = ?");
    $reqnom->execute(array($nom));

    $reqprenom = $bdd->prepare("SELECT * FROM membres WHERE prenom = ?");
    $reqprenom->execute(array($prenom));

    $reqadresse = $bdd->prepare("SELECT * FROM membres WHERE adresse = ?");
	$reqadresse->execute(array($adresse));

	$reqcode = $bdd->prepare("SELECT * FROM membres WHERE codepostal = ?");
	$reqcode->execute(array($code));

	$reqville = $bdd->prepare("SELECT * FROM membres WHERE ville = ?");
	$reqville->execute(array($ville));
}


function SeConnecter($pseudoconnect,$mdpconnect){
	$bdd=bdd();
	$requser = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ? AND motdepasse = ?");
	$requser->execute(array($pseudoconnect,$mdpconnect));
	return $requser;	
}

function ExistPseudo($pseudo){
    $bdd = bdd();
    $reqpseudo = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ?");
	$reqpseudo->execute(array($pseudo));
	$pseudoexist=$reqpseudo->rowCount();
	return $pseudoexist;
}

function ExistMail($mail){
	$bdd = bdd();
	$reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
	$reqmail->execute(array($mail));
	$mailexist=$reqmail->rowCount();
	return $mailexist;
}

function AddUser($pseudo,$mail,$mdp,$key,$nom,$prenom,$adresse,$code,$ville){
	$bdd = bdd();
	$insertmbr = $bdd->prepare("INSERT INTO membres(pseudo,mail,motdepasse, confirmkey,nom,prenom,adresse,codepostal,ville) VALUES(?,?,?,?,?,?,?,?,?)");
	$insertmbr->execute(array($pseudo,$mail,$mdp,$key,$nom,$prenom,$adresse,$code,$ville));
}
function AffichEditProfil($VerifId){
	$bdd = bdd();
	$requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
   	$requser->execute(array($VerifId));
   	$user = $requser->fetch();
   	return $user;
}

 function EditProfil($VerifId){
 	$bdd = bdd();
    $user= AffichEditProfil($VerifId);
   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
      $newmail = htmlspecialchars($_POST['newmail']);
      $insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ?");
      $insertmail->execute(array($newmail, $_SESSION['id']));
      header('Location: index.php?action=profil');
   }
   if(isset($_POST['newadresse']) AND !empty($_POST['newadresse']) AND $_POST['newadresse'] != $user['adresse']) {
      $newadresse = htmlspecialchars($_POST['newadresse']);
      $insertadresse = $bdd->prepare("UPDATE membres SET adresse = ? WHERE id = ?");
      $insertadresse->execute(array($newadresse, $_SESSION['id']));
      header('Location: index.php?action=profil');
   }
   if(isset($_POST['newcode']) AND !empty($_POST['newcode']) AND $_POST['newcode'] != $user['codepostal']) {
      $newcode = htmlspecialchars($_POST['newcode']);
      $insertadressecode = $bdd->prepare("UPDATE membres SET codepostal = ? WHERE id = ?");
      $insertcode->execute(array($newcode, $_SESSION['id']));
      header('Location: index.php?action=profil');
   }
   if(isset($_POST['newville']) AND !empty($_POST['newville']) AND $_POST['newville'] != $user['ville']) {
      $newville = htmlspecialchars($_POST['newville']);
      $insertville = $bdd->prepare("UPDATE membres SET ville = ? WHERE id = ?");
      $insertville->execute(array($newville, $_SESSION['id']));
      header('Location: index.php?action=profil');
   }
   if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
      $mdp1 = sha1($_POST['newmdp1']);
      $mdp2 = sha1($_POST['newmdp2']);
      if($mdp1 == $mdp2) {
         $insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['id']));
         header('Location: index.php?action=profil');
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }


 }

 function Administrationutilisateurs()
 {
 	$bdd = bdd();
	$getid = intval($_GET['id']);
	$requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();
	return $userinfo;

 }


 function Administrationconfirme()
 {
 	$bdd = bdd();
	$confirme = (int) $_GET['confirme'];
	$req =  $bdd -> prepare('UPDATE membres SET confirme = 1 WHERE id = ?');
	$req->execute(array($confirme));
	return $req;	
}

function Administrationdelete()
{
	$bdd = bdd();
	$delete = (int) $_GET['delete'];
	$req =  $bdd -> prepare('DELETE FROM membres  WHERE id = ?');
	$req->execute(array($delete));	
	return $req;

}

function Recuperationmail($recup_mail)
{
	$bdd = bdd();
	$mailexist = $bdd->prepare('SELECT id,pseudo FROM membres WHERE mail = ?');
    $mailexist->execute(array($recup_mail));
    $mailexist_count = $mailexist->rowCount();
    return $mailexist_count;

}

function Testmailexist($recup_mail)
{
	$bdd = bdd();
	$mail_recup_exist = $bdd->prepare('SELECT id FROM recuperation WHERE mail = ?');
    $mail_recup_exist->execute(array($recup_mail));
    $mail_recup_exist = $mail_recup_exist->rowCount();
    return $mail_recup_exist;
}

function Mailexist($recup_code,$recup_mail)
{
	$bdd = bdd();
	$recup_insert = $bdd->prepare('UPDATE recuperation SET code = ? WHERE mail = ?');
    $recup_insert->execute(array($recup_code,$recup_mail));
}

function Mailnotexist($recup_mail,$recup_code)
{
	$bdd = bdd();
	 $recup_insert = $bdd->prepare('INSERT INTO recuperation(mail,code) VALUES (?, ?)');
     $recup_insert->execute(array($recup_mail,$recup_code));
}

function Verificationcode($verif_code)
{
	$bdd = bdd();
	$verif_req = $bdd->prepare('SELECT id FROM recuperation WHERE mail = ? AND code = ?');
    $verif_req->execute(array($_SESSION['recup_mail'],$verif_code));
    $verif_req = $verif_req->rowCount();
    return $verif_req;
}
function Verificationconfirmed()
{
	$bdd = bdd();
	$up_req = $bdd->prepare('UPDATE recuperation SET confirme = 1 WHERE mail = ?');
    $up_req->execute(array($_SESSION['recup_mail']));
}
function TestVerification()
{
	$bdd = bdd();
	$verif_confirme = $bdd->prepare('SELECT confirme FROM recuperation WHERE mail = ?');
    $verif_confirme->execute(array($_SESSION['recup_mail']));
    $verif_confirme = $verif_confirme->fetch();
    $verif_confirme = $verif_confirme['confirme'];
    return $verif_confirme;
}
function Reinitialisationmdp($mdp)
{
	$bdd = bdd();
	$ins_mdp = $bdd->prepare('UPDATE membres SET motdepasse = ? WHERE mail = ?');
    $ins_mdp->execute(array($mdp,$_SESSION['recup_mail']));
    $del_req = $bdd->prepare('DELETE FROM recuperation WHERE mail = ?');
    $del_req->execute(array($_SESSION['recup_mail']));
}

?>