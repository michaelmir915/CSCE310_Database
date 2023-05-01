
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
					<th>Quantity</th>
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
				        echo "<td>" . $row["INGREDIENTS"] . "</td>";
				        echo "<td>$" . $row["COST"] . "</td>";
				        echo '<td><input type="number" value="0"></td>';
				        echo '<td><button>Add to cart</button></td>';
				        echo "</tr>";
				    }
				} else {
				    echo "0 results";
				}

				mysqli_close($conn);
			?>
			</tbody>
		</table>
		<h2>Amenities</h2>
		<table>
			<thead>
				<tr>
					<th>Item</th>
					<th>Availability</th>
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
				        echo "<td>" . $row["AVAILABILITY"] . "</td>";
				        // echo '<td><input type="number" value="0"></td>';
						echo "<td><button>Check Out</button></td>";
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
</html>
<?php
  // Close the database connection
  mysqli_close($conn);
?>






