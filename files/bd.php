<?php

    $dbHost = "localhost";
    $dbUser = "p1906670";
    $dbPwd = "Prison27Suffix";
    $dbName = "p1906670";

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

?>