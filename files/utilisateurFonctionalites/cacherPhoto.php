<?php 
        include '../fonctions.php';
        include 'cacher.php'; // a lot of fonctions, easier to implement them in a seperate file 
        $conn = createConnection($servername, $username, $password);
    ?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Cacher photo</title>
    <link rel="stylesheet" href="../style.css">
    <script src="client.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  
    <nav class="navbar" style="background-color: paleturquoise;">
        <a class="navbar-brand" href="../index.php">Accueil</a>
        <a class="nav-link" href="./ajoutePhoto.php">Ajoute Photo</a>
        <a class="nav-link" href="./supprimerPhoto.php">Supprimer Photo</a>
        <a class="nav-link" href="./cacherPhoto.php">Cacher Photo</a>
        <a class="nav-link" href="./modifierPhoto.php">Modfier Photo</a>
        <a class="nav-link" href="../administrateurFonctionalites/statistiques.php">Statistiques</a>
    </nav>

    <div class="mx-auto" style="width: 900px;">
        <h1 class="mt-3">Cacher photo</h1>
        <h5 class="mt-3">Si tu veux cacher ou de remettre la photo sur visible, clique sur le "checkbox" et clique sur le bouton correspondant</h5>
        <h6 class="mt-3">Apres clique sur "cacher photo" dans le "nav-bar" -> voir le resultat</h6>

        <div class="p-5" style="background-color: #9eff84;">
            <h3>Photo visible</h3>
            <form action='' method="POST">
                <div>
                    <?php 
           
                        if(!empty($_GET["id"])){
                            $utId = $_GET["id"];

                            if(checkIfUserIsAdmin($conn, $utId) === 'yes'){ // to make the difference between utilisateur and admin 
                                $arr = utilisateur($conn); 
                                foreach($arr as $id){
                                    recuperePhotosUtilisateur($conn, $id, 0); // html code 
                                }
                            }else recuperePhotosUtilisateur($conn, $utId, 0); // html code 
                            
                            formCacher($conn, $utId);  // creates the html code to display a form for the photos which are public

                        }else echo "login error";  
                    ?>
                </div>
                <button class="btn btn-danger mt-3" type="submit" name="cacher">Cacher les photos selectionees</button>
            </form>
        </div>
        <div class="p-5" style="background-color : #ff9984;">
            <h3>Photo cachees</h3>
            <form action='' method="POST">
                <div>
                    <?php
                    if(!empty($_GET["id"])){
                        $utId = $_GET["id"]; // needs to be session value 
                        if(checkIfUserIsAdmin($conn, $utId) === 'yes'){ // to make the difference between utilisateur and admin 
                            $arr = utilisateur($conn); 
                            foreach($arr as $id){
                                recuperePhotosUtilisateur($conn, $id, 1); // html code 
                            }
                        }else recuperePhotosUtilisateur($conn, $utId, 1); // html code 
                        
                        formAfficher($conn, $utId);  // creates the html code to display a form for the photos which are hidden

                    }else echo "login error";  
                    ?>
                <br>
                <button class="btn btn-success mt-3" type="submit" name="afficher">Afficher les photos selectionees</button>
            </div>
            </form>
        </div>
    </div>
</body>
</html>