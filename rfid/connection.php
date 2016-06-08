<?php

//mysql://bdd58b875d80b0:85d85ba1@eu-cdbr-west-01.cleardb.com/heroku_b43fd19e2d8e228?reconnect=true

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

var_dump($url);
?>