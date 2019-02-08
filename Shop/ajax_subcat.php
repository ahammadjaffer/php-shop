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

<body>
	<?php

				$category_id = $_REQUEST ['id'];
				$selQuerySubcat = "select * from tbl_subcategory where cat_id = '".$category_id."'";
				$resSubcat=mysql_query($selQuerySubcat,$connect) or die('Cannot connect to table Subcat');
		?>
        <select name="selSubCat" id="selSubCat">
        <option>---Select---</option>
         <?php
				while($rowSubcat=mysql_fetch_array($resSubcat))
				{
	 	?>
    	<option value="<?php echo $rowSubcat['subcatId'];?>"><?php echo $rowSubcat['subcatName'];?></option>
      
      	<?php
				}
		?>
</body>
</html>