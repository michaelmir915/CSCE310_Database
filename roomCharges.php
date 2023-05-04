
<!DOCTYPE html>
<html>
<head>
	<title>Room Service Menu</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="\roomCharges.css" type="text/css">
</head>
<body>
	<header>
		<h1>Room Service Menu</h1>
	</header>
	<main>
		<h2>Food & Beverages</h2>
		<table>
			<thead>
				<tr>
					<th>Item</th>
					<th>Description</th>
					<th>Price</th>
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
						echo '<td>
              					<form method="POST">
									<input type="hidden" name="LocationNumber" value="' . $row["LOCATION_NUMBER"] . '">
									<input type="hidden" name="itemNumber" value="' . $row["ITEM_NUMBER"] . '">
              					    <input type="hidden" name="itemName" value="' . $row["FOOD_NAME"] . '">
              					    <button type="submit" name="addToCart">Add to order</button>
              					</form>
          					 </td>';
				        echo "</tr>";
				    }
				} else {
				    echo "0 results";
				}
				if (isset($_POST['addToCart'])){
					$location_number = $_POST["LocationNumber"];
					$itemName = $_POST['itemName'];
					$itemNumber = $_POST['itemNumber'];
					$result = mysqli_query($conn, "SELECT MAX(ORDER_NUMBER) FROM food_list WHERE LOCATION_NUMBER = $location_number");
					if ($result !== false) {
					    $row = mysqli_fetch_row($result);
					    $prevOrderNum = $row[0] ?? 0;
					} else {
					    echo "Error: " . mysqli_error($conn);
					    $prevOrderNum = 0;
					}
					$orderNum = $prevOrderNum + 1;
					//Room number is currently hard coded -- Need login functionality to fix this
					$sql = "INSERT INTO food_list (LOCATION_NUMBER, ORDER_NUMBER, ITEM_NUMBER, ROOM_NUMBER) VALUES ('$location_number', '$orderNum', '$itemNumber', '1')";
					$result = mysqli_query($conn, $sql);
					echo '<script>alert("' . $itemName . ' added to cart! \n Order Number: '. $orderNum .'")</script>';
					//decrease availability in food table
					$sql = "UPDATE food SET FOOD_AVAILABILITY = FOOD_AVAILABILITY - 1 WHERE LOCATION_NUMBER = '$location_number' AND ITEM_NUMBER = '$itemNumber'";
					$result = mysqli_query($conn, $sql);
				}

				mysqli_close($conn);
			?>
			</tbody>
		</table>
		<h2>Your Order</h2>
		<table>
			<thead>
				<tr>
					<th>Item</th>
					<th>Price</th>
					<th>Order Number</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php
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
				
				if (isset($_POST['removeFromOrder'])){
					$location_number = $_POST["LocationNumber"];
					$itemNumber = $_POST['itemNumber'];
					$itemName = $_POST['itemName'];
					$orderNum = $_POST['orderNum'];
					$sql = "DELETE FROM food_list WHERE food_list.LOCATION_NUMBER = '$location_number' AND food_list.ORDER_NUMBER = '$orderNum'";
					$result = mysqli_query($conn, $sql);
					//Room number is currently hard coded -- Need login functionality to fix this
					echo '<script>alert("' . $itemName . ' removed from order!")</script>';
					//increase availability in food table
					$sql = "UPDATE food SET FOOD_AVAILABILITY = FOOD_AVAILABILITY + 1 WHERE LOCATION_NUMBER = '$location_number' AND ITEM_NUMBER = '$itemNumber'";
					$result = mysqli_query($conn, $sql);
				}
				// Retrieve the order from the MySQL database
				$sql = "SELECT * FROM food
				INNER JOIN food_list ON food.LOCATION_NUMBER = food_list.LOCATION_NUMBER AND food.ITEM_NUMBER = food_list.ITEM_NUMBER
				ORDER BY ORDER_NUMBER";
				$result = mysqli_query($conn, $sql);
				$total = 0;
				if (mysqli_num_rows($result) > 0) {
				    // Output the amenities in a table row
				    while($row = mysqli_fetch_assoc($result)) {
				        echo "<tr>";
				        echo "<td>" . $row["FOOD_NAME"] . "</td>";
				        echo "<td>" . $row["COST"] . "</td>";
						echo "<td>" . $row["ORDER_NUMBER"] . "</td>";
						echo '<td>
								<form method="POST">
									<input type="hidden" name="LocationNumber" value="' . $row["LOCATION_NUMBER"] . '">
									<input type="hidden" name="itemNumber" value="' . $row["ITEM_NUMBER"] . '">
									<input type="hidden" name="itemName" value="' . $row["FOOD_NAME"] . '">
									<input type="hidden" name="orderNum" value="' . $row["ORDER_NUMBER"] . '">
              					    <button type="submit" name="removeFromOrder">Remove</button>
              					</form>
								</td>';
				    	echo "</tr>";
						$total += $row["COST"];
				  	}
					echo "<h2>Total: $$total</h2>";
				} else {
				    echo "0 results";
				}



				mysqli_close($conn);
				?>
			</tbody>
			</table>
		<h2>Hotel Amenities</h2>
		<table>
			<thead>
				<tr>
					<th>Item</th>
					<th>Availabile:</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php
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

				// Retrieve the amenities from the MySQL database
				$sql = "SELECT * FROM amenity";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
				    // Output the amenities in a table row
				    while($row = mysqli_fetch_assoc($result)) {
				        echo "<tr>";
				        echo "<td>" . $row["DESCRIPTION"] . "</td>";
						if ($row["AVAILABILITY"] == 1){
							echo "<td>Yes</td>";
						} else {
							echo "<td>No</td>";
						}
				    	echo "</tr>";
				  	}

				} else {
				    echo "0 results";
				}
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






