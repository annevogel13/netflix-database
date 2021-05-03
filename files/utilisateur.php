<?php 

    
    function checkAvailability($pseudo, $link)
    {
        $query = "SELECT pseudo FROM utilisateur WHERE pseudo = '". $pseudo ."';";
        $result = executeQuery($link, $query);
        return mysqli_num_rows($result) == 0;
    }



    function register($pseudo, $hashPwd, $link)
    {
        $colors = array('red', 'green', 'blue', 'black', 'yellow', 'orange');
        $index = rand(0, 5);
        $color = $colors[$index];
        $query = "INSERT INTO utilisateur VALUES ('". $pseudo ."', '". $hashPwd ."', '". $color ."', 'disconnected');";
        executeUpdate($link, $query);
    }



    function setConnected($pseudo, $link)
    {
        $query = "UPDATE utilisateur SET etat = 'connected' WHERE pseudo = '". $pseudo ."';";
        executeUpdate($link, $query);
    }



    function getUser($pseudo, $hashPwd, $link)
    {
        $query = "SELECT pseudo FROM utilisateur WHERE pseudo = '". $pseudo ."' AND mdp = '". $hashPwd ."' AND etat = 'disconnected';";
        $result = executeQuery($link, $query);
        return (mysqli_num_rows($result) == 1);
    }

?>
