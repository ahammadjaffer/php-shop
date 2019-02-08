<?php
	session_start();
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	$selQuery = "select * from   tbl_shopadminreg s inner join tbl_places p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where adminId= '".$_SESSION['loggedInId']."'";
	$res = mysql_query($selQuery);
	$rowEdit=mysql_fetch_array($res);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | ADMIN MY PROFILE</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="../Guest/style.css"/>
</head>

<body>
<div class="container">
	<h2>My Profile</h2>
</div>
<!-- Navigation -->
<div class="container">
<nav>
	
		<a href="../Guest/MainHome.php" class="navmenu">Home</a>
    	
         <a href="../Admin/EditProfile.php" class="navmenu">Edit Profile</a>
        
         <a href="../Admin/ChangePassword.php" class="navmenu">Change Password</a>
    
</nav>
<hr  color="#CC3366"  size="5"/>
</div>

<form id="form1" name="form1" method="post" action="" style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif">
  <table width="70%" height="70%" align="center"  style="background-color:#FFF">
    <tr >
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td style="font-size:26px"><?php echo $rowEdit['adminName'];?></td>
    </tr>
    <tr>
      <td style="font-size:15px"><?php echo $rowEdit['place_name'];?></td>
    </tr>
    <tr>
      <td style="font-size:15px"><?php echo $rowEdit['adminContact'];?></td>
    </tr>
    <tr>
      <td style="font-size:15px"><?php echo $rowEdit['adminEmail'];?></td>
    </tr>
  </table>
</form>
</body>
</html>