<?php
include("config.php");
session_start();
$mess="";
if(isset($_SESSION['uid']) && isset($_SESSION['upass']))
{
	header("location:dashboard.php");
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	if(isset($_POST['username']) && isset($_POST['pass']))
	{
		$pass=md5(mysqli_real_escape_string($db,$_POST['pass']));
		$username=mysqli_real_escape_string($db,$_POST['username']);
		$sql="SELECT id,Password from register where username='$username' AND Password='$pass'";
		$result=mysqli_query($db,$sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count=mysqli_num_rows($result);
		if($count==1)
		{
			//Session Management
			$usrid=$row['id'];
			$pswd=$row['Password'];
			$_SESSION['uid']=$usrid;
			$_SESSION['upass']=$pswd;
			$sql="UPDATE register set status=1,last_seen=CURRENT_TIMESTAMP() where id=$usrid";
			$result=mysqli_query($db,$sql);
			header("location:dashboard.php");
		}else
		{
			$mess="Invalid Username or Password. Try Again.";
		}
	}else
	{
		$mess="Please Enter Your Username And Password.";
	}
}
?>
<html>
<head><title>Welcome to MyChat</title>
<style>
body
{
	margin:0px 0px;
}
#myheader,#myfooter
{
	height:6%;
	width:100%;
	background:rgba(127,127,127,1);
	float:left;
	text-align:center;
	font-family:Arial;
	font-size:24px;
	font-weight:bold;
}
#logincontainer
{
	height:90%;
	width:100%;
	background-image:url("Images/back.png");
	//background:green;
	float:left;
}
#loginc
{
	height:50%;
	width:40%;
	margin:5% 30%;
	background:rgba(127,127,127,1);
	border:2px solid black;
	padding-top:6%;
	text-align:center;
	//background-image:linear-gradient(to right,#ccc,#ddd);
}
.inputstyle
{
	height:10%;
	width:100%;
	//border:1px solid blue;
	text-align:center;
	margin-top:5%;
}
input[type=text],input[type=password]
{
	height:30px;
	width:250px;
	font-family:Cooper;
}
input[type=submit]
{
	border:none;
	height:50px;
	width:350px;
	margin-top:20px;
	font-family:Cooper;
	transition-duration:2s;
	cursor:hand;
	border:2px solid rgba(255,255,255,1);
}
input[type=submit]:hover
{
	background:rgba(80,80,80,0.8);
	color:white;
	
}
label
{
	//border:1px solid;
	font-size:18px;
	font-family:Cooper;
}
</style>
</head>
<body>
<div id="myheader">
MyChat
</div>
<div id="logincontainer">
	<div id="loginc">
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
			<p class="inputstyle"><label>Username : </label><input type="text" name="username" placeholder="Enter Your Username" required /></p>
			<p class="inputstyle"><label>Password : </label><input type="password" name="pass" placeholder="Enter Your Password" required /></p>
			<input type="submit" value="Login">
		</form>
		<a href="register.php">Create an account?</a>
		<br>
		<br>
		<?php echo $mess;?>
	</div>
</div>
<div id="myfooter">
mychat.com
</div>
</body>
</html>