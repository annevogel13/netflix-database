<?php

/**
 * variables globales 
 */
$servername = "localhost";
$username = "p1905532";
$password = "Shrill87Pebble";


/**
 * /brief function qui permet d'ecrire aux console pour aider avec debugger 
 * /param 
 */
function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}



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
        $sql = "SELECT nomFich from `p1905532`.`Photo`"; 
    }else $sql = "SELECT nomFich FROM `p1905532`.`Photo` WHERE catId = ".$idCategorie;
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            echo "<img src='../images/" . $row["nomFich"] . "' class='singleImage'>";
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
    if(isset($_POST['submitCategorie'])){
        if(!empty($_POST['inputCategorie'])) {
            $newCateogrie = $_POST['inputCategorie'];
            
        } else {
            echo 'Please select a category.';
        }
        echo '<br>';
        if(!empty($_POST['inputFichier'])) {
            $newNomFich = $_POST['inputFichier'];
            
        } else {
            echo 'Please select a file.';
        }
        
        echo '<br>';
        if(!empty($_POST['inputDescription'])) {
            $newDescription = $_POST['inputDescription'];
        } else {
            echo 'Please select entre a description';
        }
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





//$conn->close();
