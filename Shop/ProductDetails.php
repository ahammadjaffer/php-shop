<?php
	session_start();
	$connect =mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	
	$productname = $_POST['txtProductname'];
	$img = $_FILES['fileImage']['name'];
	$temp = $_FILES['fileImage']['tmp_name'];
	move_uploaded_file($temp,"../Shop/ProductImage/".$img);
	$price = $_POST['txtPrice'];
	$details = $_POST['txtDetails'];
	$catid = $_POST['selCat'];
	$subcategory = $_POST['selSubCat'];
	
	
	//Insert to cart table
	if(isset($_POST['btnSubmit']))
	{
		$ins = "insert into tbl_items (itemName,itemImage,itemPrice,itemDetail,cat_id,subcatId,shopId) value('".$productname."','".$img."','".$price."','".$details."','".$catid."','".$subcategory."','".$_SESSION['loggedInId']."')";
		mysql_query($ins);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | ADD PRODUCT</title>
<script src="jQuery.js" type="text/javascript"></script>
<!--To select subcategory-->
<script>
	function getsubcat(a)
	{
		$.ajax 
		(
			{
				url:"ajax_subcat.php?id="+a,
				success:function(result)
				{
					$("#selSubCat").html(result);
				}
			}
		);
	}
</script>
</head>

<body style="background-color:#FCFCF8">
<h2 style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">Add Product</h2>
<hr  color="#CC3366"  size="5"/>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"  style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif">
  <table width="50%" style="background-color:#FFF">
  
  	<tr>
      <td>Category</td>
      <td><label for="selCat"></label>
        <select name="selCat" id="selCat" onchange="getsubcat(this.value)">
        <option>---Select---</option>
        <?php
			$selQuery = "select * from tbl_category";
			$res = mysql_query($selQuery);
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
      <td>SubCategory</td>
      <td><label for="selSubCat"></label>
        <select name="selSubCat" id="selSubCat">
        <option>---Select---</option>
        <option value="<?php echo $rowSubcat['subcatId'];?>"><?php echo $rowSubcat['subcatName'];?></option>
      </select></td>
    </tr>
    <tr>
      <td>Product Name</td>
      <td><label for="txtProductname"></label>
      <input type="text" name="txtProductname" id="txtProductname" /></td>
    </tr>
    
    <tr>
      <td>Price</td>
      <td><label for="txtPrice"></label>
      <input type="text" name="txtPrice" id="txtPrice" /></td>
    </tr>
    <tr>
      <td>Details</td>
      <td><label for="txtDetails"></label>
      <textarea name="txtDetails" id="txtDetails" cols="21" rows="3"></textarea></td>
    </tr>
  <tr>
      <td>Image</td>
      <td><label for="fileImage"></label>
      <input type="file" name="fileImage" id="fileImage" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" /></td>
    </tr>
  </table>
</form>
</body>
</html>