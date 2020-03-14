<?php
session_start();
if(isset($_SESSION['uid']) && isset($_SESSION['upass']))
{
	header("location:php/dashboard.php");
}else
{
	header("location:php/logout.php");
}
?>