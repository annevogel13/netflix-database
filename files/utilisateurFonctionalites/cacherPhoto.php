<?php  session_start(); ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Cacher photo</title>
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
        <h1 class="mt-3">Cacher photo</h1>
        <h3 class="mt-3">Si tu veux changer une photo, clique dessous et refresh le page</h3> 
        <h6 class="mt-3">Apres recharge la page --> voire le resultat</h6>

        <div class="p-5" style="background-color: #9eff84;">    
        <h6>Photo visible</h6>    
        <?php 
           
             if(!empty($_GET["id"])){
                 $utId = $_GET["id"];

                 recuperePhotosUtilisateur($conn, $utId, 0);
                 if(!empty($_GET["fichier"])){
                    $photoId =  $_GET["fichier"]; 
                    remplaceCacherDansPhoto($conn, $utId, $photoId, 1 );
                    header("cacher.php?id='".$utId."'"); 
                   // recuperePhotosUtilisateur($conn, $utId, 0);
                }
             }else echo "login error";  
         ?>
        </div>  
        <div class="p-5" style="background-color : #ff9984;">   
        <h6>Photo cachees</h6>    
      
        <?php
             if(!empty($_GET["id"])){
                $utId = $_GET["id"];

                recuperePhotosUtilisateur($conn, $utId, 1);
                if(!empty($_GET["fichier"])){
                    $photoId =  $_GET["fichier"]; 
                    remplaceCacherDansPhoto($conn, $utId, $photoId, 0 );
                    header("cacher.php?id='".$utId."'"); 
                   // recuperePhotosUtilisateur($conn, $utId, 1);
                }
            }else echo "login error";  

           // remplaceCacherDansPhoto($conn, "AnneVogel", 666, 0 );
           // echo "gdv"; 

        ?>
        </div>
          
          <?php
            if(!empty($_GET["delete"])){
                $photoDelete = $_GET["delete"];
                echo "<script>alert(\" Vous avez supprimer : ".$photoDelete."\")</script>"; 
                supprimerPhoto($conn, $utId, $photoDelete); 
                if(!empty($_GET["fichier"])){
                    $photoId =  $_GET["fichier"]; 
                    remplaceCacherDansPhoto($conn, $utId, $photoId, 0);
                }
               
            }

            function recuperePhotosUtilisateur($conn, $utId,  $cacher){
                $sql = "SELECT utId, nomFich, photoId FROM  `p1905532`.`Photo` WHERE utId ='".$utId."' AND cacher ='".$cacher."'"; 
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result -> fetch_assoc()){
                        $photoId = $row["photoId"];
                        $url="cacherPhoto.php?id=".$utId."&fichier=".$photoId;
                        $onclick = "onclick = \"parent.location='".$url."'\""; 
                        echo "<img src='../../images/" . $row["nomFich"] . "' class='singleImage'". $onclick.">";
                    }
                }
            }

            function remplaceCacherDansPhoto($conn, $utId, $photoId , $cacher){
                $sql = "SELECT * FROM `p1905532`.`Photo` WHERE photoId =".$photoId;
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result -> fetch_assoc()){

                    $sql1 = "REPLACE INTO `p1905532`.`Photo` SET "; 
                        $l1 = "photoId ='".$photoId."',";
                        $l2 = "nomFich ='".$row["nomFich"]."',";
                        $l3 = "description ='".$row["description"]."',";
                        $l4 = "catId =".$row["catId"].",";
                        $l5 = "utId ='".$row["utId"]."',"; 
                        $l6 = "cacher = ".$cacher; 
                    $sql1 = $sql1.$l1.$l2.$l3.$l4.$l5.$l6; 
                 //   echo $sql1 ; 
                    $result2 = $conn->query($sql1);
                    }
                }
            }
            
            
        ?>
     
    </div>


</body>

</html>