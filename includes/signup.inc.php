<?php 

if(isset($_POST['submit'])){
	
	include_once 'dbh.inc.php';
	
	$rank = 1;
	$bal = 0;
	$total_gambled = 0;
	
	$first = mysqli_real_escape_string($conn, $_POST['first']);
	$last = mysqli_real_escape_string($conn, $_POST['last']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	//error handlers
	//check for empty fields
	if(empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)){
		
				echo '<script language="javascript" type="text/javascript"> 
                alert("One Or More Boxes Are Empty");
                window.location = "../signup.php";
				</script>';
	exit();
	}else{
		//check if their trying to flood our db with stuff
		if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
				echo '<script language="javascript" type="text/javascript"> 
                alert("Invalid Characters");
                window.location = "../signup.php";
				</script>';
	exit();
		}else{
			//check to make sure valid email
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo '<script language="javascript" type="text/javascript"> 
                alert("Invalid Email");
                window.location = "../signup.php";
				</script>';
					exit();
			}else{
				$sql = "SELECT * FROM users WHERE user_uid='$uid'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);
				
				if($resultCheck > 0) {
				echo '<script language="javascript" type="text/javascript"> 
                alert("Username Already Taken");
                window.location = "../signup.php";
				</script>';
						exit();
				} else {
					//Hash the password
					$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
					//Inserting the user into the database
					$icon = "accounticons/icon1.jpg";
					$sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd, user_bal, user_rank, user_icon, total_gambled) VALUES ('$first', '$last', '$email', '$uid', '$hashedPwd', '$bal', '$rank', '$icon', '$total_gambled');";
					mysqli_query($conn, $sql);
					echo '<script language="javascript" type="text/javascript"> 
                alert("Account Created, Welcome To Ballout76");
                window.location = "../index.php?signup=successful";
				</script>';
					exit();
				}
				
			}
		}
	}
	
	
	
} else {
	header("Location: ../signup.php");
	exit();
	}