<?php

/**
 * variables globales 
 */
$servername = "localhost";
$username = "p1905532";
$password = "Shrill87Pebble";

// `p1905532`.`utilisateur`

/**
 * /brief fonction qui permet de connecte avec le base de donee
 * /param $servername : nom de serveur
 * /param $username : identifiant pour acceder aux serveur
 * /param $password : mot de passe pour acceder aux serveur 
 */
function createConnection($servername, $username, $password)
{

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Le base de donnee est accesible<br>";
    return $conn;
}

/**
 * /brief fonction qui recupere les photos dans une certaine categorie 
 * /param $conn : pour utiliser le connection avec le base de donnee
 * /param $idCategorie : identifiant d'une categorie (1/2/3)
 */
function recuperePhotoCategorie($conn, $idCategorie, $cacher){
    if($idCategorie == "%"){
        $sql = "SELECT nomFich, photoId, description, catId from `p1905532`.`Photo`"; 
    }else $sql = "SELECT nomFich, photoId, description, catId FROM `p1905532`.`Photo` WHERE catId = ".$idCategorie." AND cacher =".$cacher ;
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $url = "photo.php?photoId=".$row['photoId']; 
            $onclick = "onclick = \"parent.location='".$url."'\""; 
            echo "<img src='../images/" . $row["nomFich"] . "' class='singleImage' ".$onclick.">";
        }
    }else echo "0 results" ; 
    
}

/**
 * /brief fonction qui récupère le valeur dans le form pour choisir un categorie 
 * /returns le identifiant du categorie 
 */
function recupereCategorieSelect(){

    if(isset($_POST['submit'])){
        if(!empty($_POST['categorie'])) {
            $selected = $_POST['categorie'];
            return $selected; 
        } else {
            echo 'Please select the value.';
        }
    }
}

/**
 * /brief foction which generates the green box on the home page 
 * /param $conn : the variable which stores the connection 
 * /param $idCategorie : the variable which indicates which categorie we are going to display 
 */
function greenbox($conn, $idCategorie){
    if($idCategorie == "%"){
        $sql = "SELECT COUNT(nomFich) from `p1905532`.`Photo`"; 
    }else $sql = "SELECT COUNT(nomFich) FROM `p1905532`.`Photo` WHERE catId = ".$idCategorie;

    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            echo $row["COUNT(nomFich)"]; // to display the number of photo's in a category 
        }
    }else echo "0 results" ; 
}


function recuperePhoto($conn, $idPhoto){
        
    $sql = "SELECT nomFich, description, catId, utId FROM `p1905532`.`Photo` WHERE photoId = ".$idPhoto;
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $url = "index.php?categorie=".$row['catId']; 
            $nomCat = getCategorieFromCatId($conn, $row["catId"]); 
            echo "
                    <table class=\"table table-bordered\">
                        <tr>
                            <th scope=\"row\">Description</th>
                            <th>".$row["description"]."</th>
                        </tr>
                        <tr>
                            <th scope=\"row\">Nom du fichier</th>
                            <th>".$row["nomFich"]."</th>
                        </tr>
                        <tr>
                            <th scope=\"row\">Categorie</th>
                            <th><a href='".$url."'>".$nomCat."</a></th>
                        </tr>
                        <tr>
                            <th scope=\"row\">Fait par</th>
                            <th>".$row["utId"]."</th>
                        </tr>
                    </table>
                ";
            echo "<img src='../images/" . $row["nomFich"] . "' class=\"mx-auto\" style=\"width: 500px; height=\"auto\" width=\"500px\">";
        }
    }else echo "0 results" ;   
}

/**
 * /brief fonction which returns the name of the category corresponding to the $catId 
 * /param $conn : stores the information about the connection 
 * /param $catId : number which indicates which category it is
 */
function getCategorieFromCatId($conn, $catId){
    $sql = "SELECT nomCat FROM `p1905532`.`Categorie` WHERE catId = ".$catId;
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            return $row["nomCat"]; 
        }
    }           
}



function utilisateur($conn){
        $sql = "SELECT utId, utMdP, utAdmin from `p1905532`.`Utilisateur`"; 
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result -> fetch_assoc()){
                echo $row["utId"]."<br>"; // c'est le identifiant du utilisateur 
                echo $row["utMdP"]."<br>"; // c'est le mot de passe 
                echo $row["utAdmin"]."<br>"; // c'est un champ qui n'est pas utiliser pour le login (mais c'est pour apres)
            }
        }else echo "0 results" ; 
        
    
}