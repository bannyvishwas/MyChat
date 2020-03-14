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
$res="";
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searchtxt']))
{
	$person=htmlspecialchars(mysqli_real_escape_string($db,$_POST['searchtxt']));
	$sql="SELECT * from register where (Username LIKE '$person%' OR Email LIKE '$person%' OR Name LIKE '$person%') AND id!=$usrid order by id";
	$result=mysqli_query($db,$sql);
	$count=mysqli_num_rows($result);
	if($count==0)
	{
		$res='<div class="usrcontrol">
							<img class="dp" src="data/dp.png">
							<label style="font-weight:bold;">No User Found.</label>
							<label style="color:blue;">-----</label>
							<label style="color:red;">------</label>
						</div>';
	}else
	{
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$name=$row['Name'];
			$usrname=$row['Username'];
			$email=$row['Email'];
			$dp=$row['dp'];
			$tid=$row['id'];
			$status=$row['status'];
			if($status==1)
			{
				$statusbar='<div class="usrstatus"></div>';
			}else
			{
				$statusbar="";
			}
			//trim the Name length
			if(strlen($name)>20)
			{
				$name=substr($name,0,18)."..";
			}
			if(strlen($email)>18)
			{
				$email="(".substr($email,0,16)."..)";
			}
			if(strlen($usrname)>18)
			{
				$email="(".substr($usrname,0,16)."..)";
			}
			$res=$res.'<div class="usrcontrol">'.$statusbar.'
							<img class="dp" src="data/'.$dp.'">
							<label style="font-weight:bold;">'.$name.'</label>
							<label style="color:blue;">'.$usrname.'</label>
							<label style="color:red;">'.$email.'</label>
							<button onclick="loadchatwin('.$tid.');">Chat</button>
							<button onclick="removechat('.$tid.');">Remove</button>
						</div>';
		}
	}
}else
{
	header("location:dashboard.php");
}
echo $res;
?>