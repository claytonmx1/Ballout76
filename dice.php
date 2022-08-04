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

.diceduelform {
	width: 400px;
	margin: 0 auto;
	padding-top: 30px;
}

.diceduelform input {
	width: 90%;
	height: 40px;
	padding: 0px 5%;
	margin-bottom: 4px;
	border: none;
	background-color: #ccc;
	font-family: overseerregular;
	font-size: 16px;
	color: #111;
	line-height: 40px;
}

.diceduelform button {
	display: block;
	margin: 0 auto;
	width: 30%;
	height: 40px;
	border: none;
	background-color: #1a1a1a;
	font-family: overseerregular;
	font-size: 18px;
	color: #fff;
	cursor: pointer;
}

.diceduelform button:hover {
	background-color: #111;
	
}
</style>
</head>
<body>

<div class="casinogames">
<ul>
  <li><a href="dashboard.php">Dashboard</a></li>
  <li><a class="active" href="#DiceDuels" style="background-image:url(diceforbg.png);background-size:cover;">♦Create Dice Duel</a></li>
  <li><a href="poker.php" style="background-image:url(cardsforbg.png);background-size:cover;">Poker</a></li>
  <li><a href="gamescompleted.php">Games Completed</a></li>
  <li><a href="transfer.php">Send Caps</a></li>
</ul>
</div>

	<section class="main-container">
	<div class="main-wrapper">
	<img src="dice.png" alt="DicePic" style="width:150px;height:150px;display:block;margin-left:auto;margin-right:auto;">
	<div class="diceimg">
		<strong><h4>Dice Duel</h4></strong>
		</div>
		<form class="diceduelform" action="includes/diceduel.inc.php" method="POST">
			<input type="text" name="diceamount" placeholder="Amount">
			<input type="hidden" name="username" value="<?php echo $_SESSION['u_uid'] ?>" />
			<button type="submit" name="submit">Create Duel</button>
		</form>
		
	</div>

</section>

</body>
</html>

<?php
	include_once 'footer.php';
?>