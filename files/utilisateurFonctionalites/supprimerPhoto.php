<?php 
        include '../fonctions.php';
        $conn = createConnection($servername, $username, $password);
    ?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Supprimer photo</title>
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
    </nav>

    <div class="mx-auto" style="width: 900px;">
        <h1 class="mt-3">Supprimer photo</h1>
    
        <div class="p-5" style="background-color: #9eff84;">
            <h3>Photo compte</h3>
            <form action='' method="POST">
                <div>
                    <?php 
                        
                        if(!empty($_GET["id"])){
                            $utId = $_GET["id"]; // get the id of the user (lack of session variable )
                            if(checkIfUserIsAdmin($conn, $utId) === 'yes'){ // to make the difference between utilisateur and admin 
                                $arr = utilisateur($conn); 
                                foreach($arr as $id){
                                    recuperePhotosUtilisateur($conn, $id);
                                }
                            }else recuperePhotosUtilisateur($conn, $utId); // collects all the photo's of the $utId (certain user)
                            
                            formDelete($conn, $utId); // collects the photos that need to be deleted in an array and executes the sql command 

                        }else echo "login error";  // if there isn't a $utId defined, shows login error 
                    ?>
                </div>
                <button class="btn btn-danger mt-3" type="submit" name="supprimer">Supprime les photos selectionees</button>
            </form>
        </div>
    </div>
       
</body>
</html>
<?php

    function formDelete($conn, $utId){ // fonction which handels the form and the commands to the sql database 

        if(isset($_POST['supprimer'])){
            if(!empty($_POST['photosSupprimer'])){
                foreach($_POST['photosSupprimer'] as $photoId){  // it's an array, the foreach allows us to tread element for element 
                
                    supprimerPhoto($conn, $photoId); // calls the fonction which deletes a photo which has the same $utId and $nomFich 
                    header("Location: ./supprimerPhoto.php?id=".$utId); // redirect to the "page d'accueil" so that the photo can be seen
                }
            }  
        }
    }

    function supprimerPhoto($conn, $photoId){ // fonction which deletes an row from a table whith utId = $utId , nomFich = $nomFich ;
        $sql = "DELETE FROM `p1905532`.`Photo` WHERE photoId ='".$photoId."'" ; 
        $result = $conn->query($sql);
    }

    function recuperePhotosUtilisateur($conn, $utId){ // fonction which collects all the photos from one user 
        $sql = "SELECT utId, nomFich, photoId FROM  `p1905532`.`Photo` WHERE utId ='".$utId."'"; 
        //echo $sql; 
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $id = 0 ; 
            while($row = $result -> fetch_assoc()){
                
                $photoId = $row["photoId"];
                $img = "<img src='../../images/" . $row["nomFich"] . "' class='singleImage'>"; // stores the html code for an image 
                // concat the $img and the rest of the html code for an input type checkbox 
                echo $img."<input type=\"checkbox\" id=\"".$row["nomFich"]."\" name='photosSupprimer[]' value=\"".$row["photoId"]."\">"; // was $row["nomFich"]
                $id++;  
            }
        }
    }
    
?>


