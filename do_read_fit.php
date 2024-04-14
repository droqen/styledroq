<?php
require_once 'db_fit_functions.php';
if (!$conn) { die("0; No connection"); }
$day=$_GET["day"];
if (!$day) { die("0; Missing param day"); }

$items = get_fit_items($day);
echo ("Listing items worn that day:<br/>");
foreach ($items as $item) {
	echo ("- $item<br/>");
}