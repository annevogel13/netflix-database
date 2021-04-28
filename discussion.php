<?php

$historySize = 10;

/*Cette fonction renvoie un tableau (array) des $nbRecord derniers enregistrements triés par ordre chronologique inversé (les plus récents d'abord) sur la date et l'heure. 
Un enregistrement est une chaine de caractères de la forme "auteur;valeur;date;heure;type".*/
function getHistory($nbRecord, $link)
{
	$history = array();

	$query = "SELECT auteur, valeur, date, heure, type FROM message ORDER BY date DESC, heure DESC LIMIT ". $nbRecord .";";
	$result = executeQuery($link, $query);
    
	$index = 0;
	while ($row = mysqli_fetch_assoc($result)) {
		$history[$index] = $row["auteur"].";".$row["valeur"].";".$row["date"].";".$row["heure"].";".$row["type"];
		$index++;
    }
	
	return $history;
}

/*Cette fonction prend en entrée un nouveau message soumis par un utilisateur et stocke le message 
dans la relation message avec la date de soumission au format 'Y-m-d' et l'heure au format 'H:i:s' via la connexion active $link. Le type sera 'texte'.
Il faudra faire attention à échapper les caractères spéciaux du message pour qu'ils ne soient pas interprétés par la base de données. Une méthode mysqli permet
de gérer automatiquement cet échappement de caractères.*/
function submitMessage($auteur, $message, $link)
{
	$date = date("Y-m-d");
	$hour = date("H:i:s");
	$query = "INSERT INTO message VALUES ('". $auteur ."', '". $date ."', '". $hour ."', '". mysqli_real_escape_string($link, $message) ."', 'texte');";
	executeUpdate($link, $query);
}

/*Cette fonction prend en entrée un nouveau message soumis par un utilisateur et stocke le message 
dans la relation message avec la date de soumission au format 'Y-m-d' et l'heure au format 'H:i:s' via la connexion active $link. Le type sera 'image'.
Il faudra faire attention à échapper les caractères spéciaux du message pour qu'ils ne soient pas interprétés par la base de données. Une méthode mysqli permet
de gérer automatiquement cet échappement de caractères.*/
function submitImage($auteur, $imgLink, $link)
{
	$date = date("Y-m-d");
	$hour = date("H:i:s");
	$query = "INSERT INTO message VALUES ('". $auteur ."', '". $date ."', '". $hour ."', '". mysqli_real_escape_string($link, $imgLink) ."', 'image');";
	executeUpdate($link, $query);
}

/*Cette fonction prend en entrée un nouveau message soumis par un utilisateur et stocke le message 
dans la relation message avec la date de soumission au format 'Y-m-d' et l'heure au format 'H:i:s' via la connexion active $link. Le type sera 'video'.
Il faudra faire attention à échapper les caractères spéciaux du message pour qu'ils ne soient pas interprétés par la base de données. Une méthode mysqli permet
de gérer automatiquement cet échappement de caractères.*/
function submitVideo($auteur, $videoLink, $link)
{
	$date = date("Y-m-d");
	$hour = date("H:i:s");
	$query = "INSERT INTO message VALUES ('". $auteur ."', '". $date ."', '". $hour ."', '". mysqli_real_escape_string($link, $videoLink) ."', 'video');";
	executeUpdate($link, $query);
}

?>