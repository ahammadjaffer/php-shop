<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	
	$userName = $_POST['txtUsername'];
	$email = $_POST['txtEmail'];
	$contact = $_POST['txtContact'];
	
	if(isset($_POST['btnSubmit']))
	{
		$selQuery = "select adminId,adminUsername,adminEmail,adminContact from tbl_shopadminreg";
		$res = mysql_query($selQuery);
		while($row=mysql_fetch_array($res))
			{
				if(($row['adminUsername']==$userName)&&($row['adminEmail']==$email)&&($row['adminContact']==$contact))
				{
				$idNo = $row['adminId'];
				echo "$idNo";
					

					header('location:../Admin/ChangePassword2.php?&$idNo='.$idNo.'');				
				}
				else if(($row['adminUsername']==$userName)&&($row['adminEmail']==$email)&&($row['adminContact']!=$contact))
				{
					echo"<script>alert('Invalid Contact') </script>";			
			}
			else if(($row['adminUsername']==$userName)&&($row['adminEmail']!=$email)&&($row['adminContact']==$contact))
			{
					echo"<script>alert('Invalid Email') </script>";			
				}
				else if(($row['adminUsername']!=$userName)&&($row['adminEmail']==$email)&&($row['adminContact']==$contact))
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
<title>MY SHOP | CHANGE PASSWORD</title>
</head>

<body style="background-color:#FCFCF8">
<h2 style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">Change Password Admin</h2>
<form id="form1" name="form1" method="post" action="" style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif">
  <table width="50%" style="background-color:#FFF">
    <tr>
      <td>UserName</td>
      <td><label for="txtUsername"></label>
      <input type="text" name="txtUsername" id="txtUsername" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txtEmail"></label>
      <input type="text" name="txtEmail" id="txtEmail" /></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txtContact"></label>
      <input type="text" name="txtContact" id="txtContact" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" />
      <input type="reset" name="btnCancel" id="btnCancel" value="Cancel" /></td>
    </tr>
  </table>
</form>
</body>
</html>