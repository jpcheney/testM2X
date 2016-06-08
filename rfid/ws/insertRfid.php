<?php
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
if(isset($_POST['id'])){
	$id = $_POST['id'];
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

$nom_interne= "";
if(isset($_POST['nom_interne'])){
	$nom_interne = $_POST['nom_interne'];
}else{
?>
{
	"reponse" : {
		"code" : "KO",
		"libelle" : "Il manque le parametre nom_interne"
	}
}
<?php
	exit;
}

if(strlen($nom_interne)==0){
?>
{
	"reponse" : {
		"code" : "KO",
		"libelle" : "Le parametre nom_interne est vide"
	}
}
<?php
	exit;
}

$sql = "select id,nom_interne from rfid where id='".$id."';";

if (!$resultat = $connection->query($sql)) {
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

if($result_set = $resultat->fetch_assoc()){
?>
{
	"reponse" : {
		"code" : "KO",
		"libelle" : "Le rfid <?php echo $id;?> existe deja..."
	}
}
<?php
	exit;
}

$sql = "INSERT INTO rfid (id,nom_interne) values('".$id."','".$nom_interne."');";
if (!$resultat = $connection->query($sql)) {
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

/**/
if(!isset($_POST['cles_params'])){
?>
{
	"reponse" : {
		"code" : "KO",
		"libelle" : "Il manque le parametre cles_params"
	}
}
<?php
	exit;
}

if(!isset($_POST['valeurs'])){
?>
{
	"reponse" : {
		"code" : "KO",
		"libelle" : "Il manque le parametre valeurs"
	}
}
<?php
	exit;
}

$cles_params = explode(";",$_POST['cles_params']);
$valeurs = explode(";",$_POST['valeurs']);


//test si le nombre de stream = le nombre de valeurs
if(count($cles_params)!=count($valeurs)){
?>
{
	"reponse" : {
		"code" : "KO",
		"libelle" : "Incoherence entre les streamId et les valeurs (nombre different)"
	}
}
<?php
	exit;
}

for($i=0;$i<count($cles_params);$i=$i+1){
	$sql = "INSERT INTO rfid_infos (id_rfid,cle_params,valeur) values('".$id."','".$cles_params[$i]."','".$valeurs[$i]."');";
	if (!$resultat = $connection->query($sql)) {
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
}



$connection->close();
?>
{
	"reponse" : {
		"code" : "OK",
		"libelle" : "Insertion Rfid <?php echo $cle;?> = <?php echo $libelle;?> ok"
	}
}
