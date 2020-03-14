<?php
include("config.php");
session_start();
if(isset($_SESSION['uid']) && isset($_SESSION['upass']))
{
	$usrid=$_SESSION['uid'];
	$sql="UPDATE register set status=0 where id=$usrid";
	$result=mysqli_query($db,$sql);
	session_unset();
	session_destroy();
}
header("location:index.php");
?>