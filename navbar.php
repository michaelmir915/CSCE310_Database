<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";

// Define an array of links for the navbar
$links = "";

//Not Logged it
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    $links = array(
        "Bookings" => "newBookings.php",
        "Current Bookings" => "currentBookings.php",
        "Room Charges" => "roomCharges.php",
        "Review Accout" => "review.php",
        "Log In" => "login.php"
    );
//Is a normal User
} else if(is_null($_SESSION["id"])){
    $links = array(
        "Bookings" => "newBookings.php",
        "Current Bookings" => "currentBookings.php",
        "Room Charges" => "roomCharges.php",
        "Review Accout" => "review.php",
        "Profile" => "welcome.php"
    );
//Is a Empployee
} else {
    $links = array(
        "Manage Bookings" => "manageBooking.php",
        "Manage Inventory" => "manageInventory.php",
        "Profile" => "welcome.php"
    );
}
?>

<!-- Output the HTML for the navbar using PHP -->
<head>
    <header>
        <?php foreach ($links as $title => $url): ?>
            <a href="<?php echo $url; ?>"><?php echo $title; ?></a>
        <?php endforeach; ?>
    </header>
    <link rel="stylesheet" href="./roomCharges.css" type="text/css">
</head>

<!-- Add JavaScript to make the navbar interactive -->
<script>
    const navLinks = document.querySelectorAll('nav ul li a');
    navLinks.forEach(link => {
        if (link.href === location.href) {
            link.classList.add('active');
        }
    });
</script>