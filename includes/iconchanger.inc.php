<?php
session_start();

if(isset($_POST['submit'])){
$conn = mysqli_connect("localhost","","","users");
$username = $_SESSION['u_uid'];

			if ($_POST['submit'] == 1) {
				$icon = "accounticons/icon1.jpg";
				$sql = "UPDATE users SET user_icon='$icon' WHERE user_uid='$username'";
				mysqli_query($conn, $sql);
				$_SESSION['message2'] = "Icon Changed!";
				header("Location: /account.php");
			}
			if ($_POST['submit'] == 2) {
				$icon = "accounticons/icon2.jpg";
				$sql2 = "UPDATE users SET user_icon='$icon' WHERE user_uid='$username'";
				mysqli_query($conn, $sql2);
				$_SESSION['message2'] = "Icon Changed!";
				header("Location: /account.php");
			}
			if ($_POST['submit'] == 3) {
				$icon = "accounticons/icon3.jpg";
				$sql3 = "UPDATE users SET user_icon='$icon' WHERE user_uid='$username'";
				mysqli_query($conn, $sql3);
				$_SESSION['message2'] = "Icon Changed!";
				header("Location: /account.php");
			}
			if ($_POST['submit'] == 4) {
				$icon = "accounticons/icon4.jpg";
				$sql4 = "UPDATE users SET user_icon='$icon' WHERE user_uid='$username'";
				mysqli_query($conn, $sql4);
				$_SESSION['message2'] = "Icon Changed!";
				header("Location: /account.php");
			}

}else {
	$_SESSION['message'] = "What Did You Do?";
	header("Location: /index.php");
	exit();
}

?>