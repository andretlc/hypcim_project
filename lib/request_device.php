<?php
// Connetto il DB
require('../lib/connect_db.php');
$maxprice = abs($_GET['max_price']);
$page = abs($_GET['page']);
if ($page == 0 or $page == 1 ){
    $page = 1;
    $limit_r = 3;
}else{
    $limit_r = 3 * $page;
}
// Preparo la Query per mostrare tutti i device caricati nella tabella del database
$query = "SELECT * FROM devices WHERE prezzo < $maxprice ORDER BY prezzo DESC";
// Eseguo la query per recuperare le informazioni dal database
$result = mysql_query($query, $mysql) or die("Errore, Impossibile recuperare le informazioni dal database");
// Metto fuori i risultati dall'array
if(mysql_num_rows($result)!= 0){
while($row = mysql_fetch_array($result)){
$i++;
 ?>

<div class="device-c">
<a href="index.php?s=show&id=<?=$row['id']?>" style="color:#000;   text-decoration: none;">
<h2 style="margin-top:-10px; font-size:16px;"><i class="fa fa-tablet" aria-hidden="true"></i> <?=$row['nome']?></h2>
<img src="<?=$row['img_1']?>" class="fitimage" />
<br />
<div style="text-align:center; padding:3px; font-size:20px;"><b><?=$row['prezzo']?> €</b></div>
<center><i class="fa fa-info-circle" aria-hidden="true"></i></center>
</a>
</div>

<?php
	if($i%3 == 0){
 	echo"<div style='clear:left; padding:3px;'></div>";
		}
	}
}else{

 echo "<center>No device match this criteria.</center>";

}
	echo"<div style='clear:left; padding:3px;'></div>";
		
?>