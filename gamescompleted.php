<?php
	include_once 'header.php';
?>
<?php
	if (!isset($_SESSION['u_id'])) {
		header("location:index.php");
	}
?>

<html>
<head>
<style>
body {
background-image: url("backgroundforpages.jpg");
}

.casinogames ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
	width: 100%;
	height: 50px;
    overflow: hidden;
    background-color: #1a1a1a;
}

.casinogames li {
    float: left;
}

.casinogames li a {
    display: block;
    color: white;
	font-weight: bold;
    text-align: center;
    padding: 20px 16px;
    text-decoration: none;
}

.casinogames li a:hover:not(.active) {
    background-color: #000000;
}

.active {
    background-color: #c2ba24;
}

h4 {
	text-align: center;
	border: none;
	font-family: overseerregular;
	font-size: 40px;
	color: #dbd64c;
	line-height: 58px;
	display:absolute;
}
			table {
				border-collapse: collapse;
				width: 25%;
				color: #3dce6b;
				font-family: monospace;
				font-size: 21px;
				text-align: left;
				margin: 0 auto;
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
				padding: 15px;
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
				width: 30%;
				height: 40px;
				border: none;
				background-color: #222;
				font-family: overseerregular;
				font-size: 18px;
				color: #fff;
				cursor: pointer;
			}
			
			.games_scroll {
			display: block;
			width: 100%;
			max-height: 400px;
			overflow: auto;
			margin-right: 14px;
			padding-right: 100px;
			padding-bottom: 30px;
			}
			.games_scroll_parent {
			overflow: hidden;
			}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>
</head>
<body>

<div class="casinogames">
<ul>
  <li><a href="dashboard.php">Dashboard</a></li>
  <li><a href="dice.php" style="background-image:url(diceforbg.png);background-size:cover;">Create Dice Duel</a></li>
  <li><a href="poker.php" style="background-image:url(cardsforbg.png);background-size:cover;">Poker</a></li>
  <li><a class="active" href="#history">♦Games Completed</a></li>
  <li><a href="transfer.php">Send Caps</a></li>
</ul>
</div>
<strong><h4>Find Your Previous Game By ID#</h4></strong>
<h4>*Scrolling Is Enabled*</h4>
<div class="games_scroll_parent">
<div class="games_scroll">
<?php
			$conn = mysqli_connect("localhost","","","users");
			// Check connection
			if (mysqli_connect_errno())
			{
			echo "Failed to connect to Database" . mysqli_connect_error();
			}
			
			$result = mysqli_query($conn,"SELECT game_id, oldgame_id, game_user, game_amount, game_type, game_against, dice_one, dice_two, game_winner, AmountWon FROM gamescompleted");
			
			echo "<table border='1' id='tableID'>
			<tr>
			<th>GameID</th>
			<th>User1</th>
			<th>User2</th>
			<th>BetAmount</th>
			<th>GameType</th>
			<th>Dice1</th>
			<th>Dice2</th>
			<th>Winner</th>
			<th>Pot</th>
			</tr>";

			while($row = mysqli_fetch_array($result))
			{
			echo "<tr>";
			echo "<td>" . $row['oldgame_id'] . "</td>";
			echo "<td>" . $row['game_user'] . "</td>";
			echo "<td>" . $row['game_against'] . "</td>";
			echo "<td>" . number_format($row['game_amount']) . "</td>";
			echo "<td>" . $row['game_type'] . "</td>";
			echo "<td>" . $row['dice_one'] . "</td>";
			echo "<td>" . $row['dice_two'] . "</td>";
			echo "<td>" . $row['game_winner'] . "</td>";
			echo "<td>" . number_format($row['AmountWon']) . "</td>";
			echo "</tr>";
			}
			echo "</table>";
			
			
			mysqli_close($conn);
			?>					
</div>
</div>
</body>
</html>

<?php
	include_once 'footer.php';
?>