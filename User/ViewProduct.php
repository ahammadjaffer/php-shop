<?php
	session_start();
	$connect =mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	$item_id =$_REQUEST['id'];
	
	//date and time
	$date=date("d.m.y");
	date_default_timezone_set("Asia/Kolkata");
	$time=date("h:i:sa");
	
	//To select item, category, sub category
	$sel = "select * from tbl_items i inner join tbl_subcategory s on i.subcatId=s.subcatId inner join tbl_category c on s.cat_id=c.cat_id where itemId =$item_id";
	$res = mysql_query($sel);
	$row = mysql_fetch_array($res);
	
	//To set number of items default to 1
	$itemCount = $_POST['txtNumberOfItems'];
	if($itemCount=="")
	{
		$itemCount=1;
	}
	$total = $row['itemPrice']*$itemCount;
	
	//For table cart head
	$chTempTotal = $total;
	
	
	$itemflag = 0;
	//To check user already have item in cart 
	$itemcheckquery = "select * from tbl_cart where userId = '".$_SESSION['loggedInId']."'";
	$itemcheckres = mysql_query($itemcheckquery);
	while($itemcheckrow = mysql_fetch_array($itemcheckres))
	{
		if($itemcheckrow['itemId'] == $row['itemId'])
		{
			$itemflag = 1;
			$cartId = $itemcheckrow['cartId'];
			$cartTotal = $itemcheckrow['itemTotal'];
			$cartitemcount = $itemcheckrow['itemQuantity']+$itemCount;
			$total = ($row['itemPrice']*$itemCount)+$cartTotal;
		}
	}
	/*
	//To select total rating
	$selrateQuery = "select sum(rateNo) as rtotal, count(rate_id) as rcount from tbl_rating where itemId='".$item_id."'";
	$resrate = mysql_query($selrateQuery);
	$rowrate = mysql_fetch_array($resrate);
	$rateTotal = (($rowrate['rtotal']/($rowrate['rcount']*5))*5);
	*/
	//To select total rating
	$selrateQuery = "select avg(rateNo) as rateTotal from tbl_rating where itemId='".$item_id."' and userId = '".$_SESSION['loggedInId']."'";
	$resrate = mysql_query($selrateQuery);
	$rowrate = mysql_fetch_array($resrate);
	
	//To select Shop
	$selShop = "select * from tbl_shops where shopId = '".$row['shopId']."'";
	$resShop = mysql_query($selShop);
	$rowShop = mysql_fetch_array($resShop);
	
	//To select table cartHead
	$selCHQuery = "select * from tbl_cartHead where chStatus=0";
	$CHres = mysql_query($selCHQuery);
	$flag = FALSE;

	//To check user alredy in table cartHead
	while($CHrow = mysql_fetch_array($CHres))
	{
		if($CHrow['userId'] == $_SESSION['loggedInId'])
		{
			$chtotal = $CHrow['chGrandtotal'];
			$flag = TRUE;
		}
	}
	
	$chGtotal = $chtotal + $chTempTotal;
	
	$comment = $_POST['txtComment'];
	
	//To add comment
	if(isset($_POST['btnAddComment']))
	{
		if($comment!="")
		{
			$commentQuery = "insert into tbl_comment(itemId,userId,commentWord,commentDate) value ('".$item_id."','".$_SESSION['loggedInId']."','".$comment."','".$date."')";
			mysql_query($commentQuery);
		}
		else
		{
			echo"<script>alert('Write comment on comment box first !') </script>";
		}
	}
	
	if(isset($_POST['btnBuy']))
	{
		if($row['itemQnt']==0)
		{
			echo"<script>alert('OUT OF STOCK !') </script>";
		}
		else
		{
			//To update table cart
			if($itemflag==0)
			{	
				$cartQuery = "insert into tbl_cart (userId,itemId,itemQuantity,itemPrice,itemTotal,cartStatus) value ('".$_SESSION['loggedInId']."','".$row['itemId']."','".$itemCount."','".$row['itemPrice']."','".$total."',0)";
				mysql_query($cartQuery);
			}
			else
			{
				$updateCartQuery = "update tbl_cart set itemQuantity='".$cartitemcount."',itemTotal='".$total."' where cartId = '".$cartId."'";
				mysql_query($updateCartQuery);
			}
			
			//To update table cartHead
			if($flag==TRUE)
			{	
				$updateCHQuery = "update tbl_cartHead set chDate='".$date."',chTime='".$time."',chGrandtotal='".$chGtotal."' where userId = '".$_SESSION['loggedInId']."'";
				mysql_query($updateCHQuery);
			}
			else	
			{
				$CHInsertQuery = "insert into tbl_cartHead (userId,chDate,chTime,chStatus,chGrandtotal) value ('".$_SESSION['loggedInId']."','".$date."','".$time."',0,'".$total."')";
				mysql_query($CHInsertQuery);
			}
		}
	}

	//To insert chat message into table chat
	$chatMessage = $_POST['txtChat'];
	if(isset($_POST['btnChat']))
	{
		$chatinsertQuery = "insert into tbl_chat (itemId,userId,shopId,chatContent,chatReplyContent,chatDate,chatTime) value('".$item_id."','".$_SESSION['loggedInId']."','".$row['shopId']."','".$chatMessage."','".""."','".$date."','".$time."')";
		mysql_query($chatinsertQuery);
	}
	
	//To read messages from table chat
	$chatflag=0;
	$selectChatMessageQuery = "select * from tbl_chat where userId = '".$_SESSION['loggedInId']."' and itemId = '".$item_id."'";
	$selectChatMessageRes = mysql_query($selectChatMessageQuery);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | VIEW PRODUCT</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="../Guest/style.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="jQuery.js" type="text/javascript"></script>
