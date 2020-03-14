<?php
include("config.php");
session_start();
date_default_timezone_set("Asia/Kolkata");
if(isset($_SESSION['uid']) && isset($_SESSION['upass']))
{
	$usrid=$_SESSION['uid'];
	$upass=$_SESSION['upass'];
}else
{
	header("location:index.php");
}
$res="";
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tuid']))
{
	$tid=mysqli_real_escape_string($db,$_POST['tuid']);
	$sql="SELECT * from register where id=$tid";
	$result=mysqli_query($db,$sql);
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count=mysqli_num_rows($result);
	if($count==1)
	{
		$name=$row['Name'];
		$dp=$row['dp'];
		$status=$row['status'];
		$ls=strtotime($row['last_seen']);
		$curtime=time();
		$diff=$curtime-$ls;
		if($diff>5)
		{
			$ups="UPDATE register set status=0 where id=$tid";
			$resseen=mysqli_query($db,$ups);
			$tag=$diff." sec";
			//mins
			if($diff>60)
			{
				$tag=floor($diff/60)." min";
			}
			//hours
			if($diff>3600)
			{
				$tag=floor($diff/3600)." hr";
			}
			//days
			if($diff>86400)
			{
				$tag=floor($diff/86400)." d";
			}
			$statustxt="Last Seen: ".$tag." ago";
		}else
		{
			$statustxt="Active";
		}
		$res=$res.'<div id="activechat">
				<img class="dp" src="data/'.$dp.'"/>
				<label>'.$name.'</label>
				<label style="float:right;">'.$statustxt.'</label>
			</div>
			<div id="messcont">
				<h4 style="text-align:center;color:blue;">Say Hi! To Start Conversation.</h4>
			</div>
			<div id="inpcont">
				<textarea name="messfield" placeholder="Enter Message.." id="messArea"></textarea>
				<button onclick="sendmess('.$tid.');">Send</button>
			</div>';
			$_SESSION['activechat']=$tid;
	}else
	{
		$res="Oooppsss. Some Error Occurs. :-(";
	}
}else
{
	header("location:dashboard.php");
}
echo $res;
?>