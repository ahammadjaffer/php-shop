<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | REJECTED SHOPS</title>
</head>

<body style="background-color:#FCFCF8">
<h2 align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">Rejected Shops</h2>
<form id="form1" name="form1" method="post" action="">
  <table width="75%" border="5" align="center" style="background-color:#FFF" style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif">
    <tr>
      <td>Shop Id</td>
      <td>Shop Name</td>
      <td>Shop Owner</td>
      <td>Place Id</td>
      <td>Shop Contact</td>
      <td>Shop Email</td>
      <td>Shop Proof</td>
      <td>Shop Logo</td>
      <td>Shop Status</td>
    </tr>
    <?php
		//Select UnApproved Shops
		$selQuery = "select * from tbl_shops shop inner join tbl_places place on shop.place_id = place.place_id where shopStatus ='2'";
		$res = mysql_query($selQuery,$connect) or die('Cannot connect to shop table');
		
		while($row = mysql_fetch_array($res))
		{
	?>
    <tr>
      <td style="border-style:none"><?php echo $row['shopId']; ?></td>
      <td style="border-style:none"><?php echo $row['shopName']; ?></td>
      <td style="border-style:none"><?php echo $row['shopOwner']; ?></td>
      <td style="border-style:none"><?php echo $row['place_name']; ?></td>
      <td style="border-style:none"><?php echo $row['shopContact']; ?></td>
      <td style="border-style:none"><?php echo $row['ShopEmail']; ?></td>
      <td style="border-style:none"><img src="../Shop/Proof/<?php echo $row['shopProof'] ;?>" height="50" width="50"/></td>
      <td style="border-style:none"><img src="../Shop/Logo/<?php echo $row['shopLogo'] ;?>" height="50" width="50"/></td>
      <td style="border-style:none"><?php echo $row['shopStatus']; ?></td>
    </tr>
    <?php
		}
		?>
  </table>
</form>
</body>
</html>