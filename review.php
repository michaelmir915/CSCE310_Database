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
		<label for="title">Title:</label>
		<input type="text" name="title" required><br>
		<label for="name">Name:</label>
		<input type="text" name="name" required><br>
		<label for="rating">Rating:</label>
		<select name="rating" required>
			<option value="">Select a rating</option>
			<option value="1">1 star</option>
			<option value="2">2 stars</option>
			<option value="3">3 stars</option>
			<option value="4">4 stars</option>
			<option value="5">5 stars</option>
		</select><br>
		<label for="length_of_stay">Length of Stay (nights):</label>
		<input type="number" name="length_of_stay" required><br>
		<label for="comment">Comment:</label>
		<textarea name="comment" required></textarea><br>
		<input type="submit" value="Submit">
	</form>

	<!-- View reviews section -->
	<h2>View Reviews</h2>
	<table>
		<tr>
			<th>Title</th>
			<th>Name</th>
			<th>Rating</th>
			<th>Length of Stay</th>
			<th>Comment</th>
			<th>Action</th>
		</tr>
		<!-- PHP code to fetch reviews from database and display them in a table -->
		<?php
			// Database connection code
			$conn = mysqli_connect("localhost", "alex9947", "alex9947", "hotel");
			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
            
            // TODO: select update insert delete # do one of each Alex

			// SQL query to select all reviews
			$sql = "SELECT * FROM review";
			$result = mysqli_query($conn, $sql);

			// Display each review in a table row
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row["REVIEW_TITLE"] . "</td>";
					echo "<td>" . $row["USERNAME"] . "</td>";
					echo "<td>" . $row["REVIEW_RATING"] . " stars</td>";
					echo "<td>" . $row["REVIEW_TIME_OF_STAY"] . " nights</td>";
					echo "<td>" . $row["REVIEW_BODY"] . "</td>";
					echo "<td><a href='edit-review.php?id=" . $row["REVIEW_ID"] . "'>Edit</a> | <a href='delete-review.php?id=" . $row["REVIEW_ID"] . "'>Delete</a></td>";
					echo "</tr>";
				}
			} else {
				echo "<tr><td colspan='6'>No reviews found.</td></tr>";
			}

			mysqli_close($conn);
		?>
	</table>

</body>
</html>