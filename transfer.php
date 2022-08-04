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

img {
	width: 100px;
	height: 100px;
    display: block;
    margin-left: auto;
    margin-right: auto;
}
</style>
</head>
<body>

<div class="casinogames">
<ul>
  <li><a href="dashboard.php">Dashboard</a></li>
  <li><a href="dice.php" style="background-image:url(diceforbg.png);background-size:cover;">Create Dice Duel</a></li>
  <li><a href="poker.php" style="background-image:url(cardsforbg.png);background-size:cover;">Poker</a></li>
  <li><a href="gamescompleted.php">Games Completed</a></li>
  <li><a class="active" href="#transfer">♦Send Caps</a></li>
</ul>
</div>


<section class="main-container">
	<div class="main-wrapper">
		<strong><h2>Send Caps</h2></strong>
		<img src="balloutbottle_cap.png" alt="sneak peek">
		<form class="deposit-form" action="includes/sendcaps.inc.php" method="POST">
			<input type="hidden" name="name" value="<?php echo $_SESSION['u_uid'] ?>" />			
			<input type="text" name="playersname" placeholder="Players Name">
			<input type="text" name="amount" placeholder="Amount">
			<button type="submit" name="submit">Send Caps</button>
		</form>
		
		
		
	</div>

</section>


</body>
</html>

<?php
	include_once 'footer.php';
?>