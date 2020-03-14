function showsetting(vis)
{
	$('#mypass').val('');  //Clear MyPass Field
	$('#newpass').val('');  //Clear NewPass Field
	var mainb=document.getElementById("backbox");
	mainb.style.display="block";
	var subbox=document.getElementById(vis);
	subbox.style.display="block";
}
function disablesetting(vis)
{
	var mainb=document.getElementById("backbox");
	mainb.style.display="none";
	var subbox=document.getElementById(vis);
	subbox.style.display="none";
}

//update profile picture
function updatedp(nm){
	$.ajax
	({
	  type: 'post',
	  url: 'uploadpic.php',
	  data:  new FormData(nm),
	  contentType: false,
	  cache: false,
	  processData:false,
	  success: function (response) 
	  {
		$("#mymess").html(response);
		disablesetting("dpbox");
		showsetting("messB");
	   }
	});
	return false;
}

//update profile setting
function updateprofile(nm){
	$.ajax
	({
	  type: 'post',
	  url: 'updateprofile.php',
	  data:  new FormData(nm),
	  contentType: false,
	  cache: false,
	  processData:false,
	  success: function (response) 
	  {
		$("#mymess").html(response);
		disablesetting("setting");
		showsetting("messB");
	   }
	});
	return false;
}

//Search people
function searchpeople(txt){
	if(txt!='')
	{
		$.ajax
		({
		  type: 'post',
		  url: 'peoplelist.php',
		  data: 
		  {
			searchtxt:txt,
		  },
		  success: function (response) 
		  {
				$("#peoplelistcont").html(response);
				$("#peoplelistcont").css("display","block");
				$("#friendslist").css("display","none");
		   }
		});
	}else
	{
		$("#peoplelistcont").css("display","none");
		$("#friendslist").css("display","block");
	}
}

//load chat window
function loadchatwin(tousrid){
	$.ajax
	({
	  type: 'post',
	  url: 'loadchatwin.php',
	  data: 
	  {
		tuid:tousrid,
	  },
	  success: function (response) 
	  {
			$("#chatcont").html(response);
	   }
	});
}

//Load Messages
function loadmess()
{
	$.ajax
    ({
      type: 'post',
      url: 'loadmess.php',
      success: function (response) 
      {
		  $("#messcont").html(response);
		setTimeout(function(){$('#messcont').scrollTop(document.getElementById('messcont').scrollHeight-$('#messcont').height())},500);
	  }
    });
}

setInterval('loadmess()', 500);

//Send Messages
function sendmess(tid)
{
  var mess = $('#messArea').val();
  if(mess!='')
  {
    $.ajax
    ({
      type: 'post',
      url: 'sendmess.php',
      data: 
      {
         usrmess:mess
      },
      success: function (response) 
      {
	    $('#messArea').val('');
		setTimeout(function(){$('#messcont').scrollTop(document.getElementById('messcont').scrollHeight-$('#messcont').height())},500);
      }
    });
  }else
  {
	  alert("Please Enter Your Message.");
  }
}

//Remove chat
function removechat(tousrid){
	$.ajax
	({
	  type: 'post',
	  url: 'removechat.php',
	  data: 
	  {
		tuid:tousrid,
	  },
	  success: function (response) 
	  {
		$("#mymess").html(response);
		showsetting("messB");
	   }
	});
}

//Update Last Seen
function updatelastseen()
{
	$.ajax
    ({
      type: 'post',
      url: 'updateseen.php',
      success: function (response) 
      {
		//do nothing
	  }
    });
}

setInterval('updatelastseen()', 5000);	
