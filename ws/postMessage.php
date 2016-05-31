<?php

$apiKey = $_POST['apiKey'];
$deviceId = $_POST['deviceId'];
$streamId = $_POST['streamId'];
$valeur = $_POST['valeur'];

$values = "";
$values = $values . "apiKey=" . $apiKey . "\n";
$values = $values . "deviceId=" . $deviceId . "\n";
$values = $values . "streamId=" . $streamId . "\n";
$values = $values . "valeur=" . $valeur . "\n";
$values = $values . "\n\n";


$retour = file_put_contents("resultPostMessage.txt",$values,FILE_APPEND);
?>