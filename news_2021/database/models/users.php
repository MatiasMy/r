<?php
require_once "database/connection.php";

function addUser($firstname, $lastname, $password, $ryhmaID){
    $pdo = connectDB();
    $hashedpassword = hashPassword($password);
    $data = [$firstname, $lastname, $hashedpassword, $ryhmaID];
    $sql = "INSERT INTO kayttaja (nimi, sposti, salasana, ryhmaID) VALUES(?,?,?,?)";
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}

function login($nimi, $sposti, $salasana){
    $pdo = connectDB();
    $sql = "SELECT * FROM kayttaja WHERE nimi=?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$nimi]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    #$hashedpassword = $user["salasana"];
    $hashedpassword = password_hash($salasana, PASSWORD_DEFAULT);

    if($hashedpassword && password_verify($salasana, $hashedpassword))
        return $user;
    else 
        return false;
}
function getUsers($sposti){
    $pdo = connectDB();
    $sql = "SELECT * FROM kayttaja WHERE sposti=?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$sposti]);
    $all = $stm->fetch(PDO::FETCH_ASSOC);
    return $all;
}
