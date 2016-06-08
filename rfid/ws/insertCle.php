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

$cle= "";
if(isset($_GET['cle'])){
	$cle = $_GET['cle'];
}else{
?>
{
	"reponse" : {
		"code" : "KO",
		"libelle" : "Il manque le parametre cle"
	}
}
<?php
	exit;
}


if(strlen($cle)==0){
?>
{
	"reponse" : {
		"code" : "KO",
		"libelle" : "Le parametre cle est vide"
	}
}
<?php
	exit;
}

$libelle= "";
if(isset($_GET['libelle'])){
	$libelle = $_GET['libelle'];
}else{
?>
{
	"reponse" : {
		"code" : "KO",
		"libelle" : "Il manque le parametre libelle"
	}
}
<?php
	exit;
}

if(strlen($libelle)==0){
?>
{
	"reponse" : {
		"code" : "KO",
		"libelle" : "Le parametre libelle est vide"
	}
}
<?php
	exit;
}

$sql = "select cle,libelle from params where cle='".$cle."';";

if (!$resultat = $connection->query($sql)) {
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

if($result_set = $resultat->fetch_assoc()){
?>
{
	"reponse" : {
		"code" : "KO",
		"libelle" : "Le parametre <?php echo $cle;?> existe deja..."
	}
}
<?php
	exit;
}

$sql = "INSERT INTO params (cle,libelle) values('".$cle."','".$libelle."');";
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

$resultat->free();
$connection->close();
?>
{
	"reponse" : {
		"code" : "OK",
		"libelle" : "Insertion parametre <?php echo $cle;?> = <?php echo $libelle;?> ok"
	}
}
