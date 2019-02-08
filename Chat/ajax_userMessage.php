<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	
	$uId = $_REQUEST['a'];
	$itemid = $_REQUEST['b'];
	echo "user Id =" .$uId;
	echo $itemid;
	$selQuery = "select * from tbl_chat c inner join tbl_items i on c.itemId = i.itemId inner join tbl_shops s on s.shopId = i.shopId where c.userId = '".$uId."' and c.itemId='".$itemid."'";
	$res = mysql_query($selQuery);
	echo $selQuery;
	
	if(isset($_POST['btnSend']))
	{
		$insertQuery = "";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | CHAT</title>
</head>

<body style="background-color:#FCFCF8">
<h3 align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif"><span style="font-size:56px">Chat Home</span></h3>
<div style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif">
<!-- Navigation -->
<nav>
	<div style="width:100%" align="center">
	  <a href="../Shop/HomePage.php" style="text-decoration:none" class="navmenu">Home</a>
   		&nbsp;&nbsp;&nbsp;
   	  <a href="../Shop/CartPage.php" style="text-decoration:none" class="navmenu">Cart</a>
    	&nbsp;&nbsp;&nbsp;
      <a href="../Shop/MyProfile.php" style="text-decoration:none" class="navmenu">My Profile</a>
    </div>
</nav>
<hr  color="#CC3366"  size="5"/>
<!--Message box-->
<form id="form1" name="form1" method="post" action="">
  <table width="30%" id="tblMsg" style="background-color:#FFF" align="center">
    <tr>
      <td>
      	<?php 
			while($row = mysql_fetch_array($res))
			{
		?>
	  		<div <?php if($row['chatReplyContent']==""){?> align="right"<?php }else{?> align="left"<?php } ?>><span style="font-size:19px"><?php echo $row['chatContent']; ?></span></div><br />
      	<?php
			}
		?>
      </td>
    </tr>
    <tr>
      <td><label for="txtMsg"></label>
        <textarea name="txtMsg" id="txtMsg" cols="48" rows="5"></textarea></td>
    </tr>
    <tr>
      <td><input type="submit" name="btnSend" id="btnSend" value="Send" /></td>
    </tr>
  </table>
</form>

 <!--Message box-->
  <table class="tbl" width="60%" style="float:right" id="tblMsg">
    <tr>
      <td>A</td>
    </tr>
    <tr>
      <td>B</td>
    </tr>
    <tr>
      <td>C</td>
    </tr>
  </table>
</div>
</body>
</html>