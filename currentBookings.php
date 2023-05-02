<!DOCTYPE html>
<html>
<head>
	<title>Search Results</title>
  <link rel="stylesheet" href="newBookings.css">
  <link href="./newBookings.css" rel="stylesheet" />
</head>
<body>
<?php

$connection = mysqli_connect("localhost", "root", "", "hotel");
// Check connection
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the form values
$room_number = $_POST['room_number'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$booking_cost = $_POST['booking_cost'];

// Insert the booking into the database
$query = "INSERT INTO booking (room_number, booking_start, booking_end, booking_cost, username) VALUES ('$room_number', '$checkin', '$checkout', '$booking_cost', 'Mykell')";
$result = mysqli_query($connection, $query);

if ($result) {
    // Booking was successful
    echo "Booking successful!";

    // Retrieve all of the user's bookings from the database
    $query = "SELECT * FROM booking WHERE username = 'MyKell'";
    $result = mysqli_query($connection, $query);

    // Display the user's bookings
    echo "<h2>Your Bookings</h2>";
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Display booking information here
            echo "Booking number: " . $row['booking_key'] . "<br>";
            echo "Room Number: " . $row['room_number'] . "<br>";
            echo "Start Date: " . $row['booking_start'] . "<br>";
            echo "End Date: " . $row['booking_end'] . "<br><br>";
        }
    } else {
        // User has no bookings
        echo "You have no bookings.";
    }

} else {
    // Booking failed
    echo "Booking failed.";
}

// Close the database connection

if ($connection !== null) {
  mysqli_close($connection);
}

?>

</body>
<footer>
  <p>&copy; 2023 Spynx Inc. All rights reserved. For Copyright concerns, please contact CEO Christopher Lanclos.</p>
</footer>
</html>
