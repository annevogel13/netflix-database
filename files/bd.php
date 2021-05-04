<?php



    
    if(isset($_Post['utilisateur'])){
        $dbUser = $_POST['utilisateur'];
        $dbPwd = $_POST['password'];
        session_start();

        $dbHost = "localhost";
        $dbUser = "p1906670";
        $dbPwd = "Prison27Suffix";
        $dbName = "p1906670";

        mysqli_connect($dbHost, $dbUser, $dbPwd);
        mysqli_select_db($dbName);
       
        $dbUser = ereg_replace("[^A-Za-z0-9]", $dbUser);
        $dbPwd = ereg_replace("[^A-Za-z0-9]", $dbPwd);

        $dbPwd = shal($dbPwd);

        $query = mysqli_query("SELECT * FROM membres WHERE utilisateur = '$dbUser' LIMIT 1");
        $total = mysqli_num_rows($query);

        if($total = "0"){
            echo "L'utilisateur n'existe pas";
            exit();
        }
        else{
            $query = mysqli_query("SELECT * FROM membres WHERE utilisateur = '$dbUser' AND password = '$dbPwd' LIMIT 1");
            $total = mysqli_num_rows($query);
            if($total = "0"){
                echo "Le mot de passe ne correspond pas";
                exit();
            }
            else {
                $_SESSION['utilisateur']= $dbUser;
                header("location:".$_SERVER['HTTP_REFERER']);


            }

        }

    }
    else{header("location: index.php");
    }

    session_destroy();


/*
    {
        $link = mysqli_connect($dbHost, $dbUser, $dbPwd, $dbName);
        if (!$link) {
            echo "Echec lors de la connexion a la base de donnees : (" . mysqli_connect_errno() . ") " . mysqli_connect_error();
        }
        return $link;
    }

    {
        $result = mysqli_query($link, $query);
        if(!$result){
            echo "La requete ".$query." n'a pas pu etre executee a cause d'une erreur de syntaxe";
        }
        return $result;
    }

    {
        $result = mysqli_query($link, $query);
        if(!$result){
            echo "La requete de mise a jour n'a pas pu etre executee a cause d'une erreur de syntaxe";
        }
    }

    {
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          echo "Connected successfully";


    }

*/

?>