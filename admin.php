<?php
	session_start();
	include_once 'header.php';
?>
<?php
	if (!isset($_SESSION['u_id'])) {
		$_SESSION['message6'] = "You Have To Login First";
		header("location: index.php");
	} else {
			if (!($_SESSION['u_rank'] >= '3')) {
		header("location: index.php");
	}
	}
?>
<style>
body {
background-image: url("backgroundforpages.jpg");
}
.select_user {
	float: left;
	width: 30%;
	padding-left: 45px;
	padding-top: 15px;
}
.select_user h1 {
    font-size: 20pt;
    color: #e6e600;
    font-weight: bold;
    font-variant: small-caps;
}
.select_user form {
	width: 100%;
	padding-top: 7px;
}
			table {
				border-collapse: collapse;
				width: 25%;
				color: #3dce6b;
				font-family: monospace;
				font-size: 21px;
				text-align: left;
				background: url("tablebg.jpg");
			}
			th {
				padding: 15px 15px;
				text-align: left;
				font-weight: 500;
				font-size: 15px;
				color: #fff;
				border: 2px solid #404040;
				background-color: #666666;
				text-transform: uppercase;
			}
			td{
				padding: 13px;
				text-align: left;
				vertical-align:middle;
				font-weight: 300;
				font-size: 13px;
				color: #fff;
				border-bottom: solid 1px rgba(255,255,255,0.1);
}
			tr: nth-child(even) {background-color: #bab8b8}

.edit_user {
	clear:both;
	float: left;
	width: 30%;
	padding-left: 45px;
	padding-top: 35px;
}
.edit_user h1 {
    font-size: 20pt;
    color: #e6e600;
    font-weight: bold;
    font-variant: small-caps;
}
.edit_user form {
	width: 100%;
	padding-top: 7px;
}
.edit_user input {
	display: block;
	width: 45%;
	height: 25px;
	margin-bottom: 4px;
	border: none;
	background-color: #ccc;
	font-family: arial;
	font-size: 19px;
	color: #111;
	line-height: 40px;
}

.edit_user button {
	width: 45%;
	height: 40px;
	border: none;
	background-color: #1a1a1a;
	font-family: Arial;
	font-weight: bold;
	font-size: 18px;
	color: #fff;
	cursor: pointer;
}

.edit_user button:hover {
	background-color: #111;
	
}
.edit_user p {
float: left;
}
.stockamount {
	display: inline-block;
	float: right;
	padding-right: 2%;
	padding-top: 15px;
}
.stockamount h1 {
    font-size: 20pt;
    color: #e6e600;
    font-weight: bold;
    font-variant: small-caps;
}
.stockamount p {
	padding-top: 15px;
	float: left;
    font-size: 15pt;
    color: #e6e600;
    font-weight: bold;
    font-variant: small-caps;
</style>
<?php
	$conn = mysqli_connect("localhost","","","users");
	//Query all user accounts in database
	$user_query = mysqli_query($conn,"SELECT * FROM users");
	
	//Gets Total Amount Of Bottlecaps On Site. To Figure Out What We Should Keep In Stock.
		$stock_amount = mysqli_query($conn,"SELECT * FROM users");
		while($row4 = mysqli_fetch_array($stock_amount)) {
		$get_amount = $row4['user_bal'];
		$total_stock += $get_amount;
		$formatted_stock = number_format($total_stock);
		}
		
		
	//Get all the info on the user we selected, had to do it right here too so the edit stuff worked.
	if (isset($_POST['user'])) {
	$user_id = $_POST['user'];
	$edit_info = mysqli_query($conn,"SELECT * FROM users WHERE user_id='$user_id'");
			$fetch3 = mysqli_fetch_assoc($edit_info);
			$edit_balance = $fetch3['user_bal'];
			$edit_username = $fetch3['user_uid'];
			$edit_firstname = $fetch3['user_first'];
			$edit_lastname = $fetch3['user_last'];
			$edit_email = $fetch3['user_email'];
			$edit_rank = $fetch3['user_rank'];
			$hidden_id = $fetch3['user_id'];
	}
	
?>
<div class="main-container">
	<h2>Admin Panel</h2>
</div>
<div class="select_user">
	<h1>Select User</h1>
	<form action="admin.php" method="POST">
	<select name="user">
	<option value="">User Menu</option>
	 <?php
       while($row = mysqli_fetch_array($user_query))
       {
         echo '<option value="'.$row['user_id'].'">'.$row['user_uid'].'</option>';
       }
    ?>
	</select>
	<input type="submit" value="Select User">
	</form>
</div>

<div class="edit_user">
	<h1>Edit Selected User Info</h1>
	<form action="includes/adminedit.inc.php" method="POST">
	<input type="hidden" name="userid" value="<?php echo $hidden_id?>"/>
	<input type="text" name="username" value="<?php echo $edit_username?>" placeholder="Username">
	<input type="text" name="balance" value="<?php echo $edit_balance?>" placeholder="Balance">
	<input type="text" name="rank" value="<?php echo $edit_rank?>" placeholder="Rank">
	<input type="text" name="firstname" value="<?php echo $edit_firstname?>" placeholder="FirstName">
	<input type="text" name="lastname" value="<?php echo $edit_lastname?>" placeholder="LastName">
	<input type="text" name="email" value="<?php echo $edit_email?>" placeholder="Email">
	<button type="submit" name="submit">Update Changes</button>
	</form>
</div>

<div class="stockamount">
	<h1>Amount To Keep In Stock</h1>
	<p>Total On Site -&nbsp;&nbsp;<?php echo $formatted_stock?></p>
</div>

<?php
		//Build our table and fills it with the user we selected.
		if (isset($_POST['user'])) {
		$user_id = $_POST['user'];
	$user_info = mysqli_query($conn,"SELECT * FROM users WHERE user_id='$user_id'");
				
			echo "<table border='1' id='tableID'>
			<tr>
			<th colspan='7' style='text-align:center; color: #ed7; border-bottom: solid 1px rgba(255,255,255,0.2); font-size: 20px;'>User Info</th>
			</tr>
			<tr>
			<th>Username</th>
			<th>Balance</th>
			<th>Rank</th>
			<th>FirstName</th>
			<th>LastName</th>
			<th>Email</th>
			<th>Total Gambled</th>
			</tr>";

			while($row2 = mysqli_fetch_array($user_info))
			{
			echo "<tr>";
			echo "<td>" . $row2['user_uid'] . "</td>";
			echo "<td>" . number_format($row2['user_bal']) . "</td>";
			echo "<td>" . $row2['user_rank'] . "</td>";
			echo "<td>" . $row2['user_first'] . "</td>";
			echo "<td>" . $row2['user_last'] . "</td>";
			echo "<td>" . $row2['user_email'] . "</td>";
			echo "<td>" . number_format($row2['total_gambled']) . "</td>";
			echo "</tr>";
			
			}
			echo "</table>";
	}
?>

<?php
	include_once 'footer.php';
?>