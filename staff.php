<?php
	include_once 'header.php';
	
		if (!isset($_SESSION['u_id'])) {
		header("location: index.php?staff=yournotloggedin");
	}else{
		if (!($_SESSION['u_rank'] >= '2')) {
		header("location: index.php");
	}
	}
?>

<section class="main-container">
	<div class="main-wrapper">
		<h2>Current Tickets</h2>
		
		<style type="text/css">

			body {
			background-image: url("backgroundforpages.jpg");
			}

		
			table {
				border-collapse: collapse;
				width: 100%;
				color: #3dce6b;
				font-family: monospace;
				font-size: 21px;
				text-align: left;
				background-color: #40423e;
			}
			th {
				background-color: #000000;
				color: white;
			}
			tr: nth-child(even) {background-color: #bab8b8}
			
			button {
				display: block;
				margin: 0 auto;
				width: 30%;
				height: 40px;
				border: none;
				background-color: #222;
				font-family: overseerregular;
				font-size: 18px;
				color: #fff;
				cursor: pointer;
			}
		</style>
		
			<?php
			$conn = mysqli_connect("localhost","","","users");
			// Check connection
			if (mysqli_connect_errno())
			{
			echo "Failed to connect to Database" . mysqli_connect_error();
			}
			
			$result = mysqli_query($conn,"SELECT user_name, user_ammount, user_type, user_id FROM tickets");

			echo "<table border='1'>
			<tr>
			<th>ID</th>
			<th>User</th>
			<th>Ammount</th>
			<th>Type</th>
			</tr>";

			while($row = mysqli_fetch_array($result))
			{
			echo "<tr>";
			echo "<td>" . $row['user_id'] . "</td>";
			echo "<td>" . $row['user_name'] . "</td>";
			echo "<td>" . number_format($row['user_ammount']) . "</td>";
			echo "<td>" . $row['user_type'] . "</td>";
			echo "</tr>";			
			}
			echo "</table>";

			mysqli_close($conn);
			?>					
			
			<form class="signup-form" action="includes/delete.inc.php" method="POST">
			<input type="text" name="id" placeholder="Withdraw Ticket ID Number">
			<button type="submit" name="submit">Complete Withdraw</button>
		</form>
					<form class="signup-form" action="includes/givewallet.inc.php" method="POST">
			<input type="text" name="id" placeholder="Deposit Ticket ID Number">
			<button type="submit" name="submit">Complete Deposit</button>
		</form>
			
	</div>

</section>

<?php
	include_once 'footer.php';
?>