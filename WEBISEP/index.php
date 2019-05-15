<?php

include ("controllers/controller.php");

if(isset($_GET["action"]) && !empty($_GET['action'])){
    $action = htmlspecialchars($_GET["action"]);
    switch ($action) {
        case 'forum':
            forum();
            break;
        case 'categorie':
            categorie();
            break;
        case 'topic':
            topic();
            break;
        case 'messagerie':
            messagerie();
            break;
        case 'billet':
            billet();
            break;
        case 'accueil':
            accueil();
            break;
        case 'expertise':
            expertise();
            break;
        case 'FAQ':
            FAQ();
            break;
        case 'AProposDeNous':
            AProposDeNous();
            break;
            
            /*Lucas*/
        case 'maison':
            maison();
            break;
        case 'actionLamp':
            actionLamp();
            break;
        case 'actionWindow':
            actionWindow();
            break;
        case 'vertical':
            vertical();
            break;
        case 'addRoom':
            addRoom();
            break;
        case 'editRoom':
          editRoom();
          break;
        case 'lamp_remove':
          lamp_remove();
          break;
        case 'lamp_add':
          lamp_add();
          break;
        case 'lamp_fetch':
          lamp_fetch();
          break;
        case 'lamp_edit':
          lamp_edit();
          break;
        case 'window_remove':
          window_remove();
          break;
        case 'window_add':
          window_add();
          break;
        case 'window_fetch':
          window_fetch();
          break;
        case 'window_edit':
          window_edit();
          break;
        case 'captor_remove':
          captor_remove();
          break;
        case 'captor_add':
          captor_add();
          break;
        case 'captor_fetch':
          captor_fetch();
          break;
        case 'captor_edit':
          captor_edit();
          break;
        case 'room_remove':
          room_remove();
          break;
        case 'room_add':
          room_add();
          break;
        case 'room_fetch':
          room_fetch();
          break;
        case 'room_edit':
          room_edit();
          break;
        case 'room_temp':
          room_temp();
          break;
        case 'house_remove':
          house_remove();
          break;
        case 'house_add':
          house_add();
          break;
        case 'house_fetch':
          house_fetch();
          break;
        case 'house_edit':
          house_edit();
          break;
        case 'favHouse':
          favHouse();
          break;
         case 'cat_remove':
          cat_remove();
          break;
        case 'cat_add':
          cat_add();
          break;
        case 'cat_fetch':
          cat_fetch();
          break;
        case 'cat_edit':
          cat_edit();
          break;
        case 'cat':
            cat();


        case 'thermometer':
          thermometer();
          break;
        case 'status_remove':
          status_remove();
          break;
        case 'status_add':
          status_add();
          break;
        case 'status_fetch':
          status_fetch();
          break;
        case 'status_edit':
          status_edit();
          break;
          
            /*Minh Nam*/
        case 'inscription':
            inscription();
            break;
        case 'connexion':
            connexion();
            break;
        case 'profil':
            profil();
            break;
        case 'deconnexion':
            deconnexion();
            break;
        case 'editionprofil':
            editionprofil();
            break;
        case 'administration':
            administration();
            break;
        case 'parametre':
            parametre();
            break;
        case 'contact';
            contact();
            break;
        case 'statistique':
            statistique();
            break;
        case 'recuperation';
            recuperation();
            break;
        case 'confirmation';
            confirmation();
            break;
    }
} else {
    accueil();
}
?>