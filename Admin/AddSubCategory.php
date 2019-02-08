<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	
	$category = $_POST['selCategory'];
	$subcategory = $_POST['txtSubCategory'];
	
	if(isset($_POST['btnSubmit']))
	{
		$ins = "insert into tbl_subcategory (subcatName,cat_id) value('".$subcategory."','".$category."')";
		mysql_query($ins);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | ADD SUB CATEGORY</title>
</head>

<body style="background-color:#FCFCF8">
<h2 style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">Add SubCategory</h2>
<form id="form1" name="form1" method="post" action="" style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif">
  <table width="50%" cellpadding="5" style="background-color:#FFF">
    <tr>
      <td>Sub Category Name</td>
      <td><label for="txtSubCategory"></label>
      <input type="text" name="txtSubCategory" id="txtSubCategory" /></td>
    </tr>
    <tr>
      <td>Category</td>
      <td><label for="selCategory"></label>
        <select name="selCategory" id="selCategory">
        <option>---Select---</option>
    <?php
		$selQuery = "select * from tbl_category";
		$res = mysql_query($selQuery) or die("Cannot connet to table category");
		
		while($row = mysql_fetch_array($res))
		{
		?>
        <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></option>
        <?php
		}
		?>
      </select></td>
    </tr>
	
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" /></td>
    </tr>
  </table>
</form>
</body>
</html>