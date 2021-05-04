<?php 



function formCacher($conn, $utId){
    if(!empty($_GET["id"])){
        $utId = $_GET["id"];

        recuperePhotosUtilisateur($conn, $utId, 0);
       
        if(isset($_POST['cacher'])){
           if(!empty($_POST['photos'])){
               foreach($_POST['photos'] as $photoId){
                  // echo "value : ".$photoId."<br>"; 
                   remplaceCacherDansPhoto($conn, $utId, $photoId , 1);
                   header("Location: ./cacherPhoto.php?id=".$utId);
               }
           }
       
       }
    }
}

function formAfficher($conn, $utId){
    if(!empty($_GET["id"])){
        $utId = $_GET["id"];

        recuperePhotosUtilisateur($conn, $utId, 1);
       
        if(isset($_POST['afficher'])){
           if(!empty($_POST['photos'])){
               foreach($_POST['photos'] as $photoId){
                   //echo "value : ".$photoId."<br>"; 
                   remplaceCacherDansPhoto($conn, $utId, $photoId , 0);
                   header("Location: ./cacherPhoto.php?id=".$utId);
               }
           }
       
       }
    }
}

function recuperePhotosUtilisateur($conn, $utId,  $cacher){
    $sql = "SELECT utId, nomFich, photoId FROM  `p1905532`.`Photo` WHERE utId ='".$utId."' AND cacher ='".$cacher."'"; 
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $id = 0 ; 
        while($row = $result -> fetch_assoc()){
            
            $photoId = $row["photoId"];
            $img = "<img src='../../images/" . $row["nomFich"] . "' class='singleImage'>"; 
            
            echo $img."<input type=\"checkbox\" id=\"".$row["nomFich"]."\" name='photos[]' value=\"".$row["photoId"]."\">"; 
            $id++;  
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