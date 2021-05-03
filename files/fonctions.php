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
    echo "The database is online<br>";
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


/**
 * /brief function who gets the informations on the page "ajoute photo" 
 * /param $conn : stores the informations about the connection 
 */
function recupereNouvellePhoto($conn){ 
    $newNomFich = $newDescription = $newCateogrie = ''; 
   
        if(!empty($_POST['inputCategorie'])) {
            if($_POST['inputCategorie'] === 'none'){
                echo 'Please select a category.<br>'; // si il y a pas une categorie selectionnee 
            }else $newCateogrie = $_POST['inputCategorie']; 
        } else {
            echo 'Please select a category.';
            echo '<br>';
        }
        
        if(!empty($_FILES['file'])) {
            $newNomFich = $_FILES['file']['name'];
            
        } else {
            echo 'Please select a file.<br>'; // si il y a pas une fichier selectionnee
        }
        
        if(!empty($_POST['inputDescription'])) {
            if($_POST['inputDescription'] === ''){
                echo 'Please enter a descriptoin.<br>';
            }else $newDescription = $_POST['inputDescription'];
           // echo $newDescription;
        } else {
            echo 'Please enter a description';  
        }

    $newPhotoId = random_int(500, 950); // genere une nouveaux photoId 
    
    insertPhoto($conn, $newPhotoId, $newNomFich, $newDescription, $newCateogrie); // inserts the photo into the database 
    
}

/**
 * /brief function function qui ajoute une photo dans le database 
 * /param $conn : connection
 * /param {string} $photoId, $nomFich, $description, $catId 
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

/**
 * /brief function which uploads the photo to our /image repository 
 * /param $conn : stores the informations about the connection 
 */
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
        }else echo "You cannot upload files of this type <br> You either didn't select a file or the file is the wrong type <br> The supported type is jpeg, png, gif";
    }
}

function recuperePhoto($conn, $idPhoto){
        
    $sql = "SELECT nomFich, description, catId FROM `p1905532`.`Photo` WHERE photoId = ".$idPhoto;
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $url = "index.php?categorie=".$row['catId']; 
            $nomCat = getCategorieFromCatId($conn, $row["catId"]); 
            echo "<div class=\"col\">
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
                            <th scope=\"row\">categorie</th>
                            <th><a href='".$url."'>".$nomCat."</a></th>
                        </tr>
                    </table>
                </div> ";
            echo "<img src='../images/" . $row["nomFich"] . "' height=\"250px\" width=\"auto\">";
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