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
	padding-left: 35%;
	padding-top: 15px;

}

.account h1 {
	text-align:center;
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
	padding-left: 23%;
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
.icon1 button{
	background-size: 100%;
	background-image: url(accounticons/icon1.jpg);
	background-repeat: no-repeat;
	width: 70px;
	height: 41px;
	border: none;
	font-family: overseerregular;
	font-size: 18px;
	cursor: pointer;
}
.icon2 button{
	background-size: 100%;
	background-image: url(accounticons/icon2.jpg);
	background-repeat: no-repeat;
	width: 70px;
	height: 41px;
	border: none;
	font-family: overseerregular;
	font-size: 18px;
	cursor: pointer;
}
.icon3 button{
	background-size: 100%;
	background-image: url(accounticons/icon3.jpg);
	background-repeat: no-repeat;
	width: 70px;
	height: 41px;
	border: none;
	font-family: overseerregular;
	font-size: 18px;
	cursor: pointer;
}
.icon4 button{
	background-size: 100%;
	background-image: url(accounticons/icon4.jpg);
	background-repeat: no-repeat;
	width: 70px;
	height: 41px;
	border: none;
	font-family: overseerregular;
	font-size: 18px;
	cursor: pointer;
}
</style>
<?php
$conn = mysqli_connect("localhost","","","users");

			//Get All Info On The User Logged In.
			$username = $_SESSION['u_uid'];
			$result = mysqli_query($conn,"SELECT user_id, user_first, user_last, user_email, user_uid, user_pwd, user_bal, user_rank FROM users WHERE user_uid='$username'");
			$fetch = mysqli_fetch_assoc($result);
			$current_balance = number_format($fetch['user_bal']);
			$firstname = $fetch['user_first'];
			$lastname = $fetch['user_last'];
			$email = $fetch['user_email'];
			
?>
	<div class="account">
	<h1>Select Icon</h1>
	<div class="account_info">
	<form action="includes/iconchanger.inc.php" method="POST">
	<span class="icon1">
	<button id="icon1" name='submit' value='1'></button>
	</span>
	<span class="icon2">
	<button id="icon2" name='submit' value='2'></button>
	</span>
	<span class="icon3">
	<button id="icon3" name='submit' value='3'></button>
	</span>
	<span class="icon4">
	<button id="icon4" name='submit' value='4'></button>
	</span>
	</form>
	</div>	
	</div>
	

<?php
	include_once 'footer.php';
?>