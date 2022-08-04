<?php
	include_once 'header.php';
?>
<?php
	if (!isset($_SESSION['u_id'])) {
		session_start();
		$_SESSION['message6'] = "You Have To Login First";
		header("location: index.php");
	}
?>
<style>
body {
background-image: url("backgroundforpages.jpg");
}
</style>
<section class="main-container">
	<div class="main-wrapper">
		<strong><h2>Deposit</h2></strong>
		<form class="deposit-form" action="includes/ticket.inc.php" method="POST">
			<strong><h3><?php echo $_SESSION['u_uid']; ?></strong></h3>	
			<input type="hidden" name="name" value="<?php echo $_SESSION['u_uid'] ?>" />			
			<input type="text" name="ammount" placeholder="amount">
			<input type="hidden" name="type" value="<?php echo Deposit ?>" />
			<button type="submit" name="submit">Deposit</button>
		</form>
		
		
		
	</div>

</section>

<?php
	include_once 'footer.php';
?>