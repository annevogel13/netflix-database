<?php include '../fonctions.php' ;
    // creation du connection 
    $conn = createConnection($servername, $username, $password);
?>
<!doctype html>
<html lang="fr">


<head>
    <meta charset="utf-8">
    <title>Ajoute photo</title>
    <link rel="stylesheet" href="style.css">
    <script src="client.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar" style="background-color: paleturquoise;">
        <a class="navbar-brand" href="../index.php">Accueil</a>
        <a class="nav-link" href="./ajoutePhoto.php">Ajouter Photo</a>
        <a class="nav-link" href="./supprimerPhoto.php">Supprimer Photo</a>
        <a class="nav-link" href="./cacherPhoto.php">Cacher Photo</a>
        <a class="nav-link" href="./modifierPhoto.php">Modfier Photo</a>
    </nav>

    <div class="mx-auto" style="width: 500px;">
        <h1 class="mt-3"> Ajoute image </h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="file" class="form-label">Choisir une image</label>
                <input type="file" class="form-control" name="file">
            </div>

            <div>
                <label for="inputDescription" class="form-label">Saisir une description</label> 
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
                
                // upload image + ajoute photo aux data base
                ajoutePhoto($conn); 
            ?>
        </div>
    </div>


</body>

</html>

<?php

    function recupereNouvellePhoto($conn){ // fonction who gets all the information from the form 
        $newNomFich = $newDescription = $newCateogrie = ''; // initialise before the if-statements --> we need them later in the fonction
    
            if(!empty($_POST['inputCategorie'])) {
                if($_POST['inputCategorie'] === 'none'){ // if there isn't a category selected 
                    echo 'Vous n\'avez pas selectionée une categorie .<br>';  
                }else $newCateogrie = $_POST['inputCategorie']; 
            } else {
                echo 'Vous n\'avez pas selectionée une categorie .<br>';
            }
            
            if(!empty($_FILES['file'])) {
                $newNomFich = $_FILES['file']['name']; // get the name of the new file 
                
            } else {
                echo 'Vous n\'avez pas choisi une image. <br>'; // when the input file is empty
            }
            
            if(!empty($_POST['inputDescription'])) {
                if($_POST['inputDescription'] === ''){
                    echo 'Vous n\'avez pas donne une description.<br>';
                }else $newDescription = $_POST['inputDescription'];
            } else {
                echo 'Vous n\'avez pas donne une description.<br>';  
            }

        $newPhotoId = random_int(500, 950); // generates a random number as photoId  
        
        insertPhoto($conn, $newPhotoId, $newNomFich, $newDescription, $newCateogrie); // inserts the photo into the database 
        
    }


    function insertPhoto($conn, $photoId, $nomFich, $description, $catId){ // adds a photo to the database 
        $utId = 'AnneVogel'; // needs to be session variable 
        $sqlValues = "('".$photoId."', '".$nomFich."','".$description."','".$catId."','".$utId."')";  
        $sql = "INSERT INTO `p1905532`.`Photo` (photoId, nomFich, description, catId, utId) VALUES".$sqlValues; 
             
        if($conn -> query($sql) === TRUE){
            echo "Nouvelle photo ajoute dans le database"; 
            header("Location: ../index.php?ajout=succes");

        } 
    }

    
    //brief function which uploads the photo to our /image repository 
    function ajoutePhoto($conn){
        /// upload image 
        if(isset($_POST['submit'])){
        
            // upload file (== image)
            $file = $_FILES['file']; // is an array [name, type, tmp_name, error, size] 
            
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name']; // temporary location of file 
            $fileSize = $_FILES['file']['size']; // size of file 
            $fileError = $_FILES['file']['error']; // error  
            $fileType = $_FILES['file']['type']; // type of file 
            
            $fileExt = explode('.', $fileName); // file extension, explode takes the part after the . <-- extension
            $fileActualExt = strtolower(end($fileExt));// extension into lowercase, end() --> last element of array
            $fileFirstName = $fileExt[0]; 
        
            $allowed = array('gif', 'jpeg', 'png'); // extension allowed 
        
            if(in_array($fileActualExt, $allowed)){ // extension is allowed
                if($fileError === 0 ){ // if 0 --> no errors 
                    if($fileSize <  100000){ // taille of image max = 100 ko = 100 * 8 o = 800000      
                        $fileDestination = '../images/'.$fileFirstName.".".$fileActualExt; // place where it's going to be
              
                        move_uploaded_file($fileTmpName, $fileDestination);
                        recupereNouvellePhoto($conn); 
                        
                    }else echo "your image is too big"; 
                } else echo "There was an error uploading your file";  
            }else echo "You cannot upload files of this type <br> You either didn't select a file or the file is the wrong type <br> The supported type is jpeg, png, gif";
        }
    }

?>