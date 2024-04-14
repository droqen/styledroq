<?php
require_once 'db_fit_functions.php';
if (!$conn) { die("0; No connection"); }
$day=$_GET["day"];
if (!$day) { die("0; Missing param day"); }
$items=$_GET["items"];
if (!$items) { die("0; Missing param items"); }

// echo("debug . . . items=$items<br/>");
// $explodeditems = explode("_",$items);
// echo("debug . . . exploded items={$explodeditems}<br/>");

$result = set_fit_items($day,explode("_",$items));
echo("<br/>");
echo("OK, result of fit write:<br/>");
echo("- Inserted {$result[0]} item(s)<br/>");
echo("- Left {$result[1]} item(s)<br/>");
echo("- Deleted {$result[2]} item(s)<br/>");