<!doctype html>
<html lang="fr">

<?php
    include 'fonctions.php'; 
    $conn = createConnection($servername, $username, $password);
?>

<head>
    <meta charset="utf-8">
    <title>Details</title>
    <link rel="stylesheet" href="style.css">
    <script src="client.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    
    <nav class="navbar" style="background-color: paleturquoise;">
        <a class="navbar-brand" href="./index.php">Accueil</a>
        <a class="nav-link" href="./ajoutePhoto.php">Ajoute Photo</a>
        <a class="nav-link" href="./login.php">Login</a>
    </nav>
    <div class="container">
        <div class="row">

            <div class="col" margin-top="15px">
                <h2>Details sur une photo</h2>
                <p id="test">
                    <?php
                      
                       $idPhoto = $_GET["photoId"]; 
                       recuperePhoto($conn, $idPhoto); // gets the information of one photo 

                    ?>
                </p>
            </div>    
        </div>
    </div>
</body>
</html>