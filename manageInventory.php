<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";

//Employee Force Login
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || is_null($_SESSION["id"])){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Food Inventory</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="\manageInventory.css" type="text/css">
</head>
<body>
	<header>
		<h1>Hotel Food Inventory</h1>
	</header>
	<main>
		<h2>Food & Beverages</h2>
		<table>
			<thead>
				<tr>
					<th>Item</th>
					<th>Description</th>
					<th>Price</th>
					<th>Quantity</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php
				// // Initialize the session
				// session_start();

				// // Include config file
				// require_once "config.php";

				// //Forces Login
				// // Check if the user is logged in, otherwise redirect to login page
				// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
				//     header("location: login.php");
				//     exit;
				// }
				// Connect to the MySQL database
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "hotel";
				$conn = mysqli_connect($servername, $username, $password, $dbname);

				// Check connection
				if (!$conn) {
				    die("Connection failed: " . mysqli_connect_error());
				}

				// Retrieve the menu items from the MySQL database
				
				
				$sql = "SELECT * FROM food";
				$result = mysqli_query($conn, $sql);
				
				if (mysqli_num_rows($result) > 0) {
					// Output the menu items in a table row
				    while($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
				        echo "<td>" . $row["FOOD_NAME"] . "</td>";
				        echo "<td>" . $row["FOOD_INGREDIENTS"] . "</td>";
				        echo "<td>$" . $row["COST"] . "</td>";
						echo "<td>" . $row["FOOD_AVAILABILITY"] . "</td>";
						echo '<td>
						<form method="POST">
						<input type="hidden" name="LocationNumber" value="' . $row["LOCATION_NUMBER"] . '">
						<input type="hidden" name="itemNumber" value="' . $row["ITEM_NUMBER"] . '">
						<label for="price">New Price:</label>
						<input type="text" name="price" id="price">
						<label for="quantity"><br>New Quantity:</label>
						<input type="number" name="quantity" id="quantity">
						<button type="submit" name="update">Update</button>
						</form>
						</td>';
				        echo "</tr>";
				    }
				} else {
					echo "0 results";
				}
				
				if (isset($_POST['update'])){
					$location_number = $_POST["LocationNumber"];
					$itemNumber = $_POST['itemNumber'];
					$price = $_POST['price'];
					$quantity = $_POST['quantity'];
					$result = mysqli_query($conn, $sql);
					
					$sql = "UPDATE food SET COST = '$price', FOOD_AVAILABILITY = '$quantity' WHERE food.LOCATION_NUMBER = '$location_number' AND food.ITEM_NUMBER = $itemNumber";
					echo '<script>alert("Item Updated!")</script>';
					$result = mysqli_query($conn, $sql);
					echo "<meta http-equiv='refresh' content='0;url=manageInventory.php'>";
				}
				mysqli_close($conn);
			?>
			</tbody>
		</table>
	</main>
</body>

<footer>
  <p>&copy; 2023 Spynx Inc. All rights reserved. For Copyright concerns, please contact CEO Christopher Lanclos.</p>
</footer>
</html>
<?php
  // Close the database connection
  mysqli_close($conn);
?>






