<?php

require_once 'db_connect.php';

if (!$conn) { die("No connection"); }
// $sth = $conn->query("SELECT zipname, release_date, DAY(release_date) FROM games 
// 	WHERE MONTH(release_date) = $month
// 		AND YEAR(release_date) = $year
// 	ORDER BY release_date ASC");
// $list=array();

function add_garment_type($name) {
	global $conn; 
	try {
		$conn->query("INSERT INTO garment_type (name) VALUES ($name)");
	} catch (PDOException $e) {
		die("<br/><b>Problem!</b> PDO execute failed: " . $e->getMessage() . "");
	}
}