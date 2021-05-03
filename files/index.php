<?php include 'fonctions.php' ?>

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

<?php $conn = createConnection($servername, $username, $password);  ?>

<body>
    <nav class="navbar" style="background-color: paleturquoise;">
        <a class="navbar-brand" href="./index.php">Accueil</a>
        <a class="nav-link" href="./ajoutePhoto.php">Ajoute Photo</a>
        <a class="nav-link" href="./login.php">Login</a>
    </nav>

    <div id="greenbox" class="greenbox">
        
        <?php $selected = recupereCategorieSelect(); greenbox($conn, $selected) ?>
     photo(s) selectionnée(s)
    </div>

    <div class="center">
        <div class="choisirCategorie">
            <p class=" tekstChoisirPhotos">Quelles photos souhaitez-vous afficher? </p>
            <form action="" method="post">
                <select name="categorie" id="categorie" required>
                    <option value="%">tous</option>
                    <option value="1">fantasy</option>
                    <option value="2">comedy</option>
                    <option value="3">dramas</option>
                </select>
                <input type="submit" name="submit" value="Choici categorie">
            </form>
        </div>
        <h2>Tous</h2>
        <?php 
               recuperePhotoCategorie($conn, $selected);
            
            $conn->close(); 
        ?>
    </div>
    </div>


</body>

</html>

<!--
    
<?php
/* 
session_start();
include 'bd.php';
include 'utilisateur.php';

$stateMsg = "";

if(isset($_POST["valider"])){
    $pseudo = $_POST["pseudo"];
    $hashMdp = md5($_POST["mdp"]);
    
    $link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
    
    $exist = getUser($pseudo, $hashMdp, $link);
    if($exist){
        setConnected($pseudo, $link);
        $_SESSION["user"] = $pseudo;
        header('Location: login.php');
    }else{
        $stateMsg = "Le couple pseudo/mot de passe ne correspond &agrave; aucun utilisateur enregistr&eacute;";
    }
}

if(isset($_GET["subscribe"])){
    $successMsg = "<div class='sucessMsg'>L'inscription a bien &eacute;t&eacute; effectu&eacute;e, vous pouvez vous connecter</div>";
} */ 
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Bienvenue </title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="loginBanner">
    <div class="errorMsg"><?php //echo $stateMsg; ?></div>
    <?php // if(isset($successMsg)){echo $successMsg;} ?>
        <form action="index.php" method="POST">
            <table>
                <tr><td class="loginInfo">Pseudo:</td><td><input type="text" name="pseudo"></td></tr>
                <tr><td class="loginInfo">Mot de passe:</td><td><input type="password" name="mdp"></td></tr>
                <br/>
                <tr><td><input class="button" type="submit" name="valider" value="Se connecter">
            </table>
        </form>
        <a class="loginInfo" href="inscription.php">Premi&egrave;re connexion?</a>
    </div>
</body>
</html>-->