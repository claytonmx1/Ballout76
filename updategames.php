<?php
	session_start();
?>
<?php
	if (!isset($_SESSION['u_id'])) {
		header("location:index.php");
	}
?>

<html>
<head>
<style>

			table {
				border-collapse: collapse;
				width: 25%;
				color: #3dce6b;
				font-family: monospace;
				font-size: 21px;
				text-align: left;
				background: url("tablebg.jpg");
			}
			th {
				padding: 15px 15px;
				text-align: left;
				font-weight: 500;
				font-size: 15px;
				color: #fff;
				border: 2px solid #404040;
				background-color: #666666;
				text-transform: uppercase;
			}
			td{
				padding: 13px;
				text-align: left;
				vertical-align:middle;
				font-weight: 300;
				font-size: 13px;
				color: #fff;
				border-bottom: solid 1.5px rgba(255,255,255,0.1);
}
			tr: nth-child(even) {background-color: #bab8b8}
			
			button {
				display: block;
				margin: 0 auto;
				width: 100%;
				height: 20px;
				border: none;
				background-color: #222;
				font-family: overseerregular;
				font-size: 18px;
				color: #fff;
				cursor: pointer;
			}
		
</style>
</head>
<body>
<?php
			$conn = mysqli_connect("localhost","","","users");
			// Check connection
			if (mysqli_connect_errno())
			{
			echo "Failed to connect to Database" . mysqli_connect_error();
			}
			
			$result = mysqli_query($conn,"SELECT game_id, game_user, game_amount, game_type, game_time, game_against FROM games");
			
			echo "<table border='1' id='tableID'>
			<tr>
			<th colspan='7' style='text-align:center; color: #ed7; border-bottom: solid 1px rgba(255,255,255,0.2); font-size: 20px;'>♦Games Ready To Join♦</th>
			</tr>
			<tr>
			<th>GameID</th>
			<th>Game</th>
			<th>User</th>
			<th>Bet</th>
			<th>Win</th>
			<th>Players</th>
			<th>Join</th>
			</tr>";

			while($row = mysqli_fetch_array($result))
			{
			$winamount = $row['game_amount'] * 2;
			$playercount = "1/2";
			echo "<tr>";
			echo "<td>" . $row['game_id'] . "</td>";
			echo "<td>" . $row['game_type'] . "</td>";
			echo "<td>" . $row['game_user'] . "</td>";
			echo "<td>" . number_format($row['game_amount']) . "</td>";
			echo "<td>" . number_format($winamount) . "</td>";
			echo "<td>" . $playercount . "</td>";
			echo "<td><form action='includes/rolldice.inc.php' method='POST'><button type='submit' name='gameid' value='". $row['game_id'] ."'>Join</button></form></td>";
			echo "</tr>";
			}
			echo "</table>";
			
			
			mysqli_close($conn);
			?>					

</body>
</html>