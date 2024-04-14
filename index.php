<!DOCTYPE html>
<html>
<head>
<title>styledroq</title>
<script src="https://code.jquery.com/jquery-1.7.2.js"></script>
<script>
	function updateDate() {
		console.log("date changed...");
		$("#fit_rest").hide();
		$.ajax({
		url: "do_read_fit_ids.php?day="+$("#fit_date").val()
		}).done(function(data) { // data what is sent back by the php page
			if (data.startsWith("0;")) {
				console.log("invalid date");
			} else {
				let selectedItems = data.split(",");
				console.log(selectedItems);
       			$('#fit input.item').prop("checked", false);
				selectedItems.forEach(function(selectedItemId) {
					console.log('#fit input#item'+selectedItemId);
					$('#fit input#item'+selectedItemId).prop("checked", true);
				});
				updateTextArea();
				$("#fit_rest").show();
			}
		});
	}
    function updateTextArea() {
        var allVals = $('input.item:checked').map( 
        function() {return this.value;}).get().join("_");
        $('#txtValue').val(allVals)
    }
    $(function () {
        $('#fit input.item').click(updateTextArea);
        $('#fit_date').change(updateDate);
        updateTextArea();
    });
</script>
</head>

<body>

Add piece of clothing
<form action="/do_add_clothing.php">
Name: <input type="text" name="name"><br/>
Cost (in cents!): <input type="text" name="cost"><br />
Garment type: <select name="garm" id="garm">
<option value=""></option>
<?php include("echo_allgarm_options.php"); ?></select>
</select><br/>
Any additional notes: 
<textarea name="notes" value=""></textarea><br/>
<input type="submit" value="Go!">
</form>
</body>

Change fit
<form id="fit" action="/do_write_fit.php">
<input type="date" name="day" id="fit_date">
<div id="fit_rest">
	<div id="clothing_items">
	<?php include("echo_allclothing_checkboxes.php"); ?></div>
	<input type="text" id="txtValue" name="items"><br/>
	<input type="submit" value="Go!">
</div>
</form>

<script>
	document.getElementById("fit_date").valueAsDate = new Date();
	updateDate();
</script>

</html>