<!DOCTYPE html>
<html>
<head>
<title>styledroq</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script src="https://code.jquery.com/jquery-1.7.2.js"></script>
<script>
	let todays_previous_clothing = "";
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
				todays_previous_clothing = updateTextArea();
				updateTextArea();
				$("#fit_rest").show();
			}
		});
	}
    function updateTextArea() {
        var allVals = $('input.item:checked').map( 
        function() {return this.value;}).get().join("_");
		if (allVals == "") { allVals = "_"; }
        $('#txtValue').val(allVals);
		if (allVals == todays_previous_clothing) {
			$("#submit_fit").prop('value', 'No changes');
			$("#submit_fit").prop('disabled', true);
		} else {
			$("#submit_fit").prop('value', 'Save changes');
			$("#submit_fit").prop('disabled', false);
		}
		return allVals;
    }
    $(function () {
        $('#fit input.item').click(updateTextArea);
        $('#fit_date').change(updateDate);
        updateTextArea();
    });
</script>
<style>
	label.stylchek input[type=checkbox] { display:none; }
	label.stylchek {
		position: relative;
		display: inline-block;
		width: 10.0em; height: 10.0em;
		color:#000; cursor: pointer;
	}
	label.stylchek span { display: none; position: absolute; bottom: 0; line-height: .75em; padding: 2px 2px; border-radius: 2px; margin-left: 4px; }
	label.stylchek:has(input:checked) { color:#a0a; }
	label.stylchek img {
		position: absolute;
		width: 10.0em; height: 10.0em;
		opacity: 60%;
	}
	label.stylchek img { border: 2px solid transparent; border-radius: 5px; }
	label.stylchek:has(input:checked) img { border-color: #f0f; opacity: 100%; background-color: #faf;}
</style>
<style>
	input[type=submit] {
		margin: 5px;
		font-size: 1em; font-family: monospace;
		background-color: #9cc;
		cursor: pointer;
	}
	input[type=submit]:disabled {
		background-color: #bdd;
		cursor: initial;
	}
</style>
</head>

<body>

<?php require_once 'db_connect.php' ?>
<?php require_once 'echo_userident_form.php' ?>

<h3>Daily fit</h3>
<form id="fit" action="/do_write_fit.php">
<input type="date" name="day" id="fit_date">
<div id="fit_rest">
	<div id="clothing_items">
	<?php include("echo_allclothing_checkboxes.php"); ?></div>
	<input type="submit" value="Save to DB" id="submit_fit"> <input type="text" id="txtValue" name="items" style="display:none;">
</div>
</form>

<h3>Add piece of clothing</h3>
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

<?php include("echo_allclothing2_editdropdown.php"); ?></div>
</body>

<script>
	document.getElementById("fit_date").valueAsDate = new Date();
	updateDate();
</script>

</html>