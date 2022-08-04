<?php
session_start();
	if (!($_SESSION['u_rank'] >= '2')){
		header("location: ../index.php");
	}
	if(isset($_POST['submit'])) {
		
// connect to the database
include('dbh.inc.php');

$id = $_POST['id'];

$sql7 = "SELECT * FROM tickets WHERE user_id='$id'";
			$result4 = mysqli_query($conn, $sql7);
			$resultCheck = mysqli_num_rows($result4);
				$fetch1 = mysqli_fetch_assoc($result4);
				$ticket_type = $fetch1['user_type'];
				
			if ($resultCheck < 1) {
				$_SESSION['message'] = "Withdraw Ticket Not Found";
				header("Location: /staff.php");
			}else {

			if(!($ticket_type == Withdraw)){
				$_SESSION['message'] = "Thats A Deposit Ticket Not A Withdraw Ticket";
				header("Location: /staff.php");
			
			}else{
			
	$query2 = "DELETE from tickets WHERE user_id='$id' ";
	$r = mysqli_query($conn, $query2);
	if($r) {
				$_SESSION['message2'] = "Withdraw Ticket Completed ID# - " . $id;
				header("Location: /staff.php");
	}
			}
	  }
	
	} else {
	header("Location: ../index.php");
	exit();
	}
?>