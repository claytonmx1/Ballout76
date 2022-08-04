<?php
session_start();
//check if they are even staff
		if (!isset($_SESSION['u_id'])) {
		header("location: ../index.php");
	}else if (!($_SESSION['u_rank'] >= '2')){
		header("location: ../index.php");
	} else {

	if(isset($_POST['submit'])) {
	
	include('dbh.inc.php');

	$id = $_POST['id'];
	
	$result = mysqli_query($conn,"SELECT * FROM tickets WHERE user_id='$id' ");
	$resultCheck = mysqli_num_rows($result);
	$fetch1 = mysqli_fetch_assoc($result);
	$deposit_ammount = $fetch1['user_ammount'];
	$ticket_type = $fetch1['user_type'];
	$username = $fetch1['user_name'];
	
				if ($resultCheck < 1) {
				$_SESSION['message'] = "Deposit Ticket Not Found";
				header("Location: /staff.php");
				} else {
	
	if(!($ticket_type == Deposit)){
			$_SESSION['message'] = "Thats A Withdraw Ticket Not A Deposit Ticket";
			header("Location: /staff.php");
	
	} else {
	
	$result2 = mysqli_query($conn,"SELECT * FROM users WHERE user_uid='$username' ");
	$fetch2 = mysqli_fetch_assoc($result2);
	$current_balance = $fetch2['user_bal'];
	
	$newammount = $current_balance + $deposit_ammount;
	
	$sql2 = "UPDATE users SET user_bal='$newammount' WHERE user_uid='$username'";
		mysqli_query($conn, $sql2);
		
		$sql3 = "DELETE from tickets WHERE user_id='$id' ";
		mysqli_query($conn, $sql3);
		
			$_SESSION['message2'] = "Deposit Completed ID# - " . $id;
			header("Location: /staff.php");
	}
	
	}
	
	} else {
		header("location: ../index.php");
	}
	}
?>