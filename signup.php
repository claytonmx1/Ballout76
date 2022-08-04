<?php
	include_once 'header.php';
?>


<section class="main-container">
	<div class="main-wrapper">
		<strong><h2>Signup</h2></strong>
		<form class="signup-form" action="includes/signup.inc.php" method="POST">
			<input type="text" name="first" placeholder="Firstname">
			<input type="text" name="last" placeholder="Lastname">
			<input type="text" name="email" placeholder="E-mail">
			<input type="text" name="uid" placeholder="Username">
			<input type="password" name="pwd" placeholder="Password">
			<input type="hidden" name="ballance" value="<?php echo $bal; ?>" />
			<input type="hidden" name="rank" value="<?php echo $rank; ?>" />
			<button type="submit" name="submit">Sign Up</button>
		</form>
		
	</div>

</section>

<?php
	include_once 'footer.php';
?>