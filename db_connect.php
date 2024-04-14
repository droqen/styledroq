<?php

require_once '.credentials.php'; 
$dsn = "mysql:host=$dbhost;dbname=$dbname";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
try {
	$conn = new PDO($dsn, $dbuser, $dbpass, $options);
} catch (PDOException $e) {
	die("<b>Problem!</b> PDO connection failed: " . $e->getMessage() . "<br/>");
}
