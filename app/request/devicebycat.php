<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
// Connetto il DB
require('../../lib/connect_db.php');
$cat = $_GET['cat'];
$id = abs($_GET['id']);
// Preparo la Query per mostrare tutti i device caricati nella tabella del database
if($id!="0"){
	$query = "SELECT * FROM devices WHERE categoria = ".$cat." AND id =".$id;
}else{
	$query = "SELECT * FROM devices WHERE categoria = ".$cat;
}

// Eseguo la query per recuperare le informazioni dal database
$result = mysql_query($query, $mysql) or die("Errore, Impossibile recuperare le informazioni dal database");
// Metto fuori i risultati dall'array
if(count($result) != 0){
while($row = mysql_fetch_array($result)){
$i++;
 $records[] = $row;
	}
echo $_GET['jsoncallback'] . '(' . json_encode($records) . ');';

}else{

 echo "<center>No device match this criteria.</center>";

}

?>