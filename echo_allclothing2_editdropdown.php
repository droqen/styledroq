<?php


	$allclothingCount = 0;

	if($allclothingIDs) {$allclothingCount=count($allclothingIDs);}
	if($allclothingCount > 0) {
		echo '
<h3>Edit an existing clothing item</h3>
<form action="/screen_edit_clothing.php">
	<select name="clothingid" id="clothing_dropdown">

<option value=""></option>
';

for($i=0;$i<$allclothingCount;$i++){
	$id = $allclothingIDs[$i];
	$name = $allclothingNames[$i];
	echo "<option value='$id'>$name</option>\n";
}

echo '
	</select><br/>
	<input type="submit" value="Edit!">
</form>
';
	}