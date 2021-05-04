
<?php 
include '../fonctions.php' ;

// creation du connection 
$conn = createConnection($servername, $username, $password);
// upload image + ajoute photo aux data base
ajoutePhoto($conn); 


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
                echo "tmp Name : ".$fileTmpName."<br>";
                echo "destination : ".$fileDestination."<br>";  
                move_uploaded_file($fileTmpName, $fileDestination);

                recupereNouvellePhoto($conn); 
            }else echo "your image is too big"; 
        } else echo "There was an error uploading your file";  
    }else echo "you cannot upload files of this type";
}
}
?>