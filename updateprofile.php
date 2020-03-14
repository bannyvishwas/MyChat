<?php
include("config.php");
session_start();
if(isset($_SESSION['uid']) && isset($_SESSION['upass']))
{
	$usrid=$_SESSION['uid'];
	$upass=$_SESSION['upass'];
}else
{
	header("location:index.php");
}
$msg="";
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['uname']) && isset($_POST['usrn']) && isset($_POST['email']) && isset($_POST['mypass']))
{
	$mypass=md5(mysqli_real_escape_string($db,$_POST['mypass']));
	//Check user authenticity
	if($mypass==$upass)
	{
		$newpass=$mypass;
		if(isset($_POST['newpswd']) && $_POST['newpswd']!='')
		{
			$newpass=md5(mysqli_real_escape_string($db,$_POST['newpswd']));
		}
		$name=htmlspecialchars(mysqli_real_escape_string($db,$_POST['uname']));
		$usrname=htmlspecialchars(mysqli_real_escape_string($db,$_POST['usrn']));
		$email=mysqli_real_escape_string($db,$_POST['email']);
		
		//checking for other existing username
		$sql="Select Username from register where Username='$usrname' AND id!=$usrid";
		$result=mysqli_query($db,$sql);
		$count=mysqli_num_rows($result);
		if($count==0)
		{
			$sql="UPDATE register set Name='$name',Username='$usrname',Email='$email',Password='$newpass' where id=$usrid";
			$result=mysqli_query($db,$sql);
			if(mysqli_affected_rows($db)==0)
			{
				$msg="No change in profile settings found.";
			}else
			{
				//Update Session Variables
				$_SESSION['upass']=$newpass;
				$msg="Profile settings saved successfully.";
			}
		}else
		{
			$msg="Username Already Exist. Try with different Username.";
		}
	}else
	{
		$msg="Incorrect Password. Unable to Save Changes. Try with Correct Password.";
	}
	
}else
{
	header("location:dashboard.php");
}
echo $msg;
?>