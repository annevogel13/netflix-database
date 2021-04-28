<?php
session_start();
require_once 'bdd.php';
require_once 'utilisateur.php';
require_once 'discussion.php';

$link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);

$user = "";

if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
}else{
    session_unset();
    header('Location: index.php');
}

if(isset($_POST["send"])){
    $msg = $_POST["message"];
    submitMessage($user, $msg, $link);
}

if(isset($_POST["sendImg"])){
    $img = $_POST["image"];
    submitImage($user, $img, $link);
}

if(isset($_POST["refresh"])){
    header('Location: chat.php');
}

if(isset($_POST["disconnect"])){
    setDisconnected($user, $link);
    session_unset();
    header('Location: index.php');
}

?>

<!doctype html>
<html lang="fr">

<!-- https://bdw1.univ-lyon1.fr/p1905532/bdw1/onglet/index.html -->

<head>
    <meta charset="utf-8">
    <title>Projet BDW1-2021</title>
    <link rel="stylesheet" href="style.css">
    <script src="client.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>


<body>
    <nav class="navbar" style="background-color: paleturquoise;">
        <a class="navbar-brand" href="./index.html">Accueil</a>
        <a class="nav-link" href="./ajoutePhoto.html">Ajoute Photo</a>
        <a class="nav-link" href="./login.html">Login</a>
    </nav>

    <div id="greenbox" class="greenbox">
        tous les photos sont selectionées
    </div>

    <div class="center">
        <div class="choisirCategorie">
            <p class=" tekstChoisirPhotos">Quelles photos souhaitez-vous afficher? </p>

            <select name="categorie" id="categorie" required>
                <option value=tous"">None</option>
                <option value="volvo">Volvo</option>
                <option value="saab">Saab</option>
                <option value="mercedes">Mercedes</option>
                <option value="audi">Audi</option>
            </select>

            <button onclick="valeurDropDown()">confirmer</button>
        </div>
        <h2 class="center">Tous les photos</h2>

    </div>


    <div class="container" class="tousPhotos">
        <div class="row">
            <div class="col">
                <img src="zoom-bg.png" alt="test-image" height="100px" width="auto"
                    onclick="location.href='./specificImage.html'">
            </div>
            <div class="col">
                <img src="voorpagina.jpeg" alt="test-image" height="100px" width="auto"
                    onclick="location.href='./specificImage.html'">
            </div>

            <div class="col">
                <img src="voorpagina.jpeg" alt="test-image" height="100px" width="auto"
                    onclick="location.href='./specificImage.html'">
            </div>
        </div>
    </div>
    </div>


</body>

</html>