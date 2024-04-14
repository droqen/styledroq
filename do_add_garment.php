<?php
require_once 'db_connect.php';
if (!$conn) { die("0; No connection"); }
$name=$_GET["name"];
if (!$name) { die ("0; No name given"); }
try {
	$conn->query("INSERT INTO garment_type (name) VALUES ('$name')");
	echo ("1");
} catch (PDOException $e) {
	die ("0; PDO execute failed: " . $e->getMessage() . "");
}