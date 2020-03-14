<?php
include("config.php");
session_start();
if(isset($_SESSION['uid']) && isset($_SESSION['upass']))
{
	$usrid=$_SESSION['uid'];
	$sql="UPDATE register set status=1,last_seen=CURRENT_TIMESTAMP() where id=$usrid";
	$result=mysqli_query($db,$sql);
}else
{
	header("location:dashboard.php");
}
?>