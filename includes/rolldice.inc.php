<?php 
session_start();
	if (!isset($_SESSION['u_id'])) {
		$_SESSION['message'] = "Signin Cant Be Detected. Let Admin Know";
		header("location:/index.php");
	}
if(isset($_POST['gameid'])){
	
	include_once 'dbh.inc.php';
	
	$username = $_SESSION['u_uid'];
	$gameid = $_POST['gameid'];
	
	//Dice Variables Needed For Database
	$dice1 = rand(1,12);
	$dice2 = rand(1,12);
	
	if($dice1 == $dice2) {
	$dice1 = rand(1,12);
	$dice2 = rand(1,12);
	}
	//error handlers
	//check for empty fields
	$sql7 = "SELECT * FROM games WHERE game_id='$gameid'";
			$result4 = mysqli_query($conn, $sql7);
			$resultCheck = mysqli_num_rows($result4);
			
			if ($resultCheck < 1) {
				$_SESSION['message'] = "Game Doesnt Exist";
				header("Location: /dashboard.php");
					exit();
			} else {
	
	if(empty($gameid)){
				$_SESSION['message'] = "Game ID Cant Be Empty";
				header("Location: /dashboard.php");
					exit();
	}else{
		//check if their trying to flood our db with stuff
		if (!preg_match("/^[0-9]*$/", $gameid)) {
				$_SESSION['message'] = "Game ID Number Only Please";
				header("Location: /dashboard.php");
					exit();
		}else{
			//Finding out what their balance is before we let them join the game.
	$result = mysqli_query($conn,"SELECT user_id, user_first, user_last, user_email, user_uid, user_pwd, user_bal, user_rank, total_gambled FROM users WHERE user_uid='$username'");
			$fetch = mysqli_fetch_assoc($result);
			$current_balance = $fetch['user_bal'];
			$user_gambled = $fetch3['total_gambled'];
			
			//Finding info about the game they are trying to join by id# they typed in.
	$result2 = mysqli_query($conn,"SELECT game_id, game_user, game_amount, game_type, game_against, game_time, dice_one, dice_two FROM games WHERE game_id='$gameid'");		
			$fetch2 = mysqli_fetch_assoc($result2);
			$owner = $fetch2['game_user'];
			$betamount = $fetch2['game_amount'];
			$oldgameid = $fetch2['game_id'];
			$gametype = $fetch2['game_type'];
			
			//Figure out what person who made the bets balance is first.
			$result3 = mysqli_query($conn,"SELECT user_id, user_first, user_last, user_email, user_uid, user_pwd, user_bal, user_rank, total_gambled FROM users WHERE user_uid='$owner'");
			$fetch3 = mysqli_fetch_assoc($result3);
			$owner_balance = $fetch3['user_bal'];
			$owner_gambled = $fetch3['total_gambled'];
			
			//determines how much to give whoever won
			$pot = $betamount * 2;
			$winner1 = $pot + $owner_balance;
			$winner2 = $pot + $current_balance;
			
			if(!($betamount > $current_balance)) {
				
				if(!($username == $owner)) {
				//Subtracts Amount They Just Of The Bet They Called From Their Balance.
				$newbalanceamount = $current_balance - $betamount;
				$owner_totalgambled = $betamount + $owner_gambled;
				$user_totalgambled = $betamount + $user_gambled;
				
				$sql8 = "UPDATE users SET user_bal='$newbalanceamount' WHERE user_uid='$username'";
				mysqli_query($conn, $sql8);
				
				$sql2 = "INSERT INTO gamescompleted (oldgame_id, game_user, game_amount, game_type, game_against, dice_one, dice_two) VALUES ('$oldgameid', '$owner', '$betamount', '$gametype', '$username', '$dice1', '$dice2');";
				mysqli_query($conn, $sql2);
				
				//Storing Their Total Amount Gambled On The Site, Were Just Adding This To The Amount They Already Have.
				$sql12 = "UPDATE users SET total_gambled='$user_totalgambled' WHERE user_uid='$username'";
				mysqli_query($conn, $sql12);
				$sql13 = "UPDATE users SET total_gambled='$owner_totalgambled' WHERE user_uid='$owner'";
				mysqli_query($conn, $sql13);
				
				
				
				if($dice1 > $dice2){			
			
				$sql3 = "UPDATE users SET user_bal='$winner1' WHERE user_uid='$owner'";
				mysqli_query($conn, $sql3);
			
						$setgamewinner = "UPDATE gamescompleted SET game_winner='$owner' WHERE oldgame_id='$gameid'";
						mysqli_query($conn, $setgamewinner);
						
						$amountwon = "UPDATE gamescompleted SET AmountWon='$pot' WHERE oldgame_id='$gameid'";
						mysqli_query($conn, $amountwon);
			
								$sql5 = "DELETE from games WHERE game_id='$gameid' ";
								mysqli_query($conn, $sql5);
			
						$_SESSION['message3'] = "View Games Completed Tab, Lost - " . $betamount;
						header("Location: /dashboard.php");
						exit();
			
				} else {
				
					$sql4 = "UPDATE users SET user_bal='$winner2' WHERE user_uid='$username'";
				mysqli_query($conn, $sql4);
				
						$setgamewinner2 = "UPDATE gamescompleted SET game_winner='$username' WHERE oldgame_id='$gameid'";
						mysqli_query($conn, $setgamewinner2);
							
						$amountwon = "UPDATE gamescompleted SET AmountWon='$pot' WHERE oldgame_id='$gameid'";
						mysqli_query($conn, $amountwon);
							
								$sql6 = "DELETE from games WHERE game_id='$gameid' ";
								mysqli_query($conn, $sql6);
				
						$_SESSION['message2'] = "View Games Completed Tab, Won - " . $pot;
						header("Location: /dashboard.php");
						exit();
				
				}

				}else {
						$_SESSION['message'] = "You Cant Call Your Own Bet";
						header("Location: /dashboard.php");
						exit();
				}					
			} else {
						$_SESSION['message'] = "This Bet Is More Than Your Balance";
						header("Location: /dashboard.php");
						exit();
			}
		
		
		}
	}
}
	
	
} else {
	header("Location: ../dashboard.php");
	exit();
	}