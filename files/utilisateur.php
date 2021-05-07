<?php 

    /*Cette fonction prend en entrée un pseudo à ajouter à la relation utilisateur et une connexion et 
    retourne vrai si le pseudo est disponible (pas d'occurence dans les données existantes), faux sinon*/
    function checkAvailability($pseudo, $link)
    {
        $query = "SELECT COUNT(utId) FROM `p1905532`.`Utilisateur` WHERE utId = '". $pseudo ."';";
        $result = executeQuery($link, $query);
        
        if($result->num_rows > 0){
            while($row = $result -> fetch_assoc()){
                return $row["COUNT(utId)"] == 0; 
                    
            }
        } 
           //return mysqli_num_rows($result) == 0; 
    }


    /*Cette fonction prend en entrée un pseudo et un mot de passe et enregistre le nouvel utilisateur dans la relation utilisateur via la connexion*/
    function register($pseudo, $hashPwd, $link)
    {
      
        $query = "INSERT INTO Utilisateur VALUES ('". $pseudo ."', '". $hashPwd ."', 'utilisateur', 'disconnected');";
        executeUpdate($link, $query);
    }


    /*Cette fonction prend en entrée un pseudo d'utilisateur et change son état en 'connected' dans la relation 
    utilisateur via la connexion*/
    function setConnected($pseudo, $link)
    {
        $query = "UPDATE Utilisateur SET etat = 'connected' WHERE pseudo = '". $pseudo ."';";
        executeUpdate($link, $query);
    }


    /*Cette fonction prend en entrée un pseudo et mot de passe et renvoie vrai si l'utilisateur existe (au moins un tuple dans le résultat), faux sinon*/
    function getUser($pseudo, $hashPwd, $link)
    {
        $query = "SELECT utId FROM Utilisateur WHERE utId = '". $pseudo ."' AND utMdP = '". $hashPwd ."' AND etat = 'disconnected';";
        $result = executeQuery($link, $query);
        return (mysqli_num_rows($result) == 1);
    }


    /*Cette fonction renvoie un tableau (array) contenant tous les pseudos d'utilisateurs dont l'état est 'connected'*/
    function getConnectedUsers($link)
    {
        $users = array();
        $index = 0;
        
        $query = "SELECT utId FROM Utilisateur WHERE etat = 'connected'";
        $result = executeQuery($link, $query);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $users[$index] = $row["utId"];
            $index++;
        }
        
        return $users;
    }


    /*Cette fonction prend en entrée un pseudo d'utilisateur et change son état en 'disconnected' dans la relation 
    utilisateur via la connexion*/
    function setDisconnected($pseudo, $link)
    {
        $query = "UPDATE Utilisateur SET etat = 'disconnected' WHERE utId = '". $pseudo ."';";
        executeUpdate($link, $query);
    }

?>
