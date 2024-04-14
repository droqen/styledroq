<?php
require_once('db_connect.php');
if (!$conn) { die("0. no connection"); }
function get_fit_items($day) {
	global $conn;
	$items = [];
	$sth = $conn->prepare("SELECT clothing_id FROM daily_usage WHERE day = ?");
	$sth->execute([$day]);
	foreach ($sth as $row) {
		$items[] = $row[0]; // append id (not sure if this will be string or int)
	}
	return $items;
}
function get_fit_items_detailed($day) {
	global $conn;
	$items = [];
	$sth = $conn->prepare("SELECT clothing.id, clothing.name, garment_type.name
		FROM clothing, garment_type
		WHERE garment_type.id = clothing.garment_type_id AND clothing.day = ?
		GROUP BY clothing.id
	");
	$sth->execute([$day]);
	foreach ($sth as $row) {
		$items[] = [$row[0], $row[1], $row[2]]; // append id (not sure if this will be string or int)
	}
	return $items;
}
function set_fit_items($day, $items) {
	global $conn;
	$olditems = get_fit_items($day);

	$inserts = [];
	$insert_days = [];
	$leave_count = 0;
	$successful_insert_count = 0;
	$successful_delete_count = 0;

	foreach ($items as $item) {
		if (in_array($item, $olditems)) {
			$leave_count ++;
		} else {
			$inserts[] = "(?,$item)";
			$insert_days[] = $day;
		}
	}

	if (count($inserts) > 0) {
		$insertsimp = implode(",",$inserts);
		echo("INSERT INTO daily_usage (day, clothing_id) VALUES ($insertsimp) <br/>");
		$stmt = $conn->prepare("INSERT INTO daily_usage (day, clothing_id) VALUES $insertsimp");
		$stmt->execute($insert_days);
		$successful_insert_count = $stmt->rowCount();
	}

	if (count($olditems) > $leave_count) {
		$deletes = [];
		$delete_days = [];
		foreach ($olditems as $olditem) {
			if (!in_array($olditem, $items)) {
				$deletes[] = "(?,$olditem)";
				$delete_days[] = $day;
			}
		}
		// remove.

		$deletesimp = implode(",", $deletes);
		$stmt = $conn->prepare("DELETE FROM daily_usage WHERE (day,clothing_id) IN ($deletesimp)");
		$stmt->execute($delete_days);
		$successful_delete_count = $stmt->rowCount();
	}

	return [$successful_insert_count, $leave_count, $successful_delete_count];
}