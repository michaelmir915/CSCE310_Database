<!-- Alex Tung -->

<?php
// establish database connection here

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "hotel";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the review ID is set
if(isset($_POST["review_id"])) {
    $review_id = $_POST["review_id"];

    // Prepare a delete statement
    $sql = "DELETE FROM review WHERE REVIEW_ID=$review_id";

    // Execute the delete statement
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the review list page
        header("Location: review.php");
        echo "Review deleted successfully";
        exit();
    } else {
        // Handle the error
        echo "Error deleting review: " . $conn->error;
    }
} else {
    // Handle the error
    echo "Review ID not set.";
}

mysqli_close($conn);

?>