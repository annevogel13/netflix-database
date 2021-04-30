<?php

$servername = "localhost";
$username = "p1905532";
$password = "Shrill87Pebble";

function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}




function createConnection($servername, $username, $password)
{

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully<br>";
    return $conn;
}

$conn = createConnection($servername, $username, $password);

$sql = "SELECT nomFich FROM `p1905532`.`Photo`";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<table><tr><th>id de categorie</th><th>||</th><th>Name de categorie</th></tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td><img src='../images/".$row["nomFich"]."'></td></tr>";
        //console_log($row["nomFich"]);
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
