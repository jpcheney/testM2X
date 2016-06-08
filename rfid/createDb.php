<?php
include_once('connection.php');

if ($connection->connect_errno) {
    // The connection failed. What do you want to do? 
    // You could contact yourself (email?), log the error, show a nice page, etc.
    // You do not want to reveal sensitive information

    // Let's try this:
    echo "Sorry, this website is experiencing problems.";

    // Something you should not do on a public site, but this example will show you
    // anyways, is print out MySQL error related information -- you might log this
    echo "Error: Failed to make a MySQL connection, here is why: \n";
    echo "Errno: " . $connection->connect_errno . "\n";
    echo "Error: " . $connection->connect_error . "\n";
    
    // You might want to show them something nice, but we will simply exit
    exit;
}

$sql = "CREATE TABLE IF NOT EXISTS test (".
	"id int(11) NOT NULL,".
	"libelle varchar(50) NOT NULL)";

if (!$result = $connection->query($sql)) {
    // Oh no! The query failed. 
    echo "Sorry, the website is experiencing problems.";

    // Again, do not do this on a public site, but we'll show you how
    // to get the error information
    echo "Error: Our query failed to execute and here is why: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $connection->errno . "\n";
    echo "Error: " . $connection->error . "\n";
    exit;
}

$sql = "insert into test values(1,'test1');";
if (!$result = $connection->query($sql)) {
    // Oh no! The query failed. 
    echo "Sorry, the website is experiencing problems.";

    // Again, do not do this on a public site, but we'll show you how
    // to get the error information
    echo "Error: Our query failed to execute and here is why: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $connection->errno . "\n";
    echo "Error: " . $connection->error . "\n";
    exit;
}

$sql = "select id,libelle from test;";

if (!$result = $connection->query($sql)) {
    // Oh no! The query failed. 
    echo "Sorry, the website is experiencing problems.";

    // Again, do not do this on a public site, but we'll show you how
    // to get the error information
    echo "Error: Our query failed to execute and here is why: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $connection->errno . "\n";
    echo "Error: " . $connection->error . "\n";
    exit;
}

while ($resultat = $result->fetch_assoc()) {
    echo $resultat['id'] . ' ' . $resultat['libelle']."\n";
}

$result->free();
$connection->close();

?>