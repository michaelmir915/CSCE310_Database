<!DOCTYPE html>
<html>
<head>
	<title>Hotel Customer Reviews</title>
</head>
<body>
	<h1>Hotel Customer Reviews</h1>

	<!-- Add review form -->
	<form action="submit-review.php" method="post">
		<h2>Add a Review</h2>
		<label for="name">Name:</label>
		<input type="text" name="name" required><br>
		<label for="comment">Comment:</label>
		<textarea name="comment" required></textarea><br>
		<input type="submit" value="Submit">
	</form>

	<!-- View reviews section -->
	<h2>View Reviews</h2>
	<table>
		<tr>
			<th>Name</th>
			<th>Comment</th>
			<th>Action</th>
		</tr>
		<!-- PHP code to fetch reviews from database and display them in a table -->
		<?php
			// Database connection code
			$conn = mysqli_connect("localhost", "username", "password", "hotel_reviews");
			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			// SQL query to select all reviews
			$sql = "SELECT * FROM reviews";
			$result = mysqli_query($conn, $sql);

			// Display each review in a table row
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row["name"] . "</td>";
					echo "<td>" . $row["comment"] . "</td>";
					echo "<td><a href='edit-review.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete-review.php?id=" . $row["id"] . "'>Delete</a></td>";
					echo "</tr>";
				}
			} else {
				echo "<tr><td colspan='3'>No reviews found.</td></tr>";
			}

			mysqli_close($conn);
		?>
	</table>

</body>
</html>