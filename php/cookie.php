<?php
session_start();
if(isset($_COOKIE["uid"]) && isset($_COOKIE["upass"]))
{
	setcookie("uid",$_COOKIE["uid"], time() + (86400*30),"/",null,null,true);//Active for 1 month
	setcookie("upass",$_COOKIE["upass"], time() + (86400*30),"/",null,null,true);//Active for 1 month
	$_SESSION['uid']=$_COOKIE["uid"];
	$_SESSION['upass']=$_COOKIE["upass"];
}
?>