<?php
	include_once 'header.php';
?>
<?php
	if (!isset($_SESSION['u_id'])) {
		session_start();
		$_SESSION['message6'] = "You Have To Login First";
		header("location:index.php");
	}
?>

<html>
<head>
<style>

body {
background-image: url("backgroundforpages.jpg");
}

.casinogames ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
	width: 100%;
	height: 50px;
    overflow: hidden;
    background-color: #1a1a1a;
}

h3 {
  font-size: 27px;
  color: #dbd64c;
  text-transform: uppercase;
  font-weight: 300;
  margin-bottom: 10px;
  margin-top: 20px;
  text-align: left;
  display:inline-block;
}
.casinogames li {
    float: left;
}

.casinogames li a {
    display: block;
    color: white;
	font-weight: bold;
    text-align: center;
    padding: 20px 16px;
    text-decoration: none;
}

.casinogames li a:hover:not(.active) {
    background-color: #000000;
}

.active {
    background-color: #c2ba24;
}

h4 {
  font-size: 27px;
  color: #dbd64c;
  text-transform: uppercase;
  font-weight: 300;
  margin-bottom: 10px;
  margin-top: 20px;
  float: right;
  display:inline-block;
}
			.mytickets table {
				border-collapse: collapse;
				width: 25%;
				color: #3dce6b;
				font-family: monospace;
				font-size: 21px;
				text-align: left;
				float: right;
				background: url("tablebg.jpg");
			}
			.mytickets th {
				padding: 15px 15px;
				text-align: left;
				font-weight: 500;
				font-size: 15px;
				color: #fff;
				background-color: #666666;
				text-transform: uppercase;
			}
			.mytickets td{
				padding: 15px;
				text-align: left;
				vertical-align:middle;
				font-weight: 300;
				font-size: 13px;
				color: #fff;
				border-bottom: solid 1.5px rgba(255,255,255,0.1);
}

h2 {
	font-family: overseerregular;
	font-size: 55px;
	color: #fcdd44;
	line-height: 58px;
	text-align: center;
}

div.duelstable {
width: 32%;
float: left;

}
.duel-accept {
	width: 250px;
	margin: 0 auto;
	padding-top: 30px;
}

.duel-accept img {
	float: left;
    margin: 0 auto;
	width:60px;
	height:57px;
	border:0;
}


.duel-accept input {
	width: 90%;
	height: 40px;
	padding: 0px 5%;
	margin-bottom: 4px;
	border: none;
	background-color: #ccc;
	font-family: overseerregular;
	font-size: 19px;
	color: #111;
	line-height: 40px;
}

.duel-accept button {
	display: block;
	margin: 0 auto;
	width: 180px;
	height: 40px;
	border: none;
	background-color: #1a1a1a;
	font-family: overseerregular;
	font-size: 18px;
	color: #fff;
	cursor: pointer;
}

.duel-accept button:hover {
	background-color: #111;
	
}

.load_duels {
display: inline-block;
width: 37%;
padding-left: 15%;
}

			.mytickets tr: nth-child(even) {background-color: #bab8b8}

.global_chat {
width: 20%;
float: left;
}
.global_chat input {
	height: 20px;
	border: none;
	background-color: #ccc;
	font-family: arial;
	font-size: 19px;
	color: #111;
	line-height: 40px;
}

.global_chat button {
	display: inline-block;
	width: 20%;
	height: 30px;
	border: none;
	background-color: #1a1a1a;
	font-family: Arial;
	font-weight: bold;
	font-size: 18px;
	color: #fff;
	cursor: pointer;
}

.global_chat button:hover {
	background-color: #111;
	
}


.global_chat form, p, span {
    margin:0;
    padding:0; }
  
.global_chat input { font:14px arial; }
  
.global_chat a {
    color:#0000FF;
    text-decoration:none; }
  
    a:hover { text-decoration:underline; }
  
.global_chat #wrapper, #loginform {
    margin:0 auto;
    padding-bottom:25px;
    background:#666666;
    width:504px;
}
  
