<?php 

// generates the html code for the photo's whiche aren't hidden
function formCacher($conn, $utId){
   
    if(isset($_POST['cacher'])){
        if(!empty($_POST['photos'])){
            foreach($_POST['photos'] as $photoId){ // form with checkboxes, return as an array
                
                remplaceCacherDansPhoto($conn, $photoId , 1); // we remplace the "cacher" dans le table avec 1
                header("Location: ./cacherPhoto.php?id=".$utId); // we refresh the page so that the changes are directly visible
            }
        }
    }
}

// almost the same fonction as the one above. Only now, it displays the photos which are hidden
function formAfficher($conn, $utId){

    if(isset($_POST['afficher'])){
        if(!empty($_POST['photos'])){
            foreach($_POST['photos'] as $photoId){
                
                remplaceCacherDansPhoto($conn, $photoId , 0); // and remplaces the 1 in "cacher" to 0 
                header("Location: ./cacherPhoto.php?id=".$utId);
            }
        }
    
    }
    
}

// function which generates the html code to display the image with checkboxes (<-- needs to be inside a <form>)
function recuperePhotosUtilisateur($conn, $utId,  $cacher){
    $sql = "SELECT utId, nomFich, photoId FROM  `p1905532`.`Photo` WHERE utId ='".$utId."' AND cacher ='".$cacher."'"; 
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            
            $photoId = $row["photoId"];
            $img = "<img src='../../images/" . $row["nomFich"] . "' class='singleImage'>"; 
            
            echo $img."<input type=\"checkbox\" id=\"".$row["nomFich"]."\" name='photos[]' value=\"".$row["photoId"]."\">";  
        }
    }
}

// fonction which executes the REPLACE INTO SET command sql 
function remplaceCacherDansPhoto($conn, $photoId , $cacher){
    $sql = "SELECT * FROM `p1905532`.`Photo` WHERE photoId =".$photoId; // gets alle the current information of a photo 
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
        $sql1 = $sql1.$l1.$l2.$l3.$l4.$l5.$l6; // concat all the parts together into one string 
    
        $result2 = $conn->query($sql1); // execute the command 
        }
    }
}


?>