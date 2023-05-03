<!DOCTYPE html>
<html>
<head>
	<title>Search Results</title>
  <link rel="stylesheet" href="newBookings.css">
  <link href="./newBookings.css" rel="stylesheet" />
</head>
<body>
  <h2><b> Search Results </b> </h2>
<?php
  // Retrieve the check-in and check-out dates from the URL parameters
  $checkin = $_POST['checkin'];
  $checkout = $_POST['checkout'];

  $connection = mysqli_connect("localhost", "root", "", "hotel");
			// Check connection
			if (!$connection) {
				die("Connection failed: " . mysqli_connect_error());
			}
  
  // Query the database for available rooms
  $query = "SELECT room.*, room.room_cost
            FROM room
            LEFT JOIN booking
              ON room.room_number = booking.room_number
              AND booking.booking_start <= '$checkout'
              AND booking.booking_end >= '$checkin'
            WHERE booking.room_number IS NULL";
  $result = mysqli_query($connection, $query);

  // Display the available rooms
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      // var_dump($row); // Add this line to check the contents of the $row array
      // Display room information here
      echo "Location #" . $row['LOCATION_NUM'] . "<br>" . "Room Number: " . $row['ROOM_NUMBER'] . "<br>" . $row['ROOM_TYPE'] . "<br>";
      if ($row['AMENITY_CODE'] == 1) {
        echo "Full Amenities Included" . "<br>";
      } else {
        echo "Partial Amenities Included" . "<br>";
      }
      echo $row['NOTES'] . "<br>";
      echo "Price: $" . $row['ROOM_COST'] . "<br>";
      echo '<form action="currentBookings.php" method="post">';
      echo '<input type="hidden" name="checkin" value="'.$_POST['checkin'].'">';
      echo '<input type="hidden" name="checkout" value="'.$_POST['checkout'].'">';
      echo '<input type="hidden" name="room_number" value="'.$row['ROOM_NUMBER'].'">';
      // echo '<input type="hidden" name="booking_cost" value="'.$row['room_cost'].'">';  
      echo '<input type="hidden" name="booking_cost" value="'.$row['ROOM_COST'].'">';   
      echo '<input type="hidden" name="location_number" value="'.$row['LOCATION_NUM'].'">';    
      echo "<a href='currentBookings.php'><button>Book Now</button></a><br><br>";
      echo '</form><br><br>';
    }
  } else {
    // No available rooms
    echo "Sorry, there are no available rooms for the selected dates.";
  }


  if ($connection !== null) {
    mysqli_close($connection);
  }

    ?>
	<a href="newBookings.php">None of these results work for you? Try a different date!</a> <br>

</body>
<footer>
  <p>&copy; 2023 Spynx Inc. All rights reserved. For Copyright concerns, please contact CEO Christopher Lanclos.</p>
</footer>
</html>
