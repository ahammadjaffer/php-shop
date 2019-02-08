<?php
	session_start();
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	$selQuery = "select * from   tbl_shops s inner join tbl_places p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where shopId= '".$_SESSION['loggedInId']."'";
	$res = mysql_query($selQuery);
	$rowEdit=mysql_fetch_array($res);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | SHOP MY PROFILE</title>
<style>
	.navmenu:hover
	{
		color:#F00;
	}
</style>
</head>

<body style="background-color:#FCFCF8">
<h3 align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif"><span style="font-size:56px">My Profile</span></h3>
<form id="form1" name="form1" method="post" action="" style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif">
<!-- Navigation -->
<nav>
	<div style="width:100%" align="center">
		<a href="homepage.php" style="text-decoration:none" class="navmenu">Home</a>
    	&nbsp;&nbsp;&nbsp;
         <a href="EditProfile.php" style="text-decoration:none" class="navmenu">Edit Profile</a>
         &nbsp;&nbsp;&nbsp;
         <a href="ChangePassword.php" style="text-decoration:none" class="navmenu">Change Password</a>
         &nbsp;&nbsp;&nbsp;
         <a href="ProductDetails.php" style="text-decoration:none" class="navmenu">Add Item</a>
         &nbsp;&nbsp;&nbsp;
         <a href="../Chat/ChatHome.php" style="text-decoration:none" class="navmenu">Chat</a>
    </div>
</nav>
<hr  color="#CC3366"  size="5"/>
  <table width="70%" height="70%" align="center"  style="background-color:#FFF">
    <tr >
      <td style="font-size:36px"><?php echo $rowEdit['shopName'];?></td>
      <td rowspan="3" align="center" width="50%"><img src="Logo/<?php echo $rowEdit['shopLogo'] ;?>" height="45%" width="45%"/></td>
      <td style="font-size:20px"><?php echo $rowEdit['shopOwner'];?></td>
    </tr>
    <tr >
      <td style="font-size:20px"><?php echo $rowEdit['place_name'];?></td>
      
      <td style="font-size:20px"><?php echo $rowEdit['shopContact'];?></td>
    </tr>
    <tr >
      <td>&nbsp;</td>
     
      <td style="font-size:20px"><?php echo $rowEdit['ShopEmail'];?></td>
    </tr>
  </table>
</form>
</body>
</html>