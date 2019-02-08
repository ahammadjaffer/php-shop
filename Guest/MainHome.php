<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | HOME PAGE</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="../Guest/style.css"/>
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
</head>

<body>
<div class="container">
<h2>My Shop</h2>
</div>
<div class="container">
<nav>
    <a href="MainHome.php" class="navmenu">Home</a>
    <a href="UserLogin.php" class="navmenu">My Profile</a>
    <a href="ShopLogin.php" class="navmenu">Shop</a>
    <a href="AdminLogin.php" class="navmenu">Admin</a>
</nav>
<hr  color="#CC3366"  size="5"/>
</div>
<div class="container">
    <table width="50%" class="filter">
      <tr>
        <td>Filter</td>
        <td>
            <select name="selCategory" id="selCategory" onchange="getsubcat(this.value)" class="dropdown">
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
        
     		</select>
     	</td>
        <td><label for="selSubCat"></label>
        <select name="selSubCat" id="selSubCat" onchange="getitems(this.value)" class="dropdown">
        <option>---Select---</option>
      </select></td>
      </tr>
    </table>
</div>
<div class="container">
<div class="main">
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
		$selQuery = "select * from tbl_items LIMIT $offset, $noOfRecordsInPage";
		$resSelect = mysql_query($selQuery) or die("Cannot connect to table");
		
		
		//To display grid
    	for($i=$totalcount['total'];$i>0;$i=$i-3)
		{
			if($i>3)
			{
				for($j=0;$j<3;$j++)
				{
			?>
            <div class="img">
            	<?php $row = mysql_fetch_array($resSelect);?>
                <img src="../Shop/ProductImage/<?php echo $row['itemImage'] ;?>" height="25%" width="100%"/><br />
                <span style="padding-left:3%">
                <span style="font-weight:600">
                <a href="UserLogin.php" style="text-decoration:none">
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
            </div>
            
            
		 <?php
				}
			}
			else
			{
				for($j=0;$j<$i;$j++)
				{
			?>
					<?php $row = mysql_fetch_array($resSelect);?>
                    		<img src="ProductImage/<?php echo $row['itemImage'] ;?>" height="25%" width="100%"/><br />
							<span style="padding-left:3%">
                            <span style="font-weight:600">
                       		<a href="UserLogin.php" style="text-decoration:none">
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
                       
            <?php
				}
			}
			?>
           <?php
			if($i==($totalcount['total']-3))
			{
				break;
			}
		}?>
        <div class="clearfix"></div>
        
</div>
</div>
<div class="container">
	
		<div class="paging">
            <!-- To decrement page -->
            <p class="<?php if($pagenumber<=1){echo 'disabled';} ?>">
            <a href="<?php if($pagenumber<=1){echo '#';}else{echo "?pageNumber=".($pagenumber-1);} ?>" style="text-decoration:none">
            <b><<</b></a></p>
        </div>
        <div class="paging">
			<!-- To increment page -->
            <p class="<?php if($pagenumber >= $pageCount){echo 'disabled';} ?>">
            <a href="<?php if($pagenumber >=$pageCount){echo '#';}else{echo "?pageNumber=".($pagenumber+1);}?>" style="text-decoration:none">
            <b>>></b></a></p>
        </div>
	</div>
    <div class="clearfix"></div>
</div>
</body>
</html>