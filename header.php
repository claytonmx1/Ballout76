<?php
session_start();

	//Warning error is message 1.
	if (isset($_SESSION['message'])) {
		$errormessage = $_SESSION['message'];	
		
    echo '<div id="note">
		  '. $errormessage .'
		  </div>';
	
    unset($_SESSION['message']);
}
	//good notifcation is green message 2.
	if (isset($_SESSION['message2'])) {
		$errormessage2 = $_SESSION['message2'];	
		
    echo '<div id="note2">
		  '. $errormessage2 .'
		  </div>';
	
    unset($_SESSION['message2']);
}
	//Lost notifcation is red message 3.
	if (isset($_SESSION['message3'])) {
		$errormessage3 = $_SESSION['message3'];	
		
    echo '<div id="note3">
		  '. $errormessage3 .'
		  </div>';
	
    unset($_SESSION['message3']);
}
//Handles our errors when were not logged in.
if (isset($_SESSION['message6'])) {
		$errormessage6 = $_SESSION['message6'];	
		
    echo '<div id="note">
		  '. $errormessage6 .'
		  </div>';
	
    unset($_SESSION['message6']);
}
?>
<!DOCTYPE html>
<html>
<head>
<script src="js/alertbox.js"></script>
<style>
#note {
    position: absolute;
    z-index: 101;
    top: 0;
    left: 0;
    right: 0;
	opacity: .5;
    background: #fde073;
    text-align: center;
	color: #000000;
	font-family: impact;
    line-height: 2.5;
    overflow: hidden; 
    -webkit-box-shadow: 0 0 5px black;
    -moz-box-shadow:    0 0 5px black;
    box-shadow:         0 0 5px black;
}
@-webkit-keyframes slideDown {
    0%, 100% { -webkit-transform: translateY(-50px); }
    10%, 90% { -webkit-transform: translateY(0px); }
}
@-moz-keyframes slideDown {
    0%, 100% { -moz-transform: translateY(-50px); }
    10%, 90% { -moz-transform: translateY(0px); }
}
.cssanimations.csstransforms #note {
    -webkit-transform: translateY(-50px);
    -webkit-animation: slideDown 5.5s 1.0s 1 ease forwards;
    -moz-transform:    translateY(-50px);
    -moz-animation:    slideDown 5.5s 1.0s 1 ease forwards;
}
#note2 {
    position: absolute;
    z-index: 101;
    top: 0;
    left: 0;
    right: 0;
	opacity: .5;
    background: #00b300;
    text-align: center;
	color: #000000;
	font-family: impact;
    line-height: 2.5;
    overflow: hidden; 
    -webkit-box-shadow: 0 0 5px black;
    -moz-box-shadow:    0 0 5px black;
    box-shadow:         0 0 5px black;
}.cssanimations.csstransforms #note2 {
    -webkit-transform: translateY(-50px);
    -webkit-animation: slideDown 5.5s 1.0s 1 ease forwards;
    -moz-transform:    translateY(-50px);
    -moz-animation:    slideDown 5.5s 1.0s 1 ease forwards;
}
#note3 {
    position: absolute;
    z-index: 101;
    top: 0;
    left: 0;
    right: 0;
	opacity: .5;
    background: #ff1a1a;
    text-align: center;
	color: #000000;
	font-family: impact;
    line-height: 2.5;
    overflow: hidden; 
    -webkit-box-shadow: 0 0 5px black;
    -moz-box-shadow:    0 0 5px black;
    box-shadow:         0 0 5px black;
}.cssanimations.csstransforms #note3 {
    -webkit-transform: translateY(-50px);
    -webkit-animation: slideDown 5.5s 1.0s 1 ease forwards;
    -moz-transform:    translateY(-50px);
    -moz-animation:    slideDown 5.5s 1.0s 1 ease forwards;
}
</style>
	<title>Ballout76: #1 Fallout Casino</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="shortcut icon" type="image/x-icon" href="ballout_tab_icon_cjN_icon.ico" />
</head>
<body>

<header>
			<a href="https://discord.gg/bNFh3jH" target="_blank">
			<img src="discord.png" alt="Discord" align="left" style="width:60px;height:57px;border:0;">
			</a>
	<nav>
		<div class="main-wrapper">
			<ul>
				<li><a href="index.php">Home</a></li>			
				<li><a href="dashboard.php">Casino</a></li>
				<li><a href="news.php">Info</a></li>
				<li><a href="deposit.php">Deposit</a></li>
				<li><a href="withdraw.php">Withdraw</a></li>
			</ul>
			<div class="nav-login">
			<?php
			if (isset($_SESSION['u_id'])) {
				echo '<form action="includes/logout.inc.php" method="POST">
			<button type="submit" name="submit">Logout</button>
			</form>';
						
			
			if($_SESSION['u_rank'] >= '2') {
				echo '<form action="staff.php" method="POST">
			<button type="submit" name="submit">Staff</button>
			</form>';
			}
			if($_SESSION['u_rank'] >= '3') {
				echo '<form action="admin.php" method="POST">
			<button type="submit" name="submit">Admin</button>
			</form>';
			}

			} else {
				echo '<form action="includes/login.inc.php" method="POST">
			<input type="text" name="uid" placeholder="Username"
			>
			<input type="password" name="pwd" placeholder="Password">
			<button type="submit" name="submit">Login</button>
			</form>
			<a href="signup.php">Register</a>';
			}
			?>
			</div>
			
			<div class="nav-balance">
			<?php
			//query the wallet everytime a user refreshes the page. so wallet balance is always curent
			if (isset($_SESSION['u_id'])) {
				$conn = mysqli_connect("localhost","claytonmx","Thelocker12!","users");
			// Check connection
			if (mysqli_connect_errno())
			{
			echo "Failed to connect to Database" . mysqli_connect_error();
			}
			$username = $_SESSION['u_uid'];
				$result = mysqli_query($conn,"SELECT user_id, user_first, user_last, user_email, user_uid, user_pwd, user_bal, user_rank, user_icon FROM users WHERE user_uid='$username'");
				if($row = mysqli_fetch_assoc($result)) {
					$wallet = number_format($row['user_bal']);
					$icon = $row['user_icon'];
					echo ("<a href='account.php' style='color: #20871f'><img src={$icon} alt='Profile'>{$_SESSION['u_uid']}</a> <img src='balloutbottle_cap.png' alt='Caps'> <strong>{$wallet}"."<br /></strong>");
				}
				
			}
			mysqli_close($conn);
			?>			
			</div>
			
		</div>
		<div class="main-info">
		
		</div>
	</nav>
</header>