.global_chat #loginform { padding-top:18px; }
  
    #loginform p { margin: 5px; }
  
.global_chat #chatbox {
    text-align:left;
    margin:0 auto;
    margin-bottom:14px;
    padding:17px;
    background: url("tablebg.jpg");
    height:270px;
    width:430px;
    overflow:auto; }
  
.global_chat #usermsg {
    width:350px;
	margin: 0 5%;
}
  
.global_chat #submit { width: 70px; }
  
.error { color: #ff0000; }
  
.global_chat #menu { padding:12.5px 25px 12.5px 25px; }
  
.welcome { text-align: center; color: #ed7; font-size: 20px;}
  
.msgln { margin:0 0 2px 0; color: white; font-family: verdana;}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#load_duels').load('updategames.php');
	
var auto_refresh = setInterval(
function ()
{
$('#load_duels').load('updategames.php');
}, 1500); // refresh every 1.5 Seconds
$.ajaxSetup({ cache: false });
});
</script>
</head>
<body>

<div class="casinogames">
<ul>
  <li><a class="active" href="#Dashboard">♦Dashboard</a></li>
  <li><a href="dice.php" style="background-image:url(diceforbg.png);background-size:cover;">Create Dice Duel</a></li>
  <li><a href="poker.php" style="background-image:url(cardsforbg.png);background-size:cover;">Poker</a></li>
  <li><a href="gamescompleted.php">Games Completed</a></li>
  <li><a href="transfer.php">Send Caps</a></li>
</ul>
</div>


	<div class="mytickets">
	<?php
	session_start();
	
			$conn = mysqli_connect("localhost","","","users");
			// Check connection
			if (mysqli_connect_errno())
			{
			echo "Failed to connect to Database" . mysqli_connect_error();
			}
			
			$user = $_SESSION['u_uid'];
			
			$result = mysqli_query($conn,"SELECT user_name, user_ammount, user_type, user_id FROM tickets WHERE user_name='$user'");

			echo "<table border='1' id='tableID'>
			<tr>
			<th colspan='4' style='text-align:center; color: #ed7; border-bottom: solid 1px rgba(255,255,255,0.2); font-size: 20px;'>♦My Open Tickets♦</th>
			</tr>
			<tr>
			<th>ID</th>
			<th>User</th>
			<th>Amount</th>
			<th>Type</th>
			</tr>";

			while($row = mysqli_fetch_array($result))
			{
			echo "<tr>";
			echo "<td>" . $row['user_id'] . "</td>";
			echo "<td>" . $row['user_name'] . "</td>";
			echo "<td>" . number_format($row['user_ammount']) . "</td>";
			echo "<td>" . $row['user_type'] . "</td>";
			echo "</tr>";
			
			}
			echo "</table>";

			mysqli_close($conn);
			?>	
	</div>
	<div class="load_duels" id="load_duels"> </div>
	
	<div class="global_chat">
	<div id="wrapper">
    <div id="menu">
        <p class="welcome">♦Global Chat♦</p>
        <div style="clear:both"></div>
    </div>
     
    <div id="chatbox">
	<?php
	if(file_exists("log.html") && filesize("log.html") > 0){
    $handle = fopen("log.html", "r");
    $contents = fread($handle, filesize("log.html"));
    fclose($handle);
     
    echo $contents;
}
?>
	</div>
     
    <form name="message" action="">
        <input name="usermsg" type="text" id="usermsg" size="63" />
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    </form>
</div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
// Chat
$(document).ready(function(){
 
});

//If user submits the form for chat.
	$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("post.php", {text: clientmsg});				
		$("#usermsg").attr("value", "");
		return false;
	});
	
	function loadLog(){		
		var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll
		$.ajax({
			url: "log.html",
			cache: false,
			success: function(html){		
				$("#chatbox").html(html); //Insert chat log into the #chatbox div	

				//Auto-scroll			
				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
				if(newscrollHeight > oldscrollHeight){
					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				}
		  	},
		});
	}
	setInterval (loadLog, 1500);
</script>
</body>
</html>

<?php
	include_once 'footer.php';
?>