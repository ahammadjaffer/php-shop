<?php
	session_start();
	$connect =mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	$item_id =$_REQUEST['id'];
	$sel = "select * from tbl_items i inner join tbl_subcategory s on i.subcatId=s.subcatId inner join tbl_category c on s.cat_id=c.cat_id where itemId =$item_id";
	$res = mysql_query($sel);
	$row = mysql_fetch_array($res);
	
	if(isset($_POST['btnBuy']))
	{
		$cartQuery = "insert into tbl_cart (shopId,userId,itemId,cartStatus) value ('".$row['shopId']."','".$_SESSION['loggedInId']."','".$row['itemId']."',0)";
		mysql_query($cartQuery);
	}
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | VIEW PRODUCT</title>
</head>

<body style="background-color:#FCFCF8">
<h2 align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif"><span style="font-size:56px">View Product</span></h2>
<hr  color="#CC3366"  size="5"/>
<form id="form1" name="form1" method="post" action="" style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif">
  <table width="70%"  cellspacing="5" cellpadding="5" align="center" style="background-color:#FFF">
    <tr>
      <td height="100" style="font-size:35px"><?php echo $row['itemName']; ?></td>
      <td rowspan="3"><img src="ProductImage/<?php echo $row['itemImage'] ;?>" height="250" width="250"/></td>
      <td style="font-size:25px"><?php echo $row['itemDetail']; ?></td>
    </tr>
    <tr>
      <td rowspan="2" style="font-weight:600"><?php echo $row['cat_name']; ?>&nbsp;>&nbsp;<?php echo $row['subcatName']; ?></td>
     
      <td style="font-weight:600">Rs : <?php echo $row['itemPrice']; ?></td>
    </tr>
   
  </table>
</form>
</body>
</html>