<?php

$apiKey = $_POST['apiKey'];
$deviceId = $_POST['deviceId'];
$streamId = $_POST['streamId'];
$valeur = $_POST['valeur'];

//chargement de la librairie via l'autoload de composer
require_once "../vendor/autoload.php";

//declaration des objets
use Att\M2X\M2X;
use Att\M2X\Error\M2XException;

//instanciation de l'objet
$m2x = new M2X($apiKey);

//Get the device
$device = $m2x->device($deviceId);

//Create the streams if they don't exist yet
$device->updateStream($streamId);

$now = date('c');
$device->stream($streamId)->postValues(array(array('value' => $valeur,  'timestamp' => $now)));

?>
{
	"reponse" : {
		"code" : "OK",
		"libelle" : "Tout s'est bien passe"
	},
	"valeurs": {
		"apiKey" : "<?php echo $apiKey;?>",
		"deviceId" : "<?php echo $deviceId;?>",
		"streamId" : "<?php echo $streamId;?>",
		"valeur" : "<?php echo $valeur;?>",
		"timestamp" : "<?php echo $now;?>"
	}
}
<?php
/*
$values = "";
$values = $values . "apiKey=" . $apiKey . "\n";
$values = $values . "deviceId=" . $deviceId . "\n";
$values = $values . "streamId=" . $streamId . "\n";
$values = $values . "valeur=" . $valeur . "\n";
$values = $values . "\n\n";


$retour = file_put_contents("resultPostMessage.txt",$values,FILE_APPEND);
*/
?>