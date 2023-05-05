<!-- Alex Tung -->
<!-- This code allows the customer to view, add, update and delete reviews  -->
<!-- Functionality Set 4 -->

<!DOCTYPE html>
<html>
<head>
	<title>Hotel Customer Reviews</title>
    <link rel="stylesheet" href="roomCharges.css" type="text/css">
</head>
<body>

    <header>
        <a class="active" href="welcome.php">Welcome</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="manageAccounts.php">Manage Account</a>
        <a href="updateaccount.php">Update Account</a>
        <a href="review.php">Reviews</a>
        <a href="newBookings.php">New Bookings</a>
        <a href="currentBookings.php">Current Bookings</a>
        <a href="roomCharges.php">Room Charges</a>
        <a href="manageBooking.php">Manage Booking</a>
        <a href="manageInventory.php">Manage Inventory</a>
    </header>

	<h1>Hotel Customer Reviews</h1>

	<!-- Add review form -->
	<form method="post">
		<h2>Add a Review</h2>
		<label for="title">Title:</label>
		<input type="text" name="title" required><br>

		<label for="name">Name:</label>
		<input type="text" name="name" required><br>

        <label for="location">Location ID:</label>
		<select name="location" required>
			<option value="">Select a location</option>
			<option value="1">Location 1: Fairmount Inn</option>
			<option value="2">Location 2: Hilton Mansion</option>
			<option value="3">Location 3: Motel Six</option>
			<option value="4">Location 4: Hampton Suites</option>
			<option value="5">Location 5: Mariot Courtyard</option>
		</select><br>

		<label for="rating">Rating:</label>
		<select name="rating" required>
			<option value="">Select a rating</option>
			<option value="1">1 star</option>
			<option value="2">2 stars</option>
			<option value="3">3 stars</option>
			<option value="4">4 stars</option>
			<option value="5">5 stars</option>
		</select><br>

		<label for="length_of_stay">Length of Stay (days):</label>
		<input type="number" name="length_of_stay" required><br>

        <label for="stay_date">Stay Date (YYYY-MM-DD):</label>
		<input type="text" name="stay_date" required><br>

        <label for="review_date">Review Date (YYYY-MM-DD):</label>
		<input type="text" name="review_date" required><br>

		<label for="comment">Comment:</label>
		<textarea name="comment" required></textarea><br>
        
		<input type="submit" name="submit" value="Submit">
	</form>


    <?php

        // Database connection code
        $dbhost = "localhost";
        $dbuser = "alex9947";
        $dbpass = "alex9947";
        $db = "hotel";

        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if(isset($_POST['submit'])){
            $find_id = "SELECT REVIEW_ID FROM review ORDER BY REVIEW_ID DESC LIMIT 1";
            $id_found = mysqli_query($conn, $find_id);
            $row = mysqli_fetch_assoc($id_found);

            $review_id = $row['REVIEW_ID'] + 1;
            $location_num = $_POST['location'];
            $username = $_POST['name'];
            $title = $_POST['title'];
            $review_rating = $_POST['rating'];
            $review_body = $_POST['comment'];
            $review_stay_date = $_POST['stay_date'];
            $review_stay_len = $_POST['length_of_stay'];
            $review_create_date = $_POST['review_date'];
            $review_helpful = 1;
            
            // INSERT QUERY
            $queryy = "INSERT INTO review (REVIEW_ID, LOCATION_NUMBER, USERNAME, REVIEW_TITLE, REVIEW_RATING, REVIEW_BODY, REVIEW_TIME_OF_STAY, REVIEW_DAYS_STAYED, REVIEW_TIME_CREATED, REVIEW_HELPFUL)
                       VALUES ('$review_id', '$location_num', '$username', '$title', '$review_rating', '$review_body', '$review_stay_date', '$review_stay_len', '$review_create_date', '$review_helpful')";
            $result = mysqli_query($conn, $queryy);
        }

        mysqli_close($conn);
    ?>

	<!-- View reviews section -->
	<h2>View Reviews</h2>
	<table>
		<tr>
            <th>Review ID</th>
            <th>Location ID</th>
			<th>Review Title</th>
			<th>Name</th>
			<th>Rating</th>
            <th>Review</th>
            <th>Stay Date</th>
			<th>Length Of Stay</th>
            <th>Review Date</th>
			<!-- <th>Review Helpful</th> -->
			<th>Action</th>
		</tr>
		<!-- PHP code to fetch reviews from database and display them in a table -->
		<?php
			// Database connection code
            $dbhost = "localhost";
            $dbuser = "alex9947";
            $dbpass = "alex9947";
            $db = "hotel";

			$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
            
			// SQL query to select all reviews
            // SELECT QUERY
			$sql = "SELECT * FROM review";
			$result = mysqli_query($conn, $sql);

			// Display each review in a table row
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
                    echo "<td>" . $row["REVIEW_ID"] . "</td>";
                    echo "<td>" . $row["LOCATION_NUMBER"] . "</td>";
					echo "<td>" . $row["REVIEW_TITLE"] . "</td>";
					echo "<td>" . $row["USERNAME"] . "</td>";
					echo "<td>" . $row["REVIEW_RATING"] . " stars</td>";
                    echo "<td>" . $row["REVIEW_BODY"] . "</td>";
                    echo "<td>" . $row["REVIEW_TIME_OF_STAY"] . "</td>";
					echo "<td>" . $row["REVIEW_DAYS_STAYED"] . " days</td>";
                    echo "<td>" . $row["REVIEW_TIME_CREATED"] . "</td>";
                    // echo "<td>" . $row["REVIEW_HELPFUL"] . "</td>";
                    
                    // DELETE QUERY (check delete-review.php)
                    echo "<td>";
                    echo "<form method='POST' action='delete-review.php'>";
                    echo "<input type='hidden' name='review_id' value='" . $row["REVIEW_ID"] . "'>";
                    echo "<button type='submit' name='delete_review'>Delete</button>";
                    echo "</form>";

                    // UPDATE QUERY (check update-review.php)
                    echo "<form method='POST' action='edit-review.php'>";
                    echo "<input type='hidden' name='review_id1' value='" . $row["REVIEW_ID"] . "'>";
                    echo "<input type='text' name='edited_review_body' value='" . $row["REVIEW_BODY"] . "'>";
                    echo "<input type='submit' value='Update review'>";
                    echo "</form>";
                    echo "</td>";

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