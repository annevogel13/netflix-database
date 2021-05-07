<?php

/**
 * variables globales 
 */
$servername = "localhost";
$username = "p1905532";
$password = "Shrill87Pebble";

// `p1905532`.`utilisateur`


//fonction which creates the connection with the database p1905532 (where we stored all our photos)
function createConnection($servername, $username, $password)
{
    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Le base de donnee est accesible<br>"; // petit message for the uppper left corner, to make sure that the database is functioning 
    return $conn;
}

//fonction which gets the photos of one catogory and displays the photo (html code)
function recuperePhotoCategorie($conn, $idCategorie, $cacher){
    if($idCategorie == "%"){ // if there isn't a category selected --> show all the photos (without the hidden ones)
        $sql = "SELECT nomFich, photoId, description, catId from `p1905532`.`Photo` WHERE cacher =".$cacher ; 
    }else $sql = "SELECT nomFich, photoId, description, catId FROM `p1905532`.`Photo` WHERE catId = ".$idCategorie." AND cacher =".$cacher ;
    $result = $conn->query($sql);
    
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $url = "photo.php?photoId=".$row['photoId']; // the url of the details page 
            $onclick = "onclick = \"parent.location='".$url."'\""; // redirection to the details page if the photo is clicked 
            echo "<img src='../images/" . $row["nomFich"] . "' class='singleImage' ".$onclick.">"; // with onclick filled 
        }
    }else echo "0 resultats" ; // if there aren't any photo selected --> error 
    
}

// fonction which gets the value in the dropdown menu, to select the category to view
function recupereCategorieSelect(){

    if(isset($_POST['submit'])){
        if(!empty($_POST['categorie'])) {
            $selected = $_POST['categorie'];
            return $selected; 
        } else {
            echo 'Vous n\'avez pas choisi une categorie.<br>';
        }
    }
}

//fonction which generates the green box on the home page with the count of the number of photos selected 
function greenbox($conn, $idCategorie){
    if($idCategorie == "%"){
        $sql = "SELECT COUNT(nomFich) from `p1905532`.`Photo`"; 
    }else $sql = "SELECT COUNT(nomFich) FROM `p1905532`.`Photo` WHERE catId = ".$idCategorie;

    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            echo $row["COUNT(nomFich)"]; // to display the number of photo's in a category 
        }
    }else echo "0 resultats" ; 
}

// function which generates the <html> code for the details page 
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
    }else echo "0 resultats" ;   
}

//fonction which returns the name of the category corresponding to the $catId 
function getCategorieFromCatId($conn, $catId){
    $sql = "SELECT nomCat FROM `p1905532`.`Categorie` WHERE catId = ".$catId;
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            return $row["nomCat"]; 
        }
    }           
}

// fonction for the purpupse of debugging 
// fonction which shows all the users 
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