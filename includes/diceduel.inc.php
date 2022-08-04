<?php 
session_start();

if(isset($_POST['submit'])){
	
	include_once 'dbh.inc.php';
	
	$betamount = mysqli_real_escape_string($conn, $_POST['diceamount']);
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	
	//Dice Variables Needed For Database
	$type = "DiceDuel";
	$against = "Waiting...";
	$time = date("Y-m-d h:i:s");
	$dice1 = 0;
	$dice2 = 0;
	
	//error handlers
	//check for empty fields
	if(empty($betamount)){
		
				$_SESSION['message'] = "Bet Amount Cant Be Empty";
				header("Location: /dice.php");
					exit();
	}else{
		//check if their trying to flood our db stuff
		if (!preg_match("/^[0-9]*$/", $betamount)) {
				$_SESSION['message'] = "Only Numbers Please";
				header("Location: /dice.php");
					exit();
		}else{
			//Checks to see if they have 3 games already created. Since we dont want them making more than 3 games.
			$gamecheck = mysqli_query($conn,"SELECT game_id, game_user, game_amount, game_type, game_time, game_against FROM games WHERE game_user='$username'");
			$gamecheckresults = mysqli_num_rows($gamecheck);
			if($gamecheckresults >= 3) {
				$_SESSION['message'] = "You Can Only Have 3 Games Created At A Time";
				header("Location: /dashboard.php");
			
			}else{
			
	$result = mysqli_query($conn,"SELECT user_id, user_first, user_last, user_email, user_uid, user_pwd, user_bal, user_rank FROM users WHERE user_uid='$username'");
			$fetch = mysqli_fetch_assoc($result);
			$current_balance = $fetch['user_bal'];
			$updated_balance = $current_balance - $betamount;
			
			if(!($betamount > $current_balance)) {
				$sql2 = "UPDATE users SET user_bal='$updated_balance' WHERE user_uid='$username'";
				mysqli_query($conn, $sql2);
				
				$sql = "INSERT INTO games (game_user, game_amount, game_type, game_against, game_time, dice_one, dice_two) VALUES ('$username', '$betamount', '$type', '$against', '$time', '$dice1', '$dice2');";
							mysqli_query($conn, $sql);
				$_SESSION['message2'] = "DiceDuel Created!";
				header("Location: /dashboard.php");
					exit();
				
			} else {
				$_SESSION['message'] = "You Cant Bet More Than Your Balance";
				header("Location: /dice.php");
					exit();
			}
		
			}
		}
	}
	
	
	
} else {
	header("Location: ../dashboard.php");
	exit();
	}