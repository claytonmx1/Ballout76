<?php
	session_start();
	include_once 'header.php';
?>
<?php
	if (!isset($_SESSION['u_id'])) {
		$_SESSION['message6'] = "You Have To Login First";
		header("location: index.php");
	}
?>
<style>
body {
background-image: url("backgroundforpages.jpg");
}
.account {
	float: left;
	width: 30%;
	padding-left: 45px;
	padding-top: 15px;

}

.account h1 {
    font-size: 20pt;
    color: #e6e600;
    font-style: italic;
    font-weight: bold;
    font-variant: small-caps;
}
.account_info {
	font-size: 15pt;
    color: #cccccc;
	padding-top: 13px;
}
.account_info img {
	float: left;
	padding-right: 5px;
	vertical-align: center;
	width: 20px;
	height: 20px;
}
.account_info p {
	padding-bottom: 5px;
}
button {
	width: 23%;
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

			//Get All Info On The User Logged In.
			$username = $_SESSION['u_uid'];
			$result = mysqli_query($conn,"SELECT user_id, user_first, user_last, user_email, user_uid, user_pwd, user_bal, user_rank, total_gambled FROM users WHERE user_uid='$username'");
			$fetch = mysqli_fetch_assoc($result);
			$current_balance = number_format($fetch['user_bal']);
			$firstname = $fetch['user_first'];
			$lastname = $fetch['user_last'];
			$email = $fetch['user_email'];
			$total_gambled = number_format($fetch['total_gambled']);
?>
	<div class="account">
	<h1>Account Info</h1>
	<div class="account_info">
	<p>Account Username - <img src='icons/username_icon.png' alt='username_icon'><?php echo $username ?></p>
	<p>Account Balance - <img src='icons/balance_icon.png' alt='balance_icon'><?php echo $current_balance ?></p>
	<p>Account FirstName - <img src='icons/names_icon.png' alt='firstname_icon'><?php echo $firstname ?></p>
	<p>Account LastName - <img src='icons/names_icon.png' alt='lastname_icon'><?php echo $lastname ?></p>
	<p>Account Email - <img src='icons/email_icon.png' alt='email_icon'><?php echo $email ?></p>
		
	</div>	
	</div>
	
	<div class="account">
	<h1>Account Settings</h1>
	<div class="account_info">
	<p>Change Username - <img src='icons/settings_icon.png' alt='settings_icon'><button type='submit' name='gameid'>Coming Soon</button></p>
	<p>Change Password - <img src='icons/settings_icon.png' alt='settings_icon'><button type='submit' name='gameid'>Coming Soon</button></p>
	<p>Change Email - <img src='icons/settings_icon.png' alt='settings_icon'><button type='submit' name='gameid'>Coming Soon</button></p>
	<p>Change Icon - <img src='icons/settings_icon.png' alt='settings_icon'><a href="changeicon.php"><button type='submit' name='gameid'>Change Icon</button></a></p>
		
	</div>	
	</div>

	<div class="account">
	<h1>Total Amount Gambled</h1>
	<div class="account_info">
	<p>Total Amount Gambled -  <img src='icons/money_icon.png' alt='money_icon'><span style="color:#e6e600;"><?php echo $total_gambled ?></span></p>
		
	</div>	
	</div>

<?php
	include_once 'footer.php';
?>