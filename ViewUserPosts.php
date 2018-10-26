<!doctype html>
<html>
	<head>
		<title>Posts by User</title>
	</head>
	<style>
		table, th, td {
			border: 1px solid black;
		}
	</style>
	<body>


<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	$mysqli = new mysqli("mysql.eecs.ku.edu", "w553p157", "eab3mae9", "w553p157");
	if ($mysqli->connect_errno) {
	    printf("Connect failed: %s\n", $mysqli->connect_error);
	    exit();
	}

	$username = "";
	$username = test_input($_POST["userList"]);

	$query = "SELECT user_id FROM Users WHERE user_id='" . $username . "';";
	if ($checkQuery = $mysqli->query($query)) {
		if ($checkQuery->num_rows > 0 && $username !== "") {
			echo "<h1>List of Posts by " . $username . "</h1>";

			$query = "SELECT post_id, content FROM Posts WHERE author_id='" . $username . "' ORDER BY post_id;";
			if ($fetchQuery = $mysqli->query($query)) {
				if ($fetchQuery->num_rows > 0) {
					echo "<table width='100%'>\n<th>Post ID</th>\n<th>Post</th>\n";
					while ($row = $fetchQuery->fetch_assoc()) {
						echo "<tr><td style='text-align: center'>" . $row["post_id"] . "</td>\n<td>" . nl2br($row["content"]) . "</td></tr>\n";
					}
					echo "</table>";
				}
				else {
					echo "No posts found.<br />";
				}

				/* free result set */
				$fetchQuery->free();
			}
			else {
				echo "Error: " . $query . "<br>" . $mysqli->error . "<br>";
			}

			/* free result set */
			$checkQuery->free();
		}
		else {
			echo "Error: Invalid username submitted.<br />";
		}
	}
	else {
		echo "Error: " . $query . "<br>" . $mysqli->error . "<br>";
	}

	echo "<br /><a href='ViewUserPosts.html'><button type='button'>Go Back</button></a>";
	$mysqli->close();

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = addslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>
	</body>
</html>
