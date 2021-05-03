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
        <a class="nav-link" href="./login.php">Login</a>
    </nav>
    <div class="container">
        <div class="row">

            <div class="col" margin-top="15px">
                <h2>Details sur une photo</h2>
                <p id="test">" "</p>
            </div>
            
        </div>

        <div class="row">
            <div class="col" id="tousLesPhotos">

                <div class="singleImage">
                    <img src="zoom-bg.png" alt="test-image" height="250px" width="auto">
                </div>
            </div>
            <div class="col">
                <table class="table table-bordered">
                    <tr>
                        <th scope="row">Description</th>
                        <th>description of the image</th>
                    </tr>
                    <tr>
                        <th scope="row">Nom du fichier</th>
                        <th>photo.jpeg</th>
                    </tr>
                    <tr>
                        <th scope="row">categorie</th>
                        <th>animaux</th>
                    </tr>
                </table>
            </div>
        </div>

    </div>

</body>

</html>