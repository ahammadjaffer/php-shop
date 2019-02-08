<?php
	session_start();
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	
	//To select from Cart, Cart head, Items
	$selCartQuery = "select * from tbl_cart c inner join tbl_carthead ch on c.userId=ch.userId inner join tbl_items i on c.itemId=i.itemId where ch.chStatus = 0 and c.cartStatus = 0 and c.userId='".$_SESSION['loggedInId']."'";
	$selCartRes = mysql_query($selCartQuery) or die ("cannot connect to tables");
	
	$selCartResp = mysql_query($selCartQuery) or die ("cannot connect");
	$rowp = mysql_fetch_array($selCartResp);
	$chTP = $rowp['chGrandtotal'];

	$idNo=$_REQUEST['id'];
	
	//To delete item row
	if($_GET['delId'])
	{
		
		$priceUpdateQuery = "select * from tbl_cart where cartId = ".$idNo."";
		$priceUpdateres = mysql_query($priceUpdateQuery);
		$priceUpdaterow = mysql_fetch_array($priceUpdateres);
		$p=$priceUpdaterow['itemTotal'];
		$chTP=$chTP-$p;
		$updateCHQuery = "update tbl_cartHead set chGrandtotal='".$chTP."' where userId = '".$_SESSION['loggedInId']."' and chStatus=0";
		mysql_query($updateCHQuery);
		
		$delQry="delete from tbl_cart where cartId=".$idNo."";
		mysql_query($delQry);
		echo"<script>alert('Successfully Removed')</script>";
		header('location:CartPage.php');
	}
	
	//To buy cart item
	/*if($_GET['buyId'])
	{
		$buyValue="select * from tbl_carthead where  userId = '".$_SESSION['loggedInId']."' and chStatus = 0";
		$res=mysql_query($buyValue) or die("Cannot connect to table cartHead");
		$rowEdit=mysql_fetch_array($res);
		$updateQuery = "update tbl_carthead set chStatus = 1 where  chId = '".$rowEdit['chId']."'";
		mysql_query($updateQuery);
	}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | CART</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="../Guest/style.css"/>
<style>
	.navmenu:hover
	{
		color:#F00;
	}
</style>
</head>

<body>
<div class="container">
<h2>Shop Car</h2>
</div>
<div class="container">
<!-- Navigation -->
<nav>
	<div style="width:100%" align="center">
		<a href="homepage.php" class="navmenu">Home</a>
    	<a href="CartPage.php"  class="navmenu">Cart</a>
        <a href="MyProfile.php" class="navmenu">My Profile</a>
    </div>
</nav>
<hr  color="#CC3366"  size="5"/>
</div>
<form id="form1" name="form1" method="post" action="">
  <table class="TableCart">
    <tr>
      <th>Name</th>
      <th>Quantity</th>
      <th>Price</th>
    </tr>
    <?php
    while($row = mysql_fetch_array($selCartRes))
	{
		$total = $row['chGrandtotal'];
		$crtId = $row['cartId'];
		//$_SESSION['crtId']=$row['cartId'];
		$chrtId = $row['chId'];
	?>
    <tr class="cartrow">
      <td><?php echo $row['itemName']; ?></td>
      <td><?php echo $row['itemQuantity']; ?></td>
      <td><?php echo $row['itemPrice']; ?></td>
      <td><a href="CartPage.php?delId=1&amp;id=<?php echo $row['cartId'] ?>" style="text-decoration:none">Remove</a></td>
      <td><a href="../Payment2/First.php?buyId=1&amp;cartid=<?php echo $crtId;?>&amp;chrtid=<?php echo $chrtId;?>" style="text-decoration:none">Buy Now</a></td>
    </tr>
    <?php
	
	//$itemTotal = $row['chGrandtotal'];
	}
	?>
    <tr>
      <td>&nbsp;</td>
      <td>Grand Total</td>
      <td><?php echo $total; ?></td>
      <td><a href="../Payment/First.php?buyId=1&amp;chrtid=<?php echo $chrtId;?>&amp;grandTotal=<?php echo $total;?>"style="text-decoration:none">Buy</a></td>
    </tr>
  </table>
</form>
</body>
</html>