
<?php 

if(isset($_POST['submit'])){
    $file = $_FILES['file']; // is an array [name, type, tmp_name, error, size] 
    echo $file['name']."<br>";
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name']; // temporary location of file 
    $fileSize = $_FILES['file']['size']; // temporary location of file 
    $fileError = $_FILES['file']['error']; // temporary location of file 
    $fileType = $_FILES['file']['type']; // temporary location of file 
    
    $fileExt = explode('.', $fileName); // file extension, explode takes the part after the . <-- extension
    $fileActualExt = strtolower(end($fileExt));// extension into lowercase, end() --> last element of array

    $allowed = array('jpg', 'jpeg', 'png'); // extension allowed <-- all images 

    if(in_array($fileActualExt, $allowed)){ // extension is allowed
        if($fileError === 0 ){ // if 0 --> no errors 
            if($fileSize < 100000){ // taille of image 
                $fileNameNew = uniqid('', true).".".$fileActualExt; // unique number <-- denk dat dat weg mag     
                $fileDestination = '../uploads/'.$fileNameNew; // place where it's going to be
                echo "tmp Name : ".$fileTmpName."<br>";
                echo "destination : ".$fileDestination."<br>";  
                echo getcwd(); 
                move_uploaded_file($fileTmpName, $fileName);
               // header("Location: index.php?upload=succes");
            }else echo "your image is too big"; 
        } else echo "There was an error uploading your file";  
    }else echo "you cannot upload files of this type";
}


?>