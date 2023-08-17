<?php
require_once "database/models/users.php";
require_once 'libraries/cleaners.php';

function registerController(){
    if(isset($_POST['lastname'], $_POST['firstname'], $_POST['username'], $_POST['password'])){
        $lastname = cleanUpInput($_POST['lastname']);
        $firstname = cleanUpInput($_POST['firstname']);
        $username = cleanUpInput($_POST['username']);
        $password = cleanUpInput($_POST['password']);

        try {
            addUser($firstname, $lastname, $username, $password);
            header("Location: /login"); 
        } catch (PDOException $e){
            echo "Virhe tietokantaan tallennettaessa: " . $e->getMessage();
        }
    } else {
        require "views/register.view.php";
    }
}

function loginController(){
    if(isset($_POST['nimi'], $_POST["sposti"], $_POST['salasana'])){
        $nimi = cleanUpInput($_POST['nimi']);
        $sposti = cleanUpInput($_POST["sposti"]);
        $salasana = cleanUpInput($_POST['salasana']);
        $kayttaja = getUsers($sposti);

        $result = login($nimi, $sposti, $salasana);#oppilaan ja opettaan kirjautuminen johtaa vielä samaan paikkaan, kun oppilaalle ja opettajalle on omat näkymät lisää ne alle

        if ($result && $kayttaja['opettaja'] == "opettaja"){ #opettajan kirjautuminen
            $_SESSION['nimi'] = $result['nimi'];
            $_SESSION["sposti"] = $result["sposti"];
            $_SESSION['kayttajaID'] = $result['kayttajaID']; 
            $_SESSION['session_id'] = session_id();
            header("Location: /");  #lisää tähän mihin opettaja ohjataan kirjautumisen jälkeen
        }
        else if($result){ #oppilaan kirjautuminen
            $_SESSION['nimi'] = $result['nimi'];
            $_SESSION["sposti"] = $result["sposti"];
            $_SESSION['kayttajaID'] = $result['kayttajaID'];    
            $_SESSION['session_id'] = session_id();
            header("Location: /");  #lisää tähän mihin oppilas ohjataan kirjautumisen jälkeen
        } 
        else {
            require "views/login.view.php";
        }
    } else {
        require "views/login.view.php";
    }
}

function logoutController(){
    session_unset(); //poistaa kaikki muuttujat
    session_destroy();
    setcookie(session_name(),'',0,'/'); //poistaa evästeen selaimesta
    session_regenerate_id(true);
    header("Location: /login"); // forward eli uudelleenohjaus
    die();
}

