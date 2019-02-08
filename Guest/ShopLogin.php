<?php

	session_start();
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	
	$userName = $_POST['txtUsername'];
	$password = $_POST['txtPassword'];
	
	if(isset($_POST['btnLogin']))
	{
		$selQuery = "select * from tbl_shops";
		$res = mysql_query($selQuery);
		while($row=mysql_fetch_array($res))
			{
				if(($row['shopUsername']==$userName)&&($row['shopPassword']==$password))
				{
					$_SESSION['loggedInId']=$row['shopId'];
					//$_SESSION['loggedInUName']=$row['shopUsername'];
					//$_SESSION['loggedInPassword']=$row['shopPassword'];
					
					//To update login status
					$updateQuery = "update tbl_shops set shopLoginStatus = 1 where shopId='".$row['shopId']."'";
					mysql_query($updateQuery);
					echo"<script>alert('login Successfull') </script>";

					header('location:../Shop/MyProfile.php');				}
				else if(($row['shopUsername']==$userName)&&($row['shopPassword']!=$password))
				{
					echo"<script>alert('Invalid Password') </script>";
				}
				else if(($row['shopUsername']!=$userName)&&($row['shopPassword']==$password))
				{
					echo"<script>alert('Invalid Username') </script>";
				}
				else
				{
					echo"<script>alert('User Not Found') </script>";
				}
			}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | SHOP LOGIN</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="../Guest/style.css"/>
</head>

<body>
<div class="container">
	<h2>Shop Login</h2>
    <hr  color="#CC3366"  size="5" style="margin:50px 0"/>
</div>
<form id="form1" name="form1" method="post" action="">
  <table class="Login">
    <tr>
      <td><label for="txtUsername"></label>
      <input type="text" name="txtUsername" id="txtUsername"  placeholder="UserName"  autofocus="autofocus"/></td>
    </tr>
    <tr>
      <td><label for="txtPassword"></label>
      <input type="text" name="txtPassword" id="txtPassword" placeholder="Password" /></td>
    </tr>
    <tr>
      <td align="center"><input type="submit" name="btnLogin" id="btnLogin" value="Login"  class="button"/>
      <input type="submit" name="btnCancel" id="btnCancel" value="Cancel" class="cancelbtn"/></td>
    </tr>
    <tr>
      <td class="forgpass">Forget password ? <a href="../Shop/ChangePassword.php">Click here</a></td>
    </tr>
    <tr>
      <td class="newacc">Dont Have an account ? <a href="ShopRegister.php">Click here</a></td>
    </tr>
  </table>
</form>
</body>
</html>