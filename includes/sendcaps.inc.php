<?php 
session_start();

	if (!isset($_SESSION['u_id'])) {
				$_SESSION['message'] = "You Are Not Signed In";
				header("Location: /index.php");
	} else {

if(isset($_POST['submit'])){
	include 'dbh.inc.php';
	
	$username = mysqli_real_escape_string($conn, $_POST['name']);
	$playersname = mysqli_real_escape_string($conn, $_POST['playersname']);
	$amount = mysqli_real_escape_string($conn, $_POST['amount']);
	//error handlers
	//check for empty fields
		$sql2 = "SELECT * FROM users WHERE user_uid='$playersname'";
			$result3 = mysqli_query($conn, $sql2);
			$resultCheck = mysqli_num_rows($result3);
			
			if ($resultCheck < 1) {
				 $_SESSION['message'] = "User Does Not Exist";
				header("Location: /transfer.php");
					exit();
			} else {
	
	if(empty($amount) || empty($playersname)){
		
				$_SESSION['message'] = "One Or More Boxes Are Empty";
				header("Location: /transfer.php");
					exit();
	exit();
	}else{
		//check if they're trying to flood our db with stuff
		if (!preg_match("/^[0-9]*$/", $amount)) {
				$_SESSION['message'] = "Only Numbers Please!";
				header("Location: /transfer.php");
					exit();
		}else{
					
					
			//Finding out what their balance is before we let them join the game.
			$result = mysqli_query($conn,"SELECT user_id, user_first, user_last, user_email, user_uid, user_pwd, user_bal, user_rank FROM users WHERE user_uid='$username'");
			$fetch = mysqli_fetch_assoc($result);
			$current_balance = $fetch['user_bal'];
					
			if(!($amount > $current_balance)) {
			
			if(!($username == $playersname)) {
			
			$result2 = mysqli_query($conn,"SELECT user_id, user_first, user_last, user_email, user_uid, user_pwd, user_bal, user_rank FROM users WHERE user_uid='$playersname'");
			$fetch2 = mysqli_fetch_assoc($result2);
			$playersbalance = $fetch2['user_bal'];
			
			$newbalance = $current_balance - $amount;
			$players_newbalance = $playersbalance + $amount;
				//Subtracts the amount their sending fom their balance
				$sql8 = "UPDATE users SET user_bal='$newbalance' WHERE user_uid='$username'";
				mysqli_query($conn, $sql8);
				
				//Adds sending amount to the recieving players balance
				$sql5 = "UPDATE users SET user_bal='$players_newbalance' WHERE user_uid='$playersname'";
				mysqli_query($conn, $sql5);
			
				$_SESSION['message2'] = "BottleCaps Have Been Sent To - " . $playersname;
				header("Location: /dashboard.php");
				exit();
			} else {
				$_SESSION['message'] = "You Cant Send BottleCaps To Yourself Silly Goose";
				header("Location: /transfer.php");
				exit();
			}
				
			}else{
			$_SESSION['message'] = "You Dont Have That Many BottleCaps To Send!";
				header("Location: /transfer.php");
					exit();
			}
				
				
					
		}
	}
}
	
	
} else {
				$_SESSION['message'] = "What Did You Do?";
				header("Location: /transfer.php");
	exit();
	}
	}
?>