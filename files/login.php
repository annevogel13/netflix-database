<?php
session_start();
include 'bd.php';
include 'utilisateur.php';

$stateMsg = "";

if(isset($_POST["valider"])){
    $pseudo = $_POST["pseudo"];
    $hashMdp = md5($_POST["mdp"]);
    
    $link = getConnection($servername, $username, $password, $dbName);
    
    $exist = getUser($pseudo, $hashMdp, $link);
    if($exist){
        setConnected($pseudo, $link);
        $_SESSION["user"] = $pseudo;
        header('Location: index.php');
    }else{
        $stateMsg = "Le couple pseudo/mot de passe ne correspond &agrave; aucun utilisateur enregistr&eacute;";
    }
}

if(isset($_GET["subscribe"])){
    $successMsg = "<div class='sucessMsg'>L'inscription a bien &eacute;t&eacute; effectu&eacute;e, vous pouvez vous connecter</div>";
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Login </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar" style="background-color: paleturquoise;">
        <a class="navbar-brand" href="./index.php">Accueil</a>
    </nav>

    <div class="mx-auto" style="width: 500px;">
        <div class="errorMsg">
            <?php echo $stateMsg; ?>
        </div>
        <?php if(isset($successMsg)){echo $successMsg;} ?>
        <form action="" method="POST">
            <table  class="mt-3">
                
                <tr>
                    <td class="loginInfo">Pseudo:</td>
                    <td><input type="text" name="pseudo"></td>
                </tr>
                <tr>
                    <td class="loginInfo">Mot de passe:</td>
                    <td><input type="password" name="mdp"></td>
                </tr>
            </table>
                <br />
               
                    <input class="btn btn-primary" type="submit" name="valider" value="Se connecter">
            
        </form>
        <a class="loginInfo" href="inscription.php">Premi&egrave;re connexion?</a>
    </div>
</body>

</html>