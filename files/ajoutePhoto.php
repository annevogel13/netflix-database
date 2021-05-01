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
    <form action="" method="post">
                <div class="custom-file">  
                    <input type="file" class="custom-file-input" name="inputFichier" id="customFile">
                    <label class="custom-file-label" for="customFile">Choisir fichier/photo</label>
                </div>
                <div class="form-group">
                   <textarea class="form-control" name="inputDescription" id="exampleFormControlTextarea1" rows="2"></textarea>
                   <label for="exampleFormControlTextarea1">Example textarea</label>
                </div>

                <select name="inputCategorie" required>
                    <option>none</option>
                    <option value="1">fantasy</option>
                    <option value="2">comedy</option>
                    <option value="3">dramas</option>
                </select>
                <input type="submit" name="submitCategorie" value="Choici categorie">
            </form>

<!--
        <form action="" method="post">
            
                <label for="customFile" class="col-sm-2 col-form-label">Select photo</label>
                <div class="custom-file">  
                    <input type="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choisir fichier/photo</label>
                </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
            </div>

            <fieldset class="form-group">
                <div class="form-group col-md-4">
                    <label for="inputCategorie">categorie</label>
                    <select id="inputCategorie" id="formCategorie" class="form-control">
                        <option value="1">fantasy</option>
                        <option value="2">comedy</option>
                        <option value="3">dramas</option>
                    </select>
                </div>

            </fieldset>
            <div class="form-group row">
                <div class="col-md-4">
                    <input type="submit" name="submitNouvellePhoto" value="Ajoute photo">
                </div>
            </div>
        </form> -->
    </div>

    <div>
        value : 
        <?php recupereNouvellePhoto() ?>
    </div>


</body>

</html>