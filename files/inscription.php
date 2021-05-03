<?php
session_start();
require_once 'fonctions/bd.php';
require_once 'fonctions/utilisateur.php';

$stateMsg = "";

if(isset($_POST["valider"])){
    $pseudo = $_POST["pseudo"];
    $hashMdp = md5($_POST["mdp"]);
    $hashConfirmMdp = md5($_POST["confirmMdp"]);
    
    $link = getConnection($dbHost, $dbUser, $dbPwd, $dbName);
    
    $available = checkAvailability($pseudo, $link);
    
    if($hashMdp == $hashConfirmMdp){
        if($available){
            register($pseudo, $hashMdp, $link);
            header('Location: index.php?subscribe=yes');
        }else{
            $stateMsg = "Le pseudo demand&eacute; est d&eacute;j&agrave; utilis&eacute;";
        }
    }else{
        $stateMsg = "Les mots de passe ne correspondent pas, veuillez r&eacute;essayer";
    }
}

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Premi&egrave;re inscription</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="loginBanner">
        <div class="errorMsg"><?php echo $stateMsg; ?></div>
        <form action="inscription.php" method="POST">
            <table>
                <tr><td class="loginInfo">Pseudo souhait&eacute;:</td><td><input type="text" name="pseudo"></td></tr>
                <tr><td class="loginInfo">Mot de passe:</td><td><input type="password" name="mdp"></td></tr>
                <tr><td class="loginInfo">Confirmer mot de passe:</td><td><input type="password" name="confirmMdp"></td></tr>       
                <br/>
                <tr><td><input class="button" type="submit" name="valider" value="S'inscrire">
            </table>
        </form>
        
        <a href="index.php">D&eacute;j&agrave; inscrit?</a>
    </div>
</body>
</html>