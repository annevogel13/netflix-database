<?php include 'fonctions.php' 
    
?>
<!doctype html>
<html lang="fr">

<?php   ?>

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

    <div class="mx-auto" style="width: 500px;">
        <h1 class="mt-3"> Ajoute image </h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="file" class="form-label">Choisir une image</label>
                <input type="file" class="form-control" name="file">
            </div>

            <div>
                <label for="inputDescription" class="form-label">Saisie une description</label> 
                <textarea class="form-control" rows="2" name="inputDescription"></textarea>
            </div>
            <div class="mb-3">
                <label for="inputCategorie" class="form-label">Choisir une image</label>
                <select name="inputCategorie" class="form-control" required>
                    <option value="none">choisir une cateagorie</option>
                    <option value="1">fantasy</option>
                    <option value="2">comedy</option>
                    <option value="3">dramas</option>
                </select>
            </div>
            <button class="btn btn-primary mt-3" type="submit" name="submit">UPLOAD</button>
        </form>
        <div class="mt-3">
            <h3>Message(s) d'erreur(s)</h3>
            <?php   
                // creation du connection 
                $conn = createConnection($servername, $username, $password);
                // upload image + ajoute photo aux data base
                ajoutePhoto($conn); 
            ?>
        </div>
    </div>


</body>

</html>