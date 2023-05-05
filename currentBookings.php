<!DOCTYPE html>
<html>
<head>
	<title>Search Results</title>
	<link rel="stylesheet" href="./roomCharges.css" type="text/css">
</head>
<body>
<?php
include 'navbar.php';
//Forces Login
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$username = $_SESSION["username"]


// Retrieve the form values
// Retrieve the form values
$room_number = isset($_POST['room_number']) ? $_POST['room_number'] : null;
$checkin = isset($_POST['checkin']) ? $_POST['checkin'] : null;
$checkout = isset($_POST['checkout']) ? $_POST['checkout'] : null;
$booking_cost = isset($_POST['booking_cost']) ? $_POST['booking_cost'] : null;
$location_number = isset($_POST['location_number']) ? $_POST['location_number'] : null;

// Insert the booking into the database
if ($room_number && $checkin && $checkout && $booking_cost && $location_number) {
    $query = "INSERT INTO booking (room_number, booking_start, booking_end, booking_cost, username, location_number) VALUES ('$room_number', '$checkin', '$checkout', '$booking_cost', '$username', '$location_number')";
    $result = mysqli_query($link, $query);

    if ($result) {
        // Booking was successful
        echo "Booking successful!";

        // Retrieve all of the user's bookings from the database
        $query = "SELECT * FROM booking WHERE username = 'MyKell'";
        $result = mysqli_query($link, $query);

        // Display the user's bookings
        echo "<h2>Your Bookings</h2>";
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Display booking information here
                echo "Booking number: " . $row['BOOKING_KEY'] . "<br>";
                echo "Location number: " . $row['LOCATION_NUMBER'] . "<br>";
                echo "Room Number: " . $row['ROOM_NUMBER'] . "<br>";
                echo "Start Date: " . $row['BOOKING_START'] . "<br>";
                echo "End Date: " . $row['BOOKING_END'] . "<br>";
                echo '<form action="currentBooking.php" method="post">';
                echo '<input type="hidden" name="booking_key" value="'.$row['BOOKING_KEY'].'">';
                echo '<input type="submit" name="cancel_booking" value="Cancel Booking">';
                echo '</form><br><br>';
            }
        } else {
            // User has no bookings
            echo "You have no bookings.";
        }
    } else {
        // Booking failed
        echo "Booking failed.";
    }
} else {
    // Form values not set
    $query = "SELECT * FROM booking WHERE username = 'MyKell'";
    $result = mysqli_query($link, $query);
     // Display the user's bookings
     echo "<h2>Your Bookings</h2>";
     if (mysqli_num_rows($result) > 0) {
         while ($row = mysqli_fetch_assoc($result)) {
             // Display booking information here
             echo "Booking number: " . $row['BOOKING_KEY'] . "<br>";
             echo "Location number: " . $row['LOCATION_NUMBER'] . "<br>";
             echo "Room Number: " . $row['ROOM_NUMBER'] . "<br>";
             echo "Start Date: " . $row['BOOKING_START'] . "<br>";
             echo "End Date: " . $row['BOOKING_END'] . "<br>";
             echo '<form action="currentBookings.php" method="post">';
             echo '<input type="hidden" name="booking_key" value="'.$row['BOOKING_KEY'].'">';
             echo '<input type="submit" name="cancel_booking" value="Cancel Booking">';
             echo '</form><br><br>';
         }
     } else {
         // User has no bookings
         echo "You have no bookings.";
     }
}

// Cancel booking
if (isset($_POST['cancel_booking'])) {
    $booking_key = $_POST['booking_key'];
    $query = "DELETE FROM booking WHERE booking_key = '$booking_key'";
    $result = mysqli_query($link, $query);

    if ($result) {
        // Booking was canceled
        echo '<script>alert("Booking Cancelled")</script>';
        echo "<meta http-equiv='refresh' content='0;url=currentBookings.php'>";
    } else {
        // Cancellation failed
        echo '<script>alert("Cancellation Failed")</script>';
    }
}

// Close the database connection
if ($link !== null) {
    mysqli_close($link);
}


?>

</body>
<footer>
  <p>&copy; 2023 Spynx Inc. All rights reserved. For Copyright concerns, please contact CEO Christopher Lanclos.</p>
</footer>
</html>
