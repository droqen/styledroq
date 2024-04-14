<?php
require_once 'db_connect.php';
if (!$conn) { die("0; No connection"); }
try {
	$sth = $conn->query("SELECT id,name FROM garment_type");
	foreach($sth as $row) {
		$id = $row[0];
		$name = $row[1];
		echo ("<option value='$id'>$name</option>\n");
	}
} catch (PDOException $e) {
	die ("0; PDO execute failed: " . $e->getMessage() . "");
}