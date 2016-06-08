# testM2X


Deux fichiers php pour l'instant


##testStream.php
Ce fichier permet d'envoyer des donnees sur un stream M2X via une librairie php


##testTrigger.php
Ce fichier est un trigger M2X en php. Lorsqu'une valeur d'un stream (load_5m dans mon exemple) depasse une valeur (1 dans cet exemple), att M2X active le trigger qui se connecte sur ce fichier en POST et passe des valeurs json en raw.  
Charge a ce fichier php de faire une action (ici, un simple log dans /test.txt)


Le repertoire vendor, les fichiers composer.json et composer.lock sont la pour activer la librairie M2X (pour heroku entre autres)

Repertoire /ws : les webservices (voir la doc swagger) de la gestion des messages m2x

Repertoire /swagger : la doc swagger

Repertoire /rfid/ws : les webservices (voir la doc swagger) de la gestion des rfid