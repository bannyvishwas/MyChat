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
$imagePath="";
$sql="SELECT dp from register where id=$usrid";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result);
if($count==1)
{
	$dp=$row['dp'];
}else
{
	header("location:logout.php");
}
$msg="";
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['userImage']))
{
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        $targetPath = $_FILES['userImage']['name'];
		$imageFileType = strtolower(pathinfo($targetPath,PATHINFO_EXTENSION));
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			$msg="Please select an image file(.JPG,.JPEG,.PNG).";
		}else
		{
			if($_FILES['userImage']["size"]>5222400)
			{
				$msg="Image File Too Large.".$_FILES['userImage']["size"];
			}else{
				if (move_uploaded_file($_FILES['userImage']['tmp_name'], "data/".$usrid.".".$imageFileType))
				{
					
					$imagePath="data/".$usrid.".".$imageFileType;
					$sql="UPDATE register set dp='$usrid.$imageFileType' where id=$usrid";
					$result = mysqli_query($db,$sql);
					$msg="Profile Picture Updated Successfully.";
				}else
				{
					$msg="File Upload Error.";
				}
			}
		}
        
    }else
	{
		echo "Not Uploading.";
	}

}else
{
	$msg="Please select an image (png/jpg/jpeg).";
}
echo $msg;
?>