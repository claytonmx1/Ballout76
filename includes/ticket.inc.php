<?php 
session_start();

	if (!isset($_SESSION['u_id'])) {
		header("location: ../index.php?ticket=usernotsignedin");
	} else {

if(isset($_POST['submit'])){
	include 'dbh.inc.php';
	
	$username = mysqli_real_escape_string($conn, $_POST['name']);
	$ammount = mysqli_real_escape_string($conn, $_POST['ammount']);
	$type = mysqli_real_escape_string($conn, $_POST['type']);
	//error handlers
	//check for empty fields
	if(empty($ammount) || empty($type)){
		
		if($type == Withdraw) {
				$_SESSION['message'] = "Ticket Cant Be Empty";
				header("Location: /withdraw.php");
		
				exit();
			}elseif ($type == Deposit) {
				$_SESSION['message'] = "Ticket Cant Be Empty";
				header("Location: /deposit.php");
				exit();
			}
	}else{
		//check if they're trying to flood our db with stuff
		if (!preg_match("/^[0-9]*$/", $ammount)) {
			
			if($type == Withdraw){
				$_SESSION['message'] = "Invalid Amount";
				header("Location: /withdraw.php");
				exit();
			}elseif ($type == Deposit){
				$_SESSION['message'] = "Invalid Amount";
				header("Location: /deposit.php");
				exit();
			}
		}else{				
					//Hash the password For User Safety
					$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
					//Inserting the user into the database
					
					if($type == Withdraw ) {
							$result = mysqli_query($conn,"SELECT user_id, user_first, user_last, user_email, user_uid, user_pwd, user_bal, user_rank FROM users WHERE user_uid='$username'");
							while($row = mysqli_fetch_array($result)) {
							$wallet = $row['user_bal'];
							if (!($ammount > $wallet)) {
								
							$newwallet = $wallet - $ammount;
							$sql2 = "UPDATE users SET user_bal='$newwallet' WHERE user_uid='$username'";
							mysqli_query($conn, $sql2);
							
							$sql = "INSERT INTO tickets (user_name, user_ammount, user_type) VALUES ('$username', '$ammount', '$type');";
							mysqli_query($conn, $sql);
							$_SESSION['message2'] = "Withdraw Ticket Sent To Staff!";
							header("Location: /dashboard.php");
							exit();
							} else {
							$_SESSION['message'] = "You Cant Withdraw More Than What You Have";
							header("Location: /withdraw.php");
							exit();
							}
							}
							
					}else if($type == Deposit ) {
					
					$sql = "INSERT INTO tickets (user_name, user_ammount, user_type) VALUES ('$username', '$ammount', '$type');";
					mysqli_query($conn, $sql);
						$_SESSION['message2'] = "Deposit Ticket Sent To Staff!";
						header("Location: /dashboard.php");
					exit();
						exit();		
					}						
		}
	}
	
	
	
} else {
	header("Location: ../index.php");
	exit();
	}
	}
?>