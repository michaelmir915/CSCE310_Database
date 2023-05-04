<!-- Alex Tung -->
<!-- This is some helper function code needed to edit or update a review -->
<!-- Functionality Set 4 -->

<?php
// establish database connection here

$dbhost = "localhost";
$dbuser = "alex9947";
$dbpass = "alex9947";
$db = "hotel";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the review ID is set
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $review_id = $_POST["review_id1"];
    $new_review_body = $_POST["edited_review_body"];

    // Prepare a update statement
    $sql = "UPDATE review SET REVIEW_BODY='$new_review_body' WHERE REVIEW_ID='$review_id'";

    // Execute the update statement
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the review list page
        header("Location: review.php");
        echo "Review Updated successfully";
        exit();
    } else {
        // Handle the error
        echo "Error updating review: " . $conn->error;
    }
} else {
    // Handle the error
    echo "Review ID not set.";
}

mysqli_close($conn);

?>