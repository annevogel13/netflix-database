
<?php 




if(isset($_POST['submit'])){


    // inputCategorie 
    if(!empty($_POST['inputCategorie'])) {
        if($_POST['inputCategorie'] === 'none'){
            echo 'Please select a category.';
        }else $newCateogrie = $_POST['inputCategorie'];
    } else {
        echo 'Please select a category.';
    }
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

    $allowed = array('jpg', 'jpeg', 'png'); // extension allowed <-- all images 

    if(in_array($fileActualExt, $allowed)){ // extension is allowed
        if($fileError === 0 ){ // if 0 --> no errors 
            if($fileSize < 100000){ // taille of image      
                $fileDestination = '../images/'.$fileFirstName.".".$fileActualExt; // place where it's going to be
                echo "tmp Name : ".$fileTmpName."<br>";
                echo "destination : ".$fileDestination."<br>";  
                move_uploaded_file($fileTmpName, $fileDestination);
            }else echo "your image is too big"; 
        } else echo "There was an error uploading your file";  
    }else echo "you cannot upload files of this type";
}


?>