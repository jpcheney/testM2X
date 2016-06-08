<?php
header("Content-Type:text/plain");
include_once('../conf/connection.php');

if ($connection->connect_errno) {
?>
{
	"reponse" : {
		"code" : "KO",
		"libelle" : "<?php $connection->connect_errno;?>,<?php $connection->connect_error;?>"
	}
}
<?php
	exit;
}

$id= "";
if(isset($_GET['id'])){
	$id = $_GET['id'];
}else{
?>
{
	"reponse" : {
		"code" : "KO",
		"libelle" : "Il manque le parametre id"
	}
}
<?php
	exit;
}


if(strlen($id)==0){
?>
{
	"reponse" : {
		"code" : "KO",
		"libelle" : "Le parametre id est vide"
	}
}
<?php
	exit;
}

$sql = "select id,nom_interne from rfid where id='".$id."';";

if (!$result_set = $connection->query($sql)) {
?>
{
	"reponse" : {
		"code" : "KO",
		"libelle" : "<?php echo $sql;?>,<?php $connection->connect_errno;?>,<?php $connection->connect_error;?>"
	}
}
<?php
	exit;
}
if ($ligneRfid = $result_set->fetch_assoc()) {
	


?>
{
	"reponse" : {
		"code" : "OK",
		"libelle" : "Retour ok"
	},
	"rfid" : {
		"id" : "<?php echo $ligneRfid['id'];?>",
		"nom_interne" : "<?php echo $ligneRfid['nom_interne'];?>",
		"fields" : [
<?
$sql = "select rfid_infos.cle_params as cle_params,params.libelle as libelle_params,rfid_infos.valeur as valeur from rfid_infos,params where rfid_infos.id_rfid='".$id."' and params.cle = rfid_infos.cle_params;";
if (!$result_set = $connection->query($sql)) {
?>
{
	"reponse" : {
		"code" : "KO",
		"libelle" : "<?php echo $sql;?>,<?php $connection->connect_errno;?>,<?php $connection->connect_error;?>"
	}
}
<?php
	exit;
}
$nb_lignes = 0;
while ($ligne = $result_set->fetch_assoc()) {
	if($nb_lignes>0){
		echo "			,\n";
	}
	echo "			{\n";
    echo "				\"cle_params\": \"".$ligne['cle_params']."\",\n";
	echo "				\"libelle_params\": \"".$ligne['libelle_params']."\",\n";
	echo "				\"valeur\": \"".$ligne['valeur']."\"\n";
	echo "			}\n";
	$nb_lignes = $nb_lignes + 1;
}
?>
		]
	}
}
<?php
}else{
?>
{
	"reponse" : {
		"code" : "KO",
		"libelle" : "Id inconnu"
	}
}
<?php
}
$result->free();
$connection->close();
?>