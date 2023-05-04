<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create a new booking!</title>
	<link rel="stylesheet" href="newBookings.css">
    <link href="./newBookings.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script>
	$(function() {
		var checkin = $('#checkin_datepicker');
		var checkout = $('#checkout_datepicker');
		var startDate = new Date();
		var endDate = new Date();

		checkin.datepicker({
			dateFormat: 'yy-mm-dd',
			startDate: startDate,
			onSelect: function(date) {
				// Set the minimum date for the checkout datepicker
				startDate = new Date(date);
				endDate.setDate(startDate.getDate() + 1);
				checkout.datepicker('option', 'endDate', endDate);

				// Close the check-in datepicker
				checkin.datepicker('hide');
			}
		});

		checkout.datepicker({
			dateFormat: 'yy-mm-dd',
			endDate: endDate
		});
	});
	</script>

	<style>
		.ui-datepicker-calendar {
			font-size: 12px;
		}
	</style>
</head>

<body>
	<header>
		<nav>
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">Hotels</a></li>
				<li><a href="#">Contact Us</a></li>
				<li><a href="#">Login</a></li>
			</ul>
		</nav>
	</header>

	<main>
		<section class="booking">
			<h2>Book Your Stay</h2>
			<form action="searchResults.php" method="post">
				<label for="checkin">Check-In Date (YYYY-MM-DD):</label>
				<input type="text" id="checkin_datepicker" name="checkin">
				 
				<label for="checkout">Check-Out Date (YYYY-MM-DD):</label>
				<input type="text" id="checkout_datepicker" name="checkout">
				 
				<button type="submit" class="btn">Book Now</button>
			</form>
		</section>
	</main>

	<footer>
		<p>&copy; 2023 Spynx Inc. All rights reserved. For Copyright concerns, please contact CEO Christopher Lanclos.</p>
	</footer>
</body>
</html>