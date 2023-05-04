<!DOCTYPE html>
<!-- MANAGER PAGE -->
<html>
<head>
	<title>Search Results</title>
  <!-- <link rel="stylesheet" href="nmanageBookings.css">
  <link href="./manageBookings.css" rel="stylesheet" /> -->
  <link rel="stylesheet" type="text/css" href="manageBooking.css">
	
</head>
<body>
	<h1>Booking Management</h1>
	
	<!-- Form for adding notes to a booking -->
	<h2>Add Notes</h2>
	<form action="manageBooking.php" method="post">
			Booking Key: <input type="text" name="booking_key"><br>
			Notes: <textarea name="booking_notes"></textarea><br>
			<input type="submit" value="Add Notes">
	</form>
	
	<hr>
	
	<!-- Table for displaying bookings -->
	<h2>All Bookings being made on Spynx</h2>
	<table>
		<tr>
			<th>Booking_Key</th>
			<th>Username</th>
			<th>Booking_Cost</th>
			<th>Start_Date</th>
			<th>End_Date</th>
			<th>Notes</th>
			<th>Booking_Food</th>
			<th>Location_Number</th>
			<th>Room_Number</th>
		</tr>
		<?php
    $connection = mysqli_connect("localhost", "root", "", "hotel");
    // Check connection
    if (!$connection) {
      die("Connection failed: " . mysqli_connect_error());
    }
		// Retrieve all of the user's bookings from the database
		$query = "SELECT * FROM booking";
		$result = mysqli_query($connection, $query);

		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				// Display booking information here
				echo "<tr>";
				echo "<td>" . $row['BOOKING_KEY'] . "</td>";
				echo "<td>" . $row['USERNAME'] . "</td>";
				echo "<td>" . $row['BOOKING_COST'] . "</td>";
				echo "<td>" . $row['BOOKING_START'] . "</td>";
				echo "<td>" . $row['BOOKING_END'] . "</td>";
				echo "<td>" . $row['BOOKING_NOTES'] . "</td>";
				echo "<td>" . $row['BOOKING_FOOD'] . "</td>";
				echo "<td>" . $row['LOCATION_NUMBER'] . "</td>";
				echo "<td>" . $row['ROOM_NUMBER'] . "</td>";
				echo "<td>";
				echo "<form method='post' action='manageBookings.php'>";
				echo "<input type='hidden' name='booking_key' value='" . $row['BOOKING_KEY'] . "'>";
				echo "<input type='submit' name='cancel_booking' value='Cancel Booking'>";
				echo "</form>";
				echo "</td>";
				echo "</tr>";
			}
		} else {
			// User has no bookings
			echo "<tr><td colspan='7'>You have no bookings.</td></tr>";
		}
		
		// Cancel booking
		if (isset($_POST['cancel_booking'])) {
			$booking_key = $_POST['booking_key'];
			$query = "DELETE FROM booking WHERE booking_key = '$booking_key'";
			$result = mysqli_query($connection, $query);
		
			if ($result) {
				// Booking was canceled
				echo '<script>alert("Booking Cancelled")</script>';
				echo "<meta http-equiv='refresh' content='0;url=manageBookings.php'>";
			} else {
				// Cancellation failed
				echo '<script>alert("Cancellation Failed")</script>';
			}
	  }
  if (isset($_POST['booking_key']) && isset($_POST['booking_notes'])) {
    $booking_key = $_POST['booking_key'];
    $booking_notes = $_POST['booking_notes'];

    // Update the booking_notes column in the booking table
    $query = "UPDATE booking SET booking_notes='$booking_notes' WHERE booking_key='$booking_key'";
    $result = mysqli_query($connection, $query);

    if ($result) {
      echo '<script>alert("Note added successfully.")</script>';
      echo "<meta http-equiv='refresh' content='0'>";
    } else {
      echo '<script>alert("Error: Failed to add note.")</script>';
    }
  }

  // Close the database connection
  if ($connection !== null) {
    mysqli_close($connection);
  }
  ?>
</table>
</body>
<footer>
  <p>&copy; 2023 Spynx Inc. All rights reserved. For Copyright concerns, please contact CEO Christopher Lanclos.</p>
</footer>
</html>
