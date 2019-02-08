<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db("db_mywork",$connect);
?>	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif">
	<table width="70%" align="center" style="background-color:#FFF" cellspacing="25">
    <td>Filter</td>
      <td><label for="selCategory"></label>
        <select name="selCategory" id="selCategory" onchange="getsubcat(this.value)">
        <option>---Select---</option>
        
        <?php
        	$selQuery = "select * from tbl_category";
			$res = mysql_query($selQuery) or die("Cannot connect to table");
		
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
        $subcategory_id = $_REQUEST ['id1'];
		$selQuery = "select * from tbl_items where subcatId='".$subcategory_id."'";
		$resSelect = mysql_query($selQuery) or die("Cannot connect to table");
	?>
	
	
	
	<?php
    	$queryCount = "select count(itemId) as total from tbl_items where subcatId='".$subcategory_id."'";
		$count = mysql_query($queryCount);
		$totalcount = mysql_fetch_array($count);
    	//echo $totalcount['total'];
		
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
			if($i==($totalcount['total']-6))
			{
				break;
			}
		}
				
				
?>