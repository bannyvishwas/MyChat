<?php
include("config.php");
session_start();
$mess="";
if(isset($_SESSION['uid']) && isset($_SESSION['upass']))
{
	$usrid=$_SESSION['uid'];
	if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['tuid']))
	{
		$tid=mysqli_real_escape_string($db,$_POST['tuid']);
		/* 
			cansee=0 (Both can see)
			cansee=id (User with id can see)
		*/ 
		$sql="DELETE from chat where fromid IN ($usrid,$tid) AND toid IN ($usrid,$tid) AND cansee=$usrid";
		$result=mysqli_query($db,$sql);
		$sql2="UPDATE chat set cansee=$tid where fromid IN ($usrid,$tid) AND toid IN ($usrid,$tid) AND cansee=0";
		$result2=mysqli_query($db,$sql2);
		if($result && $result2)
		{
			$mess="Messages Deleted Successfully.";
		}else
		{
			$mess="Unable to Delete Messages.";
		}
	}
}else
{
	header("location:dashboard.php");
}
echo $mess;
?>