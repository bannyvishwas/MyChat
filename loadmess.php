<?php
include("config.php");
session_start();
if(isset($_SESSION['uid']) && isset($_SESSION['upass']) && isset($_SESSION['activechat']))
{
	$usrid=$_SESSION['uid'];
	$upass=$_SESSION['upass'];
	$tid=$_SESSION['activechat'];
	$sql="SELECT * from chat where fromid IN ($usrid,$tid) AND toid IN ($usrid,$tid) AND cansee IN (0,$usrid) order by texttime";
	$result=mysqli_query($db,$sql);
	$count=mysqli_num_rows($result);
	if($count==0)
	{
		//Display Message when no messages to show
		?>
		<h4 style="text-align:center;color:blue;">Say Hi! To Start Conversation.</h4>
		<?php
	}else
	{
		
	}
	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		$frid=$row['fromid'];
		$messtxt=htmlspecialchars($row['chat']);
		$tt= date("D,g:i a (d-m-Y)", strtotime($row['texttime']));
		if($frid==$usrid)
		{
			$s="S";
		}else
		{
			$s="R";
		}
		?>
		<div class="messtext">
			<div class="messBox mess<?php echo $s;?>">
				<?php echo $messtxt;?>
			</div>
			<label class="label<?php echo $s;?>"><?php echo $tt;?></label>
		</div>
		<?php
	}
}else
{
	header("location:dashboard.php");
}
?>