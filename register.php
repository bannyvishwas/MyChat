<?php
//Connect to the database
include("config.php");
$mess="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	if(isset($_POST['fname']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['gen']))
	{
		$usrname=htmlspecialchars(mysqli_real_escape_string($db,$_POST['username']));
		$pass=md5(mysqli_real_escape_string($db,$_POST['pass']));
		$name=htmlspecialchars(mysqli_real_escape_string($db,$_POST['fname']));
		$email=mysqli_real_escape_string($db,$_POST['email']);
		$gen=mysqli_real_escape_string($db,$_POST['gen']);
		//Prepare SQL Commands
		$sql="SELECT username FROM register WHERE username='$usrname'";
		$result=mysqli_query($db,$sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count=mysqli_num_rows($result);
		if($count>0)
		{
			$mess="Username: $usrname already exists.Try Another.";
		}else
		{
			//Insert The data
			$sql="INSERT INTO register (name,email,username,password,gender) values ('$name','$email','$usrname','$pass','$gen')";
			$result=mysqli_query($db,$sql);
			if($result)
			{
				$mess="Successfully Registered. Please Login to Continue.";
			}else
			{
				$mess="Oooppss. Some Error Occurs. :-(";
			}
		}
	}else
	{
		$mess="Please fill all the details.";
	}
}
?>
<html>
<head><title>Register</title>
<style>
body
{
	font-family:Cooper;
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
	height:70%;
	width:40%;
	margin:5% 30%;
	background:rgba(127,127,127,1);
	border:2px solid black;
	//padding-top:6%;
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
input[type=text],input[type=password],input[type=email]
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
	text-align:center;
	width:100%;
	font-size:24px;
}
table
{
	height:60%;
	width:100%;
	text-align:center;
}
</style>
</head>
<body>
<div id="myheader">
MyChat
</div>
<div id="logincontainer">
	<div id="loginc">
	<label>Register</label>
		<!-- method: GET/POST-->
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
			<table>
				<tr>
					<td>
						 Name : 
					</td>
					<td>
						<input type="text" name="fname" placeholder="Enter Your Name" required />
					</td>
				</tr>
				<tr>
					<td>
						 Email : 
					</td>
					<td>
						<input type="email" name="email" placeholder="Enter Your Email" required />
					</td>
				</tr>
				<tr>
					<td>
						 Username : 
					</td>
					<td>
						<input type="text" name="username" placeholder="Enter Your Username" required />
					</td>
				</tr>
				<tr>
					<td>
						 Password : 
					</td>
					<td>
						<input type="password" name="pass" placeholder="Enter Your Password" required />
					</td>
				</tr>
				<tr>
					<td>
						 Gender : 
					</td>
					<td>
						<input type="radio" name="gen" value="male" required />Male
						<input type="radio" name="gen" value="female"/>Female
					</td>
				</tr>
			</table>
			<input type="submit" value="Register">
		</form>
		<a href="index.php">Already have an account?</a>
		<br>
		<?php echo $mess;?>
	</div>
</div>
<div id="myfooter">
mychat.com
</div>
</body>
</html>