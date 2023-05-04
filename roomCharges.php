
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
				        // echo '<td><input type="number" value="0"></td>';
				        // echo '<td><button>Add to cart</button></td>';
						echo '<td>
              					<form method="POST">
									<input type="hidden" name="LocationNumber" value="' . $row["LOCATION_NUMBER"] . '">
									<input type="hidden" name="itemNumber" value="' . $row["ITEM_NUMBER"] . '">
              					    <input type="hidden" name="itemName" value="' . $row["FOOD_NAME"] . '">
              					    <button type="submit" name="addToCart">Add to cart</button>
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
					// echo '<script>alert("' . $location_number . ' LOCATION NUMBER \n Order Number: '. $orderNum .'")</script>';
					//Insert order into food_list
					$sql = "INSERT INTO food_list (LOCATION_NUMBER, ORDER_NUMBER, ITEM_NUMBER, ROOM_NUMBER) VALUES ('$location_number', '$orderNum', '$itemNumber', '1')";
					// echo '<script>alert("' . $sql . '")</script>';
					// echo '<script>alert("HERE")</script>';
					$result = mysqli_query($conn, $sql);
					echo '<script>alert("' . $itemName . ' added to cart! \n Order Number: '. $orderNum .'")</script>';

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
				        // echo "<td>" . $row["AVAILABILITY"] . "</td>";
						if ($row["AVAILABILITY"] == 1){
							echo "<td>Yes</td>";
						} else {
							echo "<td>No</td>";
						}
						// echo "<td><button>Check Out</button></td>";
				    	echo "</tr>";
				  	}

				} else {
				    echo "0 results";
				}
				?>
			</tbody>
		</table>
		<button>View Cart</button>
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






