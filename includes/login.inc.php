<?php
session_start();

if (isset($_POST['submit'])) {
		include 'dbh.inc.php';
		
		$uid = mysqli_real_escape_string($conn, $_POST['uid']);
		$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
		
		//error handlers
		//check if inputs empty
		if(empty($uid) || empty($pwd)){
			
					header("Location: ../index.php?login=empty");
					exit();
			
		} else {
			$sql = "SELECT * FROM users WHERE user_uid='$uid'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			
			if ($resultCheck < 1) {
				  echo '<script language="javascript" type="text/javascript"> 
                alert("User Doesnt Exist");
                window.location = "../index.php";
				</script>';
					exit();
			} else {
				if($row = mysqli_fetch_assoc($result)) {
					//Unhashing
					$hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
					if($hashedPwdCheck == false) {
							echo '<script language="javascript" type="text/javascript"> 
							alert("Wrong Password");
							window.location = "../index.php";
							</script>';
					exit();
							exit();
					}elseif ($hashedPwdCheck == true) {
						//logging in
						$_SESSION['u_id'] = $row['user_id'];
						$_SESSION['u_first'] = $row['user_first'];
						$_SESSION['u_last'] = $row['user_last'];
						$_SESSION['u_email'] = $row['user_email'];
						$_SESSION['u_uid'] = $row['user_uid'];
						$_SESSION['u_bal'] = $row['user_bal'];
						$_SESSION['u_rank'] = $row['user_rank'];
						
							header("Location: ../index.php?login=success");
							exit();
					}
					
				}
			}
		}
	
	
} else {
	header("Location: ../index.php?login=error");
	exit();
}