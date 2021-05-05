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
    <?php 
        include '../fonctions.php';
        $conn = createConnection($servername, $username, $password);
    ?>
    <nav class="navbar" style="background-color: paleturquoise;">
        <a class="navbar-brand" href="../index.php">Accueil</a>
        <a class="nav-link" href="./ajoutePhoto.php">Ajoute Photo</a>
        <a class="nav-link" href="./supprimerPhoto.php">Supprimer Photo</a>
        <a class="nav-link" href="./cacherPhoto.php">Cacher Photo</a>
    </nav>

    <div class="mx-auto" style="width: 900px;">
        <h1 class="mt-3">Supprimer photo</h1>
    
        <div class="p-5" style="background-color: #9eff84;">
            <h3>Photo compte</h3>
            <form action='' method="POST">
                <div>
                    <?php 
           
                        if(!empty($_GET["id"])){
                            $utId = $_GET["id"];

                            recuperePhotosUtilisateur($conn, $utId);
                            formDelete($conn, $utId); 

                        }else echo "login error";  
                    ?>
                </div>
                <button class="btn btn-danger mt-3" type="submit" name="supprimer">Supprime les photos selectionees</button>
            </form>
        </div>
        <?php

            function formDelete($conn, $utId){

                if(isset($_POST['supprimer'])){
                   if(!empty($_POST['photosSupprimer'])){
                       foreach($_POST['photosSupprimer'] as $nomFich){ 
                            supprimerPhoto($conn, $utId, $nomFich); 
                            header("Location: ./supprimerPhoto1.php?id=".$utId);
                        }
                    }  
                }
            }

            function supprimerPhoto($conn, $utId, $nomFich){
                $sql = "DELETE FROM `p1905532`.`Photo` WHERE utId ='".$utId."' AND nomFich ='".$nomFich."'" ; 
                $result = $conn->query($sql);
            }

            function recuperePhotosUtilisateur($conn, $utId){
                $sql = "SELECT utId, nomFich, photoId FROM  `p1905532`.`Photo` WHERE utId ='".$utId."'"; 
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    $id = 0 ; 
                    while($row = $result -> fetch_assoc()){
                        
                        $photoId = $row["photoId"];
                        $img = "<img src='../../images/" . $row["nomFich"] . "' class='singleImage'>"; 
                        echo $img."<input type=\"checkbox\" id=\"".$row["nomFich"]."\" name='photosSupprimer[]' value=\"".$row["nomFich"]."\">"; 
                        $id++;  
                    }
                }
            }
            
        ?>

    </div>

</body>
</html>
