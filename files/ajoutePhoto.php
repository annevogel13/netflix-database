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
        <a class="nav-link" href="./login.html">Login</a>
    </nav>

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
                <input type="text" name="inputDescription">
                <button type="submit" name="submit">UPLOAD</button>
            </form>
        </div>
        <div>

            <?php   //$conn = createConnection($servername, $username, $password); 
                    //recupereNouvellePhoto($conn) ;// uploadImage() 
                   // uploadImage(); 
            ?>
        </div>


</body>

</html>