<script>
	function rateInsert(itemid,rateno)
	{
		$.ajax(
		{
			url:"ajaxrateInsert.php",
			data:{id:itemid,no:rateno},
			success: function(result){}
		})
	}
</script>
<style>
	.checked
	{
		color:#FF9;
	}
	a:hover,a:active
	{
		color:#FF9;
	}
	a:active
	{
		color:#FF9;
	}
	.navmenu:hover
	{
		color:#F00;
	}
	
	
</style>
</head>

<body style="background-color:#FCFCF8">
<h2 align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif"><span style="font-size:56px">View Product</span></h2>
<!-- Navigation -->
<nav>
	<div style="width:100%" align="center">
		<a href="homepage.php" style="text-decoration:none" class="navmenu">Home</a>
   		&nbsp;&nbsp;&nbsp;
    	<a href="CartPage.php" style="text-decoration:none" class="navmenu">Cart</a>
    	&nbsp;&nbsp;&nbsp;
        <a href="MyProfile.php" style="text-decoration:none" class="navmenu">My Profile</a>
    </div>
</nav>
<hr  color="#CC3366"  size="5"/>
<form id="form1" name="form1" method="post" action="" style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif">
  <table width="70%"  cellspacing="5" cellpadding="5" align="center" style="background-color:#FFF">
    <tr>
      <td height="100" style="font-size:35px"><?php echo $row['itemName']; ?></td>
      <td rowspan="3"><img src="../Shop/ProductImage/<?php echo $row['itemImage'] ;?>" height="250" width="250"/></td>
      <td style="font-size:25px"><?php echo $row['itemDetail']; ?>
      <br />
       <br />
     <span style="font-size:15px"> Rating </span>&nbsp;&nbsp;&nbsp;<?php echo $rowrate['rateTotal']; ?>
      </td>
    </tr>
    <tr>
      <td rowspan="2"><span style="font-weight:600"><?php echo $row['cat_name']; ?>&nbsp;>&nbsp;<?php echo $row['subcatName']; ?></span>
      <br /><br />
      Shipped By <?php echo $rowShop['shopName']; ?>
      </td>
     
      <td style="font-weight:600"><label for="txtNumberOfItems"></label>Quantity
        <input type="text" name="txtNumberOfItems" id="txtNumberOfItems" onchange="getTotalPrice(this.value,$row['itemPrice'])"/>
     <br />
      <br />
      Rs : <?php echo $row['itemPrice']; ?></td>
    </tr>
    <tr>
    	<td><input type="submit" name="btnBuy" id="btnBuy" value="Add To Cart" class="button addtocart" /></td>
    </tr>
    <tr>
    	<td><span style="font-weight:600">Review &amp; Rate</span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <!--To give rating-->
    <tr>
    	<td>Rating</td>
      <!--<td>
        	<a href="ViewProduct.php?itemId=<?php echo $item_id?>"onclick="rateInsert(<?php echo $item_id;?>,1)"><span class="fa fa-star"></span>
            <a href="ViewProduct.php?itemId=<?php echo $item_id?>"onclick="rateInsert(<?php echo $item_id;?>,2)"><span class="fa fa-star"></span>
            <a href="ViewProduct.php?itemId=<?php echo $item_id?>"onclick="rateInsert(<?php echo $item_id;?>,3)"><span class="fa fa-star"></span>
            <a href="ViewProduct.php?itemId=<?php echo $item_id?>"onclick="rateInsert(<?php echo $item_id;?>,4)"><span class="fa fa-star"></span>
            <a href="ViewProduct.php?itemId=<?php echo $item_id?>"onclick="rateInsert(<?php echo $item_id;?>,5)"><span class="fa fa-star"></span>
      </td>-->
        <td>
          <input type="radio" name="radio" id="rdorate" value="<?php echo $item_id?>" onclick="rateInsert(<?php echo $item_id;?>,1)"/>
          <input type="radio" name="radio" id="rdorate" value="<?php echo $item_id?>" onclick="rateInsert(<?php echo $item_id;?>,2)"/>
          <input type="radio" name="radio" id="rdorate" value="<?php echo $item_id?>" onclick="rateInsert(<?php echo $item_id;?>,3)"/>
          <input type="radio" name="radio" id="rdorate" value="<?php echo $item_id?>" onclick="rateInsert(<?php echo $item_id;?>,4)"/>
          <input type="radio" name="radio" id="rdorate" value="<?php echo $item_id?>" onclick="rateInsert(<?php echo $item_id;?>,5)"/>
        </td>
        <td>&nbsp;</td>
    </tr>
    <!--To add comment-->
    <tr>
    	<td>Add Comment</td>
        <td colspan="2"><label for="txtComment"></label>
        <textarea name="txtComment" id="txtComment" cols="45" rows="5" placeholder="Add your comment"></textarea></td>
        
    </tr>
     <tr>
        <td>&nbsp;</td>
        <td align="right"><input type="submit" name="btnAddComment" id="btnAddComment" value="Submit" class="button" /></td>
        <td>&nbsp;</td>
    </tr>
    
    <!--To view comments-->
    <tr>
    	<td><span style="font-weight:600">Comments</span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>        
    </tr>
    <?php 
		$commentSelQuery = " select * from tbl_comment c inner join tbl_shopsuserreg u on c.userId=u.userId where itemId =$item_id";
		$commentSelres = mysql_query($commentSelQuery) or die("Cannot connect to table comments");
		while($commentSelrow = mysql_fetch_array($commentSelres))
		{
	?>
     <tr>
    	<td>&nbsp;</td>
        <td colspan="2" style="background-color:#FFC"><span style="font-weight:600"><?php echo $commentSelrow['userName']; ?></span> <br /> <?php echo $commentSelrow['commentWord']; ?> <br /> <span style="font-size:10px"><?php echo $commentSelrow['commentDate']; ?></span></td>
    </tr>
    <?php
		}
	?>
   
  </table>
  <hr  color="#CC3366"  size="1"/>
  <table align="center">
    <tr>
      <td class="msgView"><label for="txtChatView"></label>
     
      <?php 
			while($selectChatMessageRow = mysql_fetch_array($selectChatMessageRes))
			{
		?>
	  		<div <?php if($selectChatMessageRow['chatReplyContent']==""){?> align="right"<?php }else{?> align="left"<?php } ?>>
            
			  <?php if($selectChatMessageRow['chatContent']!="")
              {?><span class="usermsg"><?php echo $selectChatMessageRow['chatContent'];?></span><?php }
              
              else{?><span class="shopmsg"><?php echo $selectChatMessageRow['chatReplyContent'];}
			?></span></div><br />
      	<?php
			}
		?>
      </td>
    </tr>
    <tr>
      <td><label for="txtChat"></label>
      <textarea name="txtChat" id="txtChat" cols="45" rows="5" placeholder="Type Here"></textarea></td>
    </tr>
    <tr>
      <td><input type="submit" name="btnChat" id="btnChat" value="Submit" class="button" /></td>
    </tr>
  </table>
</form>
</body>
</html>