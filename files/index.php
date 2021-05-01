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
            <option value="*"></option>
            <option value="1">fantasy</option>
            <option value="2">comedy</option>
            <option value="3">dramas</option>
            </select>
            <button name="button1" value = "button1">confirmer</button>
        </div>
        <h2>Tous les photos</h2>
        <?php 
               recuperePhotoCategorie($conn, 2);
            
            $conn->close(); 
        ?>
    </div>
    </div>


</body>

</html>