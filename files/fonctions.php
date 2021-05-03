<?php

/**
 * variables globales 
 */
$servername = "localhost";
$username = "p1905532";
$password = "Shrill87Pebble";


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
    echo "Connected successfully<br>";
    return $conn;
}

/**
 * /brief fonction qui recupere les photos dans une certaine categorie 
 * /param $conn : pour utiliser le connection avec le base de donnee
 * /param $idCategorie : identifiant d'une categorie (1/2/3)
 */
function recuperePhotoCategorie($conn, $idCategorie){
    if($idCategorie == "%"){
        $sql = "SELECT nomFich, photoId, description, catId from `p1905532`.`Photo`"; 
    }else $sql = "SELECT nomFich, photoId, description, catId FROM `p1905532`.`Photo` WHERE catId = ".$idCategorie;
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $onclick = "genererPage('".$row["photoId"]."','".$row["nomFich"]."','".$row["description"]."','".$row["catId"]."')"; 
            echo "<img src='../images/" . $row["nomFich"] . "' class='singleImage' onclick = \"".$onclick."\">";
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

function greenbox($conn, $idCategorie){
    if($idCategorie == "%"){
        $sql = "SELECT COUNT(nomFich) from `p1905532`.`Photo`"; 
    }else $sql = "SELECT COUNT(nomFich) FROM `p1905532`.`Photo` WHERE catId = ".$idCategorie;

    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            echo $row["COUNT(nomFich)"]; 
        }
    }else echo "0 results" ; 
}

function recupereNouvellePhoto($conn){ 
    $newNomFich = $newDescription = $newCateogrie = ''; 
   
        if(!empty($_POST['inputCategorie'])) {
            if($_POST['inputCategorie'] === 'none'){
                echo 'Please select a category.'; // si il y a pas une categorie selectionnee 
            }else $newCateogrie = $_POST['inputCategorie']; //echo $newCateogrie; 
        } else {
            echo 'Please select a category.';
        }
        echo '<br>';
        if(!empty($_FILES['file'])) {
            $newNomFich = $_FILES['file']['name'];; //echo $newNomFich;
            
        } else {
            echo 'Please select a file.'; // si il y a pas une fichier selectionnee
        }
        
        echo '<br>';
        if(!empty($_POST['inputDescription'])) {
            $newDescription = $_POST['inputDescription'];
           // echo $newDescription;
        } else {
            echo 'Please select entre a description'; // si aucun descriptoin est saisi 
        }

    $newPhotoId = random_int(500, 950); // genere une nouveaux photoId 
    insertPhoto($conn, $newPhotoId, $newNomFich, $newDescription, $newCateogrie); 

    
}

/**
 * @function function qui ajoute une photo dans le database 
 * @param $conn : connection
 * @param {string} $photoId, $nomFich, $description, $catId 
 */
function insertPhoto($conn, $photoId, $nomFich, $description, $catId){
    $sqlValues = "('".$photoId."', '".$nomFich."','".$description."','".$catId."')";  
    $sql = "INSERT INTO `p1905532`.`Photo` (photoId, nomFich, description, catId) VALUES".$sqlValues; 
    //echo $sql; 
    
    if($conn -> query($sql) === TRUE){
        echo "Nouvelle photo ajoute dans le database"; 
        header("Location: index.php?ajout=succes");

    } /*else {
        echo "Error: ".$sql."<br>".$conn->error; 
    } */ 
}


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
                if($fileSize <  800000){ // taille of image max = 100 ko = 100 * 8 o = 800000      
                    $fileDestination = '../images/'.$fileFirstName.".".$fileActualExt; // place where it's going to be
                   // echo "tmp Name : ".$fileTmpName."<br>";
                  //  echo "destination : ".$fileDestination."<br>"; 
                   
                    move_uploaded_file($fileTmpName, $fileDestination);
                    recupereNouvellePhoto($conn); 
                    
                }else echo "your image is too big"; 
            } else echo "There was an error uploading your file";  
        }else echo "you cannot upload files of this type";
    }
    }



