<html>
	<head>
		<title>My address book</title>
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script>
			// document ready specifies a function
			// to execute when page is fully loaded
			$(document).ready(function() {
				var request = new Object();
				request.type = "list";

				// as soon as page loads
				// I call data.php to retrive
				// records of people table
				var posting = $.post('data.php', request);

				// as soon as data.php returns
				// the records, list them in
				// the table
				posting.done(function(data) {
					list_table($(data));
				});

				// bind a click action to
				// submit button, so that
				// we submit data to data.php
				$("#add").click(function() {
					var request = new Object();
					request.type = "add";
					request.name = $("#name").val();
					request.surname = $("#surname").val();

					var posting = $.post('data.php', request);

					posting.done(function(data) {
						list_table($(data));
					});

				});

			});

			// remove the contents of table first
			// then append the records
			function list_table(data) {
				$("#tbl tr").remove();
				$("#tbl").append("<tr><td>Name</td><td>Surname</td></tr>");
				for ( i = 0; i < data.length; i++) {
					$("#tbl").append("<tr><td>" + data[i]['name'] + "</td><td>" + data[i]['surname'] + "</td></tr>");
				}
			}

		</script>
	</head>
	<body>
		<h2>Poeple in the database</h2>
		<table border=1 id="tbl">

		</table>

		<h2>Add person</h2>
		<table>
			<tr>
				<td>Name:</td>
				<td>
				<input type="text" name="name" id="name">
				</td>
			</tr>
			<tr>
				<td>Surname:</td>
				<td>
				<input type="text" name="surname" id="surname">
				</td>
			</tr>
		</table>
		<input type="submit" name="submit" value="add" id="add">
	</body>
</html>
