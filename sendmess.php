<?php
include("config.php");
session_start();
if(isset($_SESSION['uid']) && isset($_SESSION['upass']) && isset($_SESSION['activechat']))
{
	$tid=$_SESSION['activechat'];
	$usrid=$_SESSION['uid'];
	if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['usrmess']))
	{
		$mess=mysqli_real_escape_string($db,$_POST['usrmess']);
		$sql="INSERT INTO chat (fromid,toid,chat) values($usrid,$tid,'$mess')";
		$result=mysqli_query($db,$sql);
	}
}else
{
	header("location:dashboard.php");
}
?>