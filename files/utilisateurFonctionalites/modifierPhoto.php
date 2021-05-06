<?php include '../fonctions.php' ;
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
    </nav>

    <div class="mx-auto" style="width: 600px;">
        <h1 class="mt-3"> Les images </h1>
        <form action="" method="POST">
            <div>
            <?php
                $utId = 'p19055555';
                recuperePhotosUtilisateur($conn, $utId);
            ?>
            <div>
                <label for="modDescription">Si vous voulez changer le description saisi ici</label>
                <textarea class="form-control" rows="2" name="modDescription"></textarea>
            </div>
            <div class="mb-3">
                    <label for="modCategorie">Si vous voulez changer le category saisi ici</label>
                    <select name="modCategorie" class="form-control" required>
                        <option value="none">choisir une cateagorie</option>
                        <option value="1">fantasy</option>
                        <option value="2">comedy</option>
                        <option value="3">dramas</option>
                    </select>
            </div>
            <button class="btn btn-primary mt-3" type="submit" name="modifierSasie">modifier</button>
        </form>
    </div>
    
    <?php  recupereChangements($conn, $utId);  ?>
    </body>

</html>    

    <?php
                
                function recuperePhotosUtilisateur($conn, $utId){
                    $sql = "SELECT utId, nomFich, photoId FROM  `p1905532`.`Photo` WHERE utId ='".$utId."'"; 
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        $id = 0 ; 
                        while($row = $result -> fetch_assoc()){
                            
                            $photoId = $row["photoId"];
                            $img = "<img src='../../images/" . $row["nomFich"] . "' class='singleImage'>"; 
                            
                            echo $img."<input type=\"radio\" id=\"".$row["nomFich"]."\" name=\"radio\" value=\"".$row["photoId"]."\">"; 
                            $id++;  
                        }
                    }

                }


                function recupereChangements($conn, $utId){
                    
                    
                    if(isset($_POST['modifierSasie'])){
                        if(!empty($_POST['radio'])){
                            $photoId = $_POST['radio']; 
                            $descr = $cat = ""; 

                            if(!empty($_POST['modDescription'])){
                                $descr = $_POST['modDescription']; 
                                //echo $descr; 
                            }

                            if(!empty($_POST['modCategorie'])){
                                $cat = $_POST['modCategorie']; 
                            //  echo $cat; 
                            }
                            
                            modifierPhoto($conn, $utId, $photoId, $cat, $descr); 
                        }
                    }
                }


                function modifierPhoto($conn, $utId, $photoId , $cat, $descr){
                    echo "photo ID : ".$photoId; 
                    $sql = "SELECT * FROM `p1905532`.`Photo` WHERE photoId =".$photoId." AND utId = '".$utId."'" ;
                    echo $sql; 
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result -> fetch_assoc()){
                            
                        $sql1 = "REPLACE INTO `p1905532`.`Photo` SET "; 
                            $l1 = "photoId ='".$photoId."',";
                            $l2 = "nomFich ='".$row["nomFich"]."',";

                            echo $cat." ".$descr; 
                            $l3 = $l4 = ""; // initialize before the loop so that it exists after
                            if(isset($descr)){
                                $l3 = "description ='".$descr."',";
                            }else $l3 = "description ='".$row["description"]."',";
                           
                            if(isset($cat)){
                                $l4 = "catId =".$cat.",";
                            }else $l4 = "catId =".$row["catId"].",";
                            
                            $l5 = "utId ='".$row["utId"]."',"; 
                            $l6 = "cacher = ".$row["cacher"]; 
                            $sql1 = $sql1.$l1.$l2.$l3.$l4.$l5.$l6; 
                            echo $sql1; 
                            $result2 = $conn->query($sql1);
                        }
                    }
                }
                       
                
            ?>
  
