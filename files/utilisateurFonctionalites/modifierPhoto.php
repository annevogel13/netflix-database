<?php include '../fonctions.php' ; // needs to be file which has a start_session() and has a session value which stores the utId 
    // creation du connection 
    $conn = createConnection($servername, $username, $password);
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Ajoute photo</title>
    <link rel="stylesheet" href="../style.css">
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

    <div class="mx-auto" style="width: 800px;">
        <h1 class="mt-3"> Les images </h1>
        <h5>Selection l'image que vous voulez changer. Et direcement apres saisi les nouvelle données dans les champs. 
            Si le modification est pris en charge, il afficherai une message. 
        </h5>
        <form action="" method="POST">
            <div>
            <?php
                $utId = 'p1905532'; // needs to be session value 
                if(checkIfUserIsAdmin($conn, $utId) === 'yes'){ // to make the difference between utilisateur and admin 
                    $arr = utilisateur($conn); 
                    foreach($arr as $id){
                        recuperePhotosUtilisateur($conn, $id); // for each utilisateur display the image as radio button 
                    }
                }else recuperePhotosUtilisateur($conn, $utId); // show all the images of the user with radio buttons 
            ?>
            <div>
                <label for="modDescription">Si vous voulez changer le description saisi ici</label>
                <textarea class="form-control" rows="2" name="modDescription"></textarea>
            </div>
            <div class="mb-3">
                    <label for="modCategorie">Si vous voulez changer le categorie saisi ici</label>
                    <select name="modCategorie" class="form-control" required>
                        <option value="none">choisir une cateagorie</option>
                        <option value="1">fantasy</option>
                        <option value="2">comedy</option>
                        <option value="3">dramas</option>
                    </select>
            </div>
            <button class="btn btn-primary mt-1" type="submit" name="modifierSasie">Modifier les données</button>
        </form>
    </div>
    <h3>
        <?php  recupereChangements($conn); // get the informations of the form, and calls the fontion which updates the tabel ?>
    </h3>
    </body>

</html>    

<?php
            
    function recuperePhotosUtilisateur($conn, $utId){ // shows all the images with radiobuttons (<-- always within a <form></form>)
        $sql = "SELECT utId, nomFich, photoId FROM  `p1905532`.`Photo` WHERE utId ='".$utId."'"; 
        $result = $conn->query($sql);
        if($result->num_rows > 0){ 
            while($row = $result -> fetch_assoc()){

                $photoId = $row["photoId"];
                // create the html code to show the image 
                $img = "<img src='../../images/" . $row["nomFich"] . "' class='singleImage'>"; 
                // create a radio button
                echo $img."<input type=\"radio\" id=\"".$row["nomFich"]."\" name=\"radio\" value=\"".$row["photoId"]."\">"; 
            }
        }

    }

    function recupereChangements($conn){ // gets the information from the table and calls the fonction which replaces the values 
        
        if(isset($_POST['modifierSasie'])){ // get the form --> by clicking on the button 
            if(!empty($_POST['radio'])){ // get the photoId 
                $photoId = $_POST['radio']; 
                $descr = $cat = "none"; // these default values will help later in the code 

                if(!empty($_POST['modDescription'])){ // get the new description 
                    $descr = $_POST['modDescription']; 
                }

                if(!empty($_POST['modCategorie'])){ // get the new categorie id
                    $cat = $_POST['modCategorie']; 
                }
                
                modifierPhoto($conn, $photoId, $cat, $descr); 
            }else echo "Vous devriez selectionner une photo avec le button à côte d'une image.";
        }
    }


    function modifierPhoto($conn, $photoId , $cat, $descr){
        // get all information from the table photo 
        $sql = "SELECT * FROM `p1905532`.`Photo` WHERE photoId =".$photoId;  //AND utId = '".$utId."'" ; 
        
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result -> fetch_assoc()){
             // create the sql syntax for replacing information   
            $sql1 = "REPLACE INTO `p1905532`.`Photo` SET "; 
                $l1 = "photoId ='".$photoId."',";
                $l2 = "nomFich ='".$row["nomFich"]."',";
                
                $l3 = $l4 = ""; // initialize before the if-statements so that it exists after
                if($descr !== "none"){ // if there is text in the textarea --> replace 
                    $l3 = "description ='".$descr."',";
                }else $l3 = "description ='".$row["description"]."',"; // else keep the old information
                
                if($cat !== "none"){ // if there is a category selected 
                    $l4 = "catId =".$cat.",";
                }else $l4 = "catId =".$row["catId"].","; // else keep the old information 
                
                $l5 = "utId ='".$row["utId"]."',"; 
                $l6 = "cacher = ".$row["cacher"]; 
                $sql1 = $sql1.$l1.$l2.$l3.$l4.$l5.$l6;  // add all the little pieces together 

                echo "Votre modification est bien pris en compte"; // message to inform the user that everything is going okay 
                $result2 = $conn->query($sql1); // execute the command in the table 
            }
        }
    }              
?>
  
