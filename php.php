<?php
    $mysqli = mysqli_connect("https://bdw1.univ-lyon1.fr/phpmyadmin", "p1905532", "Shrill87Pebble", "p1905532");
    
    $result = mysqli_query($mysqli, "SELECT 'A world full of ' AS _msg FROM DUAL");
    $row = mysqli_fetch_assoc($result);
    echo $row['_msg'];
    
    $result = $mysqli->query("SELECT 'choices to please everybody.' AS _msg FROM DUAL");
    $row = $result->fetch_assoc();
    echo $row['_msg'];

?>
