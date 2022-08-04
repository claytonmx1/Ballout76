<?php 
session_start();

	if (!isset($_SESSION['u_id'])) {
				$_SESSION['message'] = "You Are Not Signed In";
				header("Location: /index.php");
	} else {

if(isset($_POST['submit'])){
	include 'dbh.inc.php';
	
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$balance = mysqli_real_escape_string($conn, $_POST['balance']);
	$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
	$rank = mysqli_real_escape_string($conn, $_POST['rank']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$userid = mysqli_real_escape_string($conn, $_POST['userid']);
	
	
				$sql2 = "UPDATE users SET user_uid='$username', user_bal='$balance', user_first='$firstname', user_last='$lastname', user_rank='$rank', user_email='$email' WHERE user_id='$userid'";
				mysqli_query($conn, $sql2);
				
				$_SESSION['message2'] = "User Info Updated!";
				header("Location: /admin.php");
	
} else {
				$_SESSION['message'] = "What Did You Do?";
				header("Location: /index.php");
	exit();
	}
	}
?>