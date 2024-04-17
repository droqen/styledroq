<?php

	$allclothingIDs = array();
	$allclothingNames = array();
	if (!$conn) { die("0; No connection"); }
	try {
		$sth = $conn->query("SELECT id,name FROM clothing");
		foreach($sth as $row) {
			$id = $row[0];
			$name = $row[1];
			$allclothingIDs[] = $id;
			$allclothingNames[] = $name;
			echo ("<input type='checkbox' class='item' id='item$id' value='$id' /> $name<br />\n");
		}

	} catch (PDOException $e) {
		die ("0; PDO execute failed: " . $e->getMessage() . "");
	}