<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	
	$category = $_POST['txtCategory'];
	
	if(isset($_POST['btnSubmit']))
	{
		$ins = "insert into tbl_category (cat_name) value('".$category."')";
		mysql_query($ins);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | ADD CATEGORY</title>
</head>

<body style="background-color:#FCFCF8">
<h2 style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">Add Category</h2>
<form id="form1" name="form1" method="post" action="" style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif">
  <table width="50%" cellpadding="5" style="background-color:#FFF">
    <tr>
      <td>Category Name</td>
      <td><label for="txtCategory"></label>
      <input type="text" name="txtCategory" id="txtCategory" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" /></td>
    </tr>
  </table>
</form>
</body>
</html>