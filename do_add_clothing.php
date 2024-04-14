<?php
require_once 'db_connect.php';
if (!$conn) { die("0; No connection"); }
$name=$_GET["name"];
$garm=$_GET["garm"];
$cost=$_GET["cost"];
$notes=$_GET["notes"];
if (!$name||!$garm||!$cost||!$notes) { die ("0; Missing a param"); }
$id = -1;
try {
	$sth = $conn->prepare("INSERT INTO clothing (name,garment_type_id,cost_cents,longnotes) VALUES (?, ?, ?, ?)");
	$id = $sth->execute([$name,$garm,$cost,$notes]);
	echo ($id);
} catch (PDOException $e) {
	die ("0; PDO execute failed: " . $e->getMessage() . "");
}