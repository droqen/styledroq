<?php
require_once 'db_connect.php';
if (!$conn) { die("0; No connection"); }
$id=$_GET["id"];
$newname=$_GET["newname"];
if (!$id||!$newname) { die ("0; Missing params (Expected id,newname)"); }
try {
	$stmt = $conn->query("UPDATE garment_type SET name='$newname' WHERE id=$id");
	$count = $stmt->rowCount();
	if ($count == 0) {
		echo ("0; update failed (either no id found $id or garment_type already had name '$newname')");
	} else {
		echo ("1");
	}
} catch (PDOException $e) {
	die ("0; PDO execute failed: " . $e->getMessage() . "");
}