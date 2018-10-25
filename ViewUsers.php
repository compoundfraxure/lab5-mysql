<!doctype html>
<html>
	<head>
		<title>Bullet Boards</title>
	</head>
	<style>
		table, th, td {
			border: 1px solid black;
		}
	</style>
	<body>
		<h1>List of Users</h1>

<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	$mysqli = new mysqli("mysql.eecs.ku.edu", "w553p157", "eab3mae9", "w553p157");
	if ($mysqli->connect_errno) {
	    printf("Connect failed: %s\n", $mysqli->connect_error);
	    exit();
	}

	$query = "SELECT * FROM Users";
	if ($checkQuery = $mysqli->query($query)) {
		if ($checkQuery->num_rows > 0) {
			echo "<table>";
			while ($row = $checkQuery->fetch_assoc()) {
				echo "<tr><td>" . $row["user_id"] . "</td></tr>";
			}
			echo "</table><br />";
		}
		else {
			echo "No users found. <br>";
		}

		/* free result set */
		$checkQuery->free();
	}
	else {
		echo "Error: " . $query . "<br>" . $mysqli->error . "<br>";
	}



	echo "";
	$mysqli->close();
?>
		<a href='AdminHome.html'><button type='button'>Go Back</button></a>
	</body>
</html>
