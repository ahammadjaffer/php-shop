<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	
	$password = $_POST['txtPassword'];
	$cpword = $_POST['txtCPassword'];
	
	$idNo = $_GET['$idNo'];
	echo $idNo;
	if(isset($_POST['btnSubmit']))
	{
		$UpdateQuery = "update tbl_shops set shopPassword = '".$password."' where shopId=".$idNo."";
		mysql_query ($UpdateQuery);
		echo"<script>alert('Password Changed Successfully') </script>";	
		header('location:../Shop/HomePage.php');				
				
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | CHANGE PASSWORD 2</title>
<script>
function pswdCheck(rpwd,pwd)
{
	if(rpwd.value != pwd.value)
	{
		alert('Password Mismatch');
		rpwd.value = '';
		pwd.focus();	
	}
}

</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>New Password</td>
      <td><label for="txtPassword"></label>
      <input type="text" name="txtPassword" id="txtPassword" /></td>
    </tr>
    <tr>
      <td>Confirm Password</td>
      <td><label for="txtCPassword"></label>
      <input type="text" name="txtCPassword" id="txtCPassword" onblur="pswdCheck(this,txtPassword)"/></td>
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