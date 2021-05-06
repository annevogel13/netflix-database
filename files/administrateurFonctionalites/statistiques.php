<?php include '../fonctions.php' ;
    // creation du connection 
    $conn = createConnection($servername, $username, $password);
?>
<!doctype html>
<html lang="fr">


<head>
    <meta charset="utf-8">
    <title>Statistques</title>
    <link rel="stylesheet" href="style.css">
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
    </nav>

    <div class="mx-auto" style="width: 600px;">
        <h1 class="mt-3"> Statistiques </h1>
        <br>
        <h5>Tableau avec informations generales</h5>
        <table class="table">
            <tr>
                <th>Nombre d'utlisateurs : </th>
                <th class="pl-2"><?php  $sql1 = "SELECT COUNT(utId) from `p1905532`.`Utilisateur`" ; exuteEchoSQL($conn, $sql1, "COUNT(utId)");?></th>
            </tr>
            <tr>
                <th>Nombre d'images : </th>
                <th class="pl-2"><?php $sql2 = "SELECT COUNT(photoId) from `p1905532`.`Photo`";  exuteEchoSQL($conn, $sql2, "COUNT(photoId)");?></th>
            </tr>

            <tr>
                <th>Nombre d'categories : </th>
                <th class="pl-2"><?php $sql3 = "SELECT COUNT(catId) from `p1905532`.`Categorie`"; exuteEchoSQL($conn, $sql3, "COUNT(catId)");?></th>
            </tr>
        </table>
    
        <h5 class="mt-3">Tableau avec informations sur chaque utilisatuer</h5>
        <table>
            <tr>
                <th>Utilisateur</th>
                <th>Nombre d'images totale</th>
                <th>Categorie fantasy</th>
                <th>Categorie comedy</th>
                <th>Categorie drama</th> 
            </tr>
            
            <?php tableStatsUser($conn) ?> 
                
        </table> 
    
    </div>



    <?php 

        function exuteEchoSQL($conn, $requet, $showRow){
            $result = $conn->query($requet);
            
           if($result->num_rows > 0){
               // echo $result; 
                while($row = $result -> fetch_assoc()){ 
                    echo $row[$showRow]; 
                    return $row[$showRow];
                    }
            }  
        }

        function tableStatsUser($conn){
            echo "<tbody class=\"table\">"; 
                // select all users and execute statsUser() for every one 
                $sql = "SELECT utId FROM `p1905532`.`Utilisateur`"; 
                $resultat= $conn->query($sql); 
                if($resultat->num_rows>0){
                    while($row = $resultat -> fetch_assoc()){ 
                        statsUser($conn, $row["utId"]);
                    } 
                }
            echo "</tbody>"; 
        }

        function statsUser($conn, $utId){
            $sqlF = "SELECT COUNT(photoId) FROM `p1905532`.`Photo` WHERE utId ='".$utId."' AND catId = 1 "; // fantasy
            $sqlC = "SELECT COUNT(photoId) FROM `p1905532`.`Photo` WHERE utId ='".$utId."' AND catId = 2 "; // comedy
            $sqlD = "SELECT COUNT(photoId) FROM `p1905532`.`Photo` WHERE utId ='".$utId."' AND catId = 3 "; // dramas
            $nbF = $nbC = $nbD = 0 ; 
            $r1 = $conn->query($sqlF);
            if($r1->num_rows>0){
                while($row = $r1 -> fetch_assoc()){ 
                    $nbF = $row["COUNT(photoId)"]; 
                } 
            }

            $r2 = $conn->query($sqlC);
            if($r2->num_rows>0){
                while($row = $r2 -> fetch_assoc()){ 
                    $nbC = $row["COUNT(photoId)"]; 
                } 
            }

            $r3 = $conn->query($sqlD);
            if($r3->num_rows>0){
                while($row = $r3 -> fetch_assoc()){ 
                    $nbD = $row["COUNT(photoId)"]; 
                } 
            }
            $nbTotale = $nbF+$nbC+$nbD;
            $thUt = "<th>".$utId."</th>"; 
            $th0 = "<th>".$nbTotale."</th>"; 
            $th1 = "<th>".$nbF."</th>"; 
            $th2 = "<th>".$nbC."</th>"; 
            $th3 = "<th>".$nbD."</th>"; 
            echo "<tr>".$thUt.$th0.$th1.$th2.$th3."</tr>"; 
        }
    ?>
</body>

</html>