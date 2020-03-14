<?php
include("config.php");
session_start();
$name="";
if(isset($_SESSION['uid']) && isset($_SESSION['upass']))
{
	$usrid=$_SESSION['uid'];
	$upass=$_SESSION['upass'];
}else
{
	header("location:index.php");
}
$sql="SELECT * from register where id=$usrid";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$count=mysqli_num_rows($result);
if($count==1)
{
	$name=$row['Name'];
	$dp=$row['dp'];
	$usrname=$row['Username'];
	$email=$row['Email'];
}else
{
	$mess="OOpppss. Some Error Occurs. :-(";
}
?>
<html>
<head>
<link rel="stylesheet" href="css/style.css"/>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
</head>
<body>
<div id="myheader">
MyChat
</div>
<div id="logincontainer">
	<div class="sidewin">
		<img class="dp" src="data/<?php echo $dp;?>"/>
		<button onclick="showsetting('dpbox');">Change Profile Picture</button>
		<button onclick="showsetting('setting');">Profile Settings</button>
		<button onclick="window.location.href='logout.php'">Logout</button>
	</div>
	<div class="middlewin">
		<div class="srch">
			<input type="text" name="searchbar" placeholder="Search By Name/Username/Email" id="searchtxt" onkeyup="searchpeople(this.value);"/>
		</div>
		<div id="chatcont">
		<h1 Style="text-align:center;color;">Welcome To MyChat</h1>
		<img src="Images/wel.png" style="height:80%;width:60%;margin-left:15%;"/>
		</div>
	</div>
	<div class="sidewin" id="friendslist">
		<?php
			$sql="select DISTINCT(r.id),r.name,r.dp,r.status from register r,chat c where (c.fromid=$usrid and r.id=c.toid) or (c.toid=$usrid and r.id=fromid) order by c.texttime desc";
			$result=mysqli_query($db,$sql);
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
			{
				$name=$row['name'];
				$tid=$row['id'];
				$dp=$row['dp'];
				$status=$row['status'];
				if(strlen($name)>20)
				{
					$name=substr($name,0,18)."..";
				}
				?>
				<div class="usrcontrol">
					<?php
					if($status==1)
					{
					?>
						<div class="usrstatus"></div>
					<?php
					}
						?>
					<img class="dp" src="data/<?php echo $dp;?>">
					<label style="font-weight:bold;"><?php echo $name;?></label>
					<button onclick="loadchatwin(<?php echo $tid;?>);">Chat</button>
					<button onclick="removechat(<?php echo $tid;?>);">Remove</button>
				</div>
				<?php
			}
		?>
	</div>
	<div class="sidewin" id="peoplelistcont" style="display:none;">
		<div class="usrcontrol">
			<div class="usrstatus"></div>
			<img class="dp" src="Images/dp.png">
			<label>Name</label>
			<label>Username</label>
			<label>Email</label>
			<button>Chat</button>
			<button>Remove</button>
		</div>
	</div>
</div>
<div id="myfooter">
mychat.com
</div>
<div id="backbox">
	<div id="setting">
		<label class="hdr">Profile Setting</label>
		<form onsubmit="return updateprofile(this);" method="post">
		<table>
			<tr>
				<td>Name:</td>
				<td><input type="text" name="uname" value="<?php echo $name;?>" required /></td>
			</tr>
			<tr>
				<td>Username:</td>
				<td><input type="text" name="usrn" value="<?php echo $usrname;?>" required /></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="email" name="email" value="<?php echo $email;?>" required /></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="newpswd" id="newpass"/></td>
			</tr>
		</table>
		<hr>
		<div id="savebtn">
			<h4>Type Your Password To Save Changes</h4>
			<input type="password" name="mypass" style="height:20%;width:70%;" id="mypass" required />
			<input type="submit" value="Save" style="margin-top:5%;"/>
			</form>
			<button type="button" onclick="disablesetting('setting');">Cancel</button>
		</div>
		
	</div>
	<div id="messB">
		<label class="hdr">Message</label>
		<span id="mymess"></span>
		<button style="display:block;" onclick="disablesetting('messB');">Ok</button>
	</div>
	<div id="dpbox">
		<label class="hdr">Update Profile Picture</label>
		<form onsubmit="return updatedp(this);" method="post" id="dpform">
			<input name="userImage" type="file" accept=".jpg,.jpeg,.png" required >
			<input type="submit" value="Save">
		</form>
		<button onclick="disablesetting('dpbox');">Cancel</button>
	</div>
</div>
</body>
</html>