<?php include 'fonctions.php' ?>
<!doctype html>
<html lang="fr">



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
        <a class="nav-link" href="./login.html">Login</a>
    </nav>

    <div class="justify-content-sm-center">
        <form action="upload.php" method="post">
            <div class="custom-file">
                <label for="customFile">Choisir image</label>
                <input type="file" class="custom-file-input" name="inputFichier" id="customFile">
                <label class="custom-file-label" for="customFile">Choisir fichier/photo</label>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>

                <textarea class="form-control" name="inputDescription" id="exampleFormControlTextarea1"
                    rows="2"></textarea>
            </div>
            <div class="form-group">
                <select name="inputCategorie" required>
                    <option value="none">choisi une categorie</option>
                    <option value="1">fantasy</option>
                    <option value="2">comedy</option>
                    <option value="3">dramas</option>
                </select>
            </div>
            <input type="submit" name="submitCategorie" value="Choici categorie">
        </form>

        <div>
            <h1> Test for upload/download image </h1>
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <select name="inputCategorie" required>
                    <option value="none">choisi une categorie</option>
                    <option value="1">fantasy</option>
                    <option value="2">comedy</option>
                    <option value="3">dramas</option>
                </select>
                <button type="submit" name="submit">UPLOAD</button>
            </form>
        </div>
        <div>

            <?php $conn = createConnection($servername, $username, $password); recupereNouvellePhoto($conn) ;// uploadImage() ?>
        </div>


</body>

</html>