<?php

	session_start();
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	
	
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | HOME</title>
<script src="jQuery.js" type="text/javascript"></script>
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
	
	function getitems(b)
	{
		$.ajax 
		(
			{
				url:"ajax_items.php?id1="+b,
				success:function(result)
				{
					$("#tbl").html(result);
				}
			}
		);
	}
</script>
<style>
	.navmenu:hover
	{
		color:#F00;
	}
</style>
</head>

<body style="background-color:#FCFCF8">
<h3 align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif"><span style="font-size:56px">My Shop</span></h3>

<!-- Navigation -->
<nav>
	<div style="width:100%" align="center">
		<a href="homepage.php" style="text-decoration:none" class="navmenu">Home</a>
    	&nbsp;&nbsp;&nbsp;
         <a href="MyProfile.php" style="text-decoration:none" class="navmenu">My Profile</a>
         &nbsp;&nbsp;&nbsp;
         <a href="../Chat/ChatHome.php" style="text-decoration:none" class="navmenu">Chat</a>
    </div>
</nav>
<hr  color="#CC3366"  size="5"/>
<form id="form1" name="form1" method="post" action="" style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif">
   
  <table id="tbl" width="70%" align="center" style="background-color:#FFF" cellspacing="25">
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
    	<!--Filter code-->
      <td>Filter</td>
      <td><label for="selCategory"></label>
        <select name="selCategory" id="selCategory" onchange="getsubcat(this.value)">
        <option>---Select---</option>
        
        <?php
        	$selQuery = "select * from tbl_category";
			$res = mysql_query($selQuery) or die("Cannot connect to table category");
		
			while($row=mysql_fetch_array($res))
				{
		?>
        <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></option>
        <?php
				}
		?>
        
      </select></td>
      <td><label for="selSubCat"></label>
        <select name="selSubCat" id="selSubCat" onchange="getitems(this.value)">
        <option>---Select---</option>
      </select></td>
      
    </tr>
	
	<?php
	
		if(isset($_GET['pageNumber']))
	{
		$pagenumber = $_GET['pageNumber'];
	}
	else
	{
		$pagenumber = 1;
	}
	$noOfRecordsInPage = 6;
	$offset = ($pagenumber - 1) * $noOfRecordsInPage;
		
		//to select number of rows of tbl_items
    	$queryCount = "select count(itemId) as total from tbl_items";
		$count = mysql_query($queryCount);
		$totalcount = mysql_fetch_array($count);
		$pageCount = ceil($totalcount['total']/$noOfRecordsInPage);
		
    	//echo $totalcount['total'];
		
		//to select items from tbl_items
		$selQuery = "select * from tbl_items where shopId='".$_SESSION['loggedInId']."' LIMIT $offset, $noOfRecordsInPage ";
		$resSelect = mysql_query($selQuery) or die("Cannot connect to table items");
		
		
		//To display grid
    	for($i=$totalcount['total'];$i>0;$i=$i-3)
		{
			?>
			<tr>
            <?php
			if($i>3)
			{
				for($j=0;$j<3;$j++)
				{
			?>
					<td style="background-color:#EBEBEB"><?php $row = mysql_fetch_array($resSelect);?>
                    		<img src="ProductImage/<?php echo $row['itemImage'] ;?>" height="25%" width="100%"/><br />
							<span style="padding-left:3%">
                            <span style="font-weight:600">
                       		<a href="ViewProduct.php?itemId=1&amp;id=<?php echo $row['itemId'];?>" style="text-decoration:none">
							<?php echo $row['itemName']; ?>
                        	</a>
                        	</span>
                            </span>
                       		<br />
                            <span style="padding-left:3%">
                        	<?php echo $row['itemDetail']; ?>
                            </span>
                        	<br />
                            <span style="padding-left:3%">
                        	Rs : <?php echo $row['itemPrice']; ?>
                            </span>
                        </td>
            <?php
				}
			}
			else
			{
				for($j=0;$j<$i;$j++)
				{
			?>
					<td style="background-color:#EBEBEB"><?php $row = mysql_fetch_array($resSelect);?>
                    		<img src="ProductImage/<?php echo $row['itemImage'] ;?>" height="25%" width="100%"/><br />
							<span style="padding-left:3%">
                            <span style="font-weight:600">
                       		<a href="ViewProduct.php?itemId=1&amp;id=<?php echo $row['itemId'];?>" style="text-decoration:none">
							<?php echo $row['itemName']; ?>
                        	</a>
                        	</span>
                            </span>
                       		<br />
                            <span style="padding-left:3%">
                        	<?php echo $row['itemDetail']; ?>
                            </span>
                        	<br />
                            <span style="padding-left:3%">
                        	Rs : <?php echo $row['itemPrice']; ?>
                            </span>
                        </td>
            <?php
				}
			}
			?>
            </tr>
            <?php
			if($i==($totalcount['total']-3))
			{
				break;
			}
		}
		
		?>
   		<tr>
        	<td align="right"><p class="<?php if($pagenumber<=1){echo 'disabled';} ?>">
            <a href="<?php if($pagenumber<=1){echo '#';}else{echo "?pageNumber=".($pagenumber-1);} ?>" style="text-decoration:none">
            <b><<</b></a></p></td>
            <td></td>
            <td><p class="<?php if($pagenumber >= $pageCount){echo 'disabled';} ?>">
            <a href="<?php if($pagenumber >=$pageCount){echo '#';}else{echo "?pageNumber=".($pagenumber+1);}?>" style="text-decoration:none">
            <b>>></b></a></p></td>
      	</tr>
    
  </table>
</form>
</body>
</html>