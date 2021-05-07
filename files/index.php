<?php 
session_start(); 
include 'fonctions.php' ?>

<!doctype html>
<html lang="fr">

<!-- https://bdw1.univ-lyon1.fr/p1905532/bdw1/onglet/index.html -->

<head>
    <meta charset="utf-8">
    <title>Projet BDW1-2021</title>
    <link rel="stylesheet" href="style.css">
    <script src="client.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<?php $conn = createConnection($servername, $username, $password);  ?>

<body>
    <nav class="navbar" style="background-color: paleturquoise;">
        <a class="navbar-brand" href="./index.php">Accueil</a>
         
        <?php 
        if(!empty($_SESSION["user"])){ // if logged in show fonctionalites + deconnexion 
            echo "<a class=\"nav-link\" href=\"./utilisateurFonctionalites/ajoutePhoto.php\">Fonctionalites</a>"; 
            $button = "<button type=\"submit\" class=\"btn btn-light\" name=\"disconnect\">Déconnexion</button>"; 
            echo  "<form action=\"\" method=\"POST\">".$button."</form>"; 
             
        }else echo "<button class=\"btn btn-light\"><a href=\"./login.php\">Connexion</a></button>"; // show only login 

        if(isset($_POST['disconnect'])){ // get the form --> by clicking on the button 
            // remove all session variables
            session_unset();
            // destroy the session
            session_destroy(); 
            header("Location: ./index.php"); // reload the page --> deconnexion changes into connexion  
        }  

        ?>
        
    </nav>

    <div id="greenbox" class="greenbox">
        
        <?php 
           
           //utilisateur($conn); 
            $selected = recupereCategorieSelect();
            if($selected === null){ // --> when we click on the link on the details page, it add a variable to the url 
                if(!empty($_GET["categorie"])){
                    $selected = $_GET["categorie"]; // we get this variable and use it to display the right category 
                }else $selected = '%';             
            }  
            
            greenbox($conn, $selected); // echos a number 
        ?>
        photo(s) selectionnée(s)
    </div>
        <?php 
            if(isset($_SESSION["user"])){
                echo $_SESSION["user"]; 
            }

        ?>
    <div class="center">
        <div class="choisirCategorie">
            <p class=" tekstChoisirPhotos">Quelles photos souhaitez-vous afficher? </p>
            <form action="" method="post">
                <select name="categorie" id="categorie" required>
                    <option value="%">tous</option>
                    <option value="1">fantasy</option>
                    <option value="2">comedy</option>
                    <option value="3">dramas</option>
                </select>
                <input type="submit" name="submit" value="Choisir la categorie">
            </form>
        </div>
        <h2>Les images</h2>
        <?php 
            recuperePhotoCategorie($conn, $selected, 0); // display all the photo's which are not hidden  
        ?>
    </div>  
</body>
</html>

