<?php
	session_start();
?>
<?php
	if (!isset($_SESSION['u_id'])) {
		header("location:index.php");
	}
	
	if(isset($_SESSION['u_uid'])){
    $text = $_POST['text'];
     
	 if($text != "") {
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'><b>".$_SESSION['u_uid']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);
	 }
}
	
?>
