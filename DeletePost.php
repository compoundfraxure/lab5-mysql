<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	$mysqli = new mysqli("mysql.eecs.ku.edu", "w553p157", "eab3mae9", "w553p157");
	if ($mysqli->connect_errno) {
	    printf("Connect failed: %s\n", $mysqli->connect_error);
	    exit();
	}

	$deletePosts = $_POST['postToDelete'];

	if (empty($deletePosts)) {
		echo "<br />Error: No posts selected for deletion.<br /><br />";
	}
	else {
		foreach ($deletePosts as $post) {
			$query = "SELECT post_id FROM Posts WHERE post_id='" . $post ."';";
			if ($checkQuery = $mysqli->query($query)) {
				if ($checkQuery->num_rows > 0) {
					$query = "DELETE FROM Posts WHERE post_id='" . $post . "';";
					if ($deleteQuery = $mysqli->query($query)) {
						echo "Successfully deleted post " . $post . ".<br />";
					}
					else {
						echo "Error: " . $query . "<br>" . $mysqli->error . "<br>";
					}
				}
				else {
					echo "Error: No post with the ID " . $post . " found.<br />";
				}
			}
			else {
				echo "Error: " . $query . "<br>" . $mysqli->error . "<br>";
			}

		}
	}


	echo "<br /><a href='DeletePost.html'><button type='button'>Go Back</button></a>";
	$mysqli->close();

?>
