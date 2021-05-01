<?php

$servername = "localhost";
$username = "p1905532";
$password = "Shrill87Pebble";

function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}




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

function creerGridPhotos($conn)
{
$sql = "SELECT nomFich FROM `p1905532`.`Photo`";
$result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<img src='../images/" . $row["nomFich"] . "' class='singleImage'>";
            //console_log($row["nomFich"]);
        }
        
    } else {
        echo "0 results";
    }
}

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

function recupereCategorieSelect(){

    if(isset($_POST['submit'])){
        if(!empty($_POST['categorie'])) {
            $selected = $_POST['categorie'];
            echo 'You have chosen: ' . $selected;
            return $selected; 
        } else {
            echo 'Please select the value.';
        }
    }
}




//$conn->close();
