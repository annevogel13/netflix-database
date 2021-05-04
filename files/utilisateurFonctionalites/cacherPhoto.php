<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Cacher photo</title>
    <link rel="stylesheet" href="style.css">
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
        <h3 class="mt-3">Clique sur le photo que vous voulez cacher</h3> 
        <h6 class="mt-3">Apres recharge la page --> voire le resultat</h6>

        <div style="background-color : pink; ">    
        <h6>Photo visible</h6>    
        <?php 
             
             if(!empty($_GET["id"])){
                 $utId = $_GET["id"];
                 recuperePhotosUtilisateur($conn, $utId, $cacher);
             }else echo "login error";  
         ?>
        </div>

        

        <div style="background-color : rgb(155, 255, 189);">   
        <h6>Photo cachees</h6>    
        </div>

          
          <?php
            if(!empty($_GET["delete"])){
                $photoDelete = $_GET["delete"];
                echo "<script>alert(\" Vous avez supprimer : ".$photoDelete."\")</script>"; 
                supprimerPhoto($conn, $utId, $photoDelete); 
               
            }

            function recuperePhotosUtilisateur($conn, $utId){
                $sql = "SELECT utId, nomFich FROM  `p1905532`.`Photo` WHERE utId ='".$utId."'"; 
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result -> fetch_assoc()){
                        $url="supprimerPhoto.php?id=".$utId."&delete=".$row["nomFich"];
                        $onclick = "onclick = \"parent.location='".$url."'\""; 
                        echo "<img src='../images/" . $row["nomFich"] . "' class='singleImage' ".$onclick.">";
                    }
                }
            }

            function supprimerPhoto($conn, $utId, $nomFich){
                $sql = "DELETE FROM `p1905532`.`Photo` WHERE utId ='".$utId."' AND nomFich ='".$nomFich."'" ; 
                $result = $conn->query($sql);
                
            }
            
            
        ?>
     
    </div>


</body>

</html>