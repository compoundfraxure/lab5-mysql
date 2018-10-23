<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	$mysqli = new mysqli("mysql.eecs.ku.edu", "w553p157", "eab3mae9", "w553p157");
	if ($mysqli->connect_errno) {
	    printf("Connect failed: %s\n", $mysqli->connect_error);
	    exit();
	}

	$username = "";
	$username = test_input($_POST["username"]);
	$content = "";
	$content = test_input($_POST["content"]);

	if ($content !== "") {
		$query = "SELECT user_id FROM Users WHERE user_id='" . $username . "';";
		if ($checkQuery = $mysqli->query($query)) {
			if ($checkQuery->num_rows !== 0) {
				$query = "INSERT INTO Posts (content, author_id) VALUES ('" . $content . "', '" . $username . "');";
				if ($insertQuery = $mysqli->query($query)) {
					echo "Successfully submitted post.<br>";
				}
				else {
					echo "Error: " . $query . "<br>" . $mysqli->error . "<br>";
				}
			}
			else {
				echo "Error: Cannot create post - username does not exist.<br>";
			}

			/* free result set */
		    $checkQuery->free();
		}
		else {
			echo "Error: " . $query . "<br>" . $mysqli->error . "<br>";
		}
	}
	else {
		echo "Error: Cannot create post - post content was left blank.<br>";
	}


	echo "<a href='CreatePosts.html'><button type='button'>Go Back</button></a>";
	$mysqli->close();

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = addslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>
