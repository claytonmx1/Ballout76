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
img {
	width: 500px;
	height: 500px;
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
  <li><a class="active" href="#Poker" style="background-image:url(cardsforbg.png);background-size:cover;">♦Poker</a></li>
  <li><a href="gamescompleted.php">Games Completed</a></li>
  <li><a href="transfer.php">Send Caps</a></li>
</ul>
</div>

<strong><h4>Coming Soon!</h4></strong>
<img src="sneakpeek.png" alt="sneak peek" style="width:50%;">

</body>
</html>

<?php
	include_once 'footer.php';
?>