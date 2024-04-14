<?php
require_once 'db_connect.php';
if (!$conn) { die("0; No connection"); }
$id=$_GET["id"];
$name=$_GET["name"];
$garm=$_GET["garm"];
$cost=$_GET["cost"];
$notes=$_GET["notes"];
if (!$id||!$name||!$garm||!$cost||!$notes) { die ("0; Missing a param"); }
try {
	$sth = $conn->prepare("UPDATE clothing SET name=?, garment_type_id=?, cost_cents=?, longnotes=? WHERE id=?");
	$stmt = $sth->execute([$name,$garm,$cost,$notes,$id]);
	$count = $sth->rowCount();
	if ($count == 0) {
		echo ("0; update failed (either bad id $id or values were not changed)");
	} else {
		echo ("1");
	}
} catch (PDOException $e) {
	die ("0; PDO execute failed: " . $e->getMessage() . "");
}