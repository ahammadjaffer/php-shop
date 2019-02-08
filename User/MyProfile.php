<?php
	session_start();
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	$selQuery = "select * from   tbl_shopsuserreg s inner join tbl_places p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where userId= '".$_SESSION['loggedInId']."'";
	$res = mysql_query($selQuery);
	$rowEdit=mysql_fetch_array($res);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | SHOP MY PROFILE</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="../Guest/style.css"/>
<script>
function logout()
	{
		
		$.ajax 
		(
			{
				url:"ajax_logout.php",
				
				success:function(result)
				{
					
				}
			}
		);
	}
</script>
<style>
	.navmenu:hover
	{
		color:#F00;
	}
</style>
</head>

<body>
<div class="container">
	<h2>My Profile</h2>
</div>
<!-- Navigation -->
<div class="container">
<nav>
	
		<a href="homepage.php" class="navmenu">Home</a>
   		
    	<a href="CartPage.php" class="navmenu">My Cart</a>
    	
         <a href="../User/EditProfile.php" class="navmenu">Edit Profile</a>
        
         <a href="../User/ChangePassword.php" class="navmenu">Change Password</a>
        
         <a href="../Guest/UserLogin.php" class="navmenu" onclick="logout()">Logout</a>
    
</nav>
<hr  color="#CC3366"  size="5"/>
</div>

<form id="form1" name="form1" method="post" action="" >
  <table  class="Login">
    <tr >
      <td><div class="uname"><?php echo $rowEdit['userName'];?></div></td>
    </tr>
	<tr >
      <td ><?php echo $rowEdit['userGender'];?></td>
    </tr>
    <tr >
      <td ><?php echo $rowEdit['userAddress'];?></td>
    </tr>
    <tr >
      <td ><?php echo $rowEdit['place_name'];?></td>
    </tr>
    <tr >
      <td ><?php echo $rowEdit['userContact'];?></td>
    </tr>
    <tr >
      <td ><?php echo $rowEdit['userEmail'];?></td>
    </tr>
  </table>
</form>
</body>
</html>