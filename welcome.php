<?php
// Initialize the session
session_start();
 
$type = '';

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if(is_null($_SESSION["id"])){
    $type = "updateaccount.php";
} else {
    if($_SESSION["id"] == 0){
        $type = "manageAccounts.php";
    } else {
        $type = "updateAccountEmployee.php";
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
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

    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
        <a href=<?php echo htmlspecialchars($type); ?> class="btn btn-warning">Update Account Information</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
</body>
</html>