<?php
	session_start();
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	
	//date and time
	$date=date("d.m.y");
	date_default_timezone_set("Asia/Kolkata");
	$time=date("h:i:sa");
	
	//To select user from table chat
	$userSelQuery = "select * from tbl_chat c inner join tbl_items i on c.itemId = i.itemId inner join tbl_shops s on i.shopId = s.shopId inner join tbl_shopsuserreg u on c.userId=u.userId where s.shopId = '".$_SESSION['loggedInId']."' group by c.userId";
	$userRes = mysql_query($userSelQuery);
	
	//To read message from table chat
	$uId = $_REQUEST['uid'];
	$itemid = $_REQUEST['itemid'];
	$flag=0;
	if($_GET['delId'])
	{
		$flag =1;
		$selQuery = "select * from tbl_chat c inner join tbl_items i on c.itemId = i.itemId inner join tbl_shops s on s.shopId = i.shopId where c.userId = '".$uId."' and c.itemId='".$itemid."'";
		$res = mysql_query($selQuery);
		//header('location:ChatHome.php');
	}
	
	//To send shop message and to add to table chat
	$chatMessage = $_POST['txtSendMessage'];
	if(isset($_POST['btnSend']))
	{
		$chatinsertQuery = "insert into tbl_chat (itemId,userId,shopId,chatContent,chatReplyContent,chatDate,chatTime) value('".$itemid."','".$uId."','".$_SESSION['loggedInId']."','".""."','".$chatMessage."','".$date."','".$time."')";
		mysql_query($chatinsertQuery);
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | CHAT</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="../Guest/style.css"/>
<script src="jQuery.js" type="text/javascript"></script>

<style>
	.navmenu:hover
	{
		color:#F00;
	}
	a:hover
	{
		color:#6F9;
	}
	#tblMsg
	{
		background-color:#FFF;
	}
	.tbl
	{
		padding:10px;
	}
	.readmessage
	{
		padding:21px;
	}
	
</style>
</head>

<body>

<div class="container">
	<h2>Chat Home</h2>
</div>
<!-- Navigation -->
<div class="container">
<nav>
	
	  <a href="../Shop/HomePage.php" class="navmenu">Home</a>
      <a href="../Shop/MyProfile.php" class="navmenu">My Profile</a>
    
</nav>
<hr  color="#CC3366"  size="5"/>
</div>

<table class="tbl" width="40%" align="left" style="background-color:#FFF">
  <tr>
    <td><span style="font-size:26px">Users</span> <hr color="#0033FF"  size="1"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <?php
  	while($userRow=mysql_fetch_array($userRes))
	{
  ?>
  <tr>
    <td>
   <a href="ChatHome.php?delId=1&amp;uid=<?php echo $userRow['userId']; ?>&amp;itemid=<?php echo $userRow['itemId']; ?>" style="text-decoration:none"><?php echo $userRow['userName']; ?><hr  color="#00FF99"  size="1"/></a>
   </td>
  </tr>
  <?php
	}
  ?>  
  </table>
  
  <!--Message box-->
  <?php if($flag==1){ ?>
  <form id="form1" name="form1" method="post" action="">
  <table class="tbl" width="60%" style="float:right" id="tblMsg">
    <tr>
      <td class="readmessage msgView">
        	<?php 
			while($row = mysql_fetch_array($res))
			{
		?>
	  		<div <?php if($row['chatReplyContent']==""){?> align="right"<?php }else{?> align="left"<?php } ?>><?php if($row['chatContent']!=""){?><span class="usermsg"><?php echo $row['chatContent'];?></span><?php }else{?><span class="shopmsg"><?php echo $row['chatReplyContent'];?></span><?php } ?></div><br />
      	<?php
			}
		?>
        </td>
    </tr>
    <tr>
      <td><label for="txtSendMessage"></label>
        <textarea name="txtSendMessage" id="txtSendMessage" cols="100%" rows="3" placeholder="Type Here"></textarea></td>
    </tr>
    <tr>
      <td><input type="submit" name="btnSend" id="btnSend" value="Submit" class="button" /></td>
    </tr>
  </table>
   </form>
   <?php }else{?>
  <form id="form1" name="form1" method="post" action="">
  <table class="tbl" width="60%" style="float:right" id="tblMsg">
    <tr>
      <td><label for="txtShowMessage"></label>
        <textarea name="txtShowMessage" id="txtShowMessage" cols="100%" rows="35">b</textarea></td>
    </tr>
    <tr>
      <td><label for="txtSendMessage"></label>
        <textarea name="txtSendMessage" id="txtSendMessage" cols="100%" rows="3">b</textarea></td>
    </tr>
    <tr>
      <td><input type="submit" name="btnSend" id="btnSend" value="Submit" class="button" /></td>
    </tr>
  </table>
   </form>
   <?php }?>

</body>
</html>