<?php 


        $servername = "localhost";
        $username = "p1905532";
        $password = "Shrill87Pebble";
        $dbName = "p1905532";


  /*      
    if(isset($_Post['utilisateur'])){
        $dbUser = $_POST['utilisateur'];
        $dbPwd = $_POST['password'];
        //session_start();

       

        mysqli_connect($servername, $username, $password);
        mysqli_select_db($dbName);
       
        $dbUser = ereg_replace("[^A-Za-z0-9]", $dbUser);
        $dbPwd = ereg_replace("[^A-Za-z0-9]", $dbPwd);

        $dbPwd = shal($dbPwd);

        $query = mysqli_query("SELECT * FROM Utilisateur WHERE utId = '$dbUser' LIMIT 1");
        $total = mysqli_num_rows($query);
        echo $total; 
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
               // header("location:".$_SERVER['HTTP_REFERER']);


            }

        }

    }
    else{ //header("location: index.php");
    }

    session_destroy();
    session_unset();
*/

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

    /*Cette fonction prend en entrée l'identifiant de la machine hôte de la base de données, les identifiants (login, mot de passe) d'un utilisateur autorisé 
    sur la base de données contenant les tables pour le chat et renvoie une connexion active sur cette base de donnée. Sinon, un message d'erreur est affiché.*/
    function getConnection($servername, $username, $password, $dbName)
    {
        $link = mysqli_connect($servername, $username, $password, $dbName);
        if (!$link) {
            echo "Echec lors de la connexion a la base de donnees : (" . mysqli_connect_errno() . ") " . mysqli_connect_error();
        }
        return $link;
    }


    /*Cette fonction prend en entrée une connexion vers la base de données du chat ainsi qu'une requête SQL SELECT 
    et renvoie les résultats de la requête. Si le résultat est faux, un message d'erreur est affiché*/
    function executeQuery($link, $query)
    {
        $result = mysqli_query($link, $query);
        if(!$result){
            echo "La requete ".$query." n'a pas pu etre executee a cause d'une erreur de syntaxe";
        }
        return $result;
    }



    /*Cette fonction prend en entrée une connexion vers la base de données du chat ainsi 
    qu'une requête SQL INSERT/UPDATE/DELETE et ne renvoie rien si la mise à jour a fonctionné, sinon un 
    message d'erreur est affiché.*/
    function executeUpdate($link, $query)
    {
        $result = mysqli_query($link, $query);
        if(!$result){
            echo "La requete de mise a jour n'a pas pu etre executee a cause d'une erreur de syntaxe";
        }
    }


    /*Cette fonction ferme la connexion active $link passée en entrée*/
    function closeConnexion($link)
    {
        mysqli_close($link);
    }


?>