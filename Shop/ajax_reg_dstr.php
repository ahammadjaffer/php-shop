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

				$state_id = $_REQUEST ['id'];
				$selQueryDistrict = "select * from tbl_district where st_id = '".$state_id."'";
				$resDistrict=mysql_query($selQueryDistrict,$connect) or die('Cannot connect to table');
		?>
        <select name="sel_district" id="sel_district">
        <option>---Select---</option>
         <?php
				while($rowDistrict=mysql_fetch_array($resDistrict))
				{
	 	?>
    	<option value="<?php echo $rowDistrict['district_id'];?>"><?php echo $rowDistrict['district_name'];?></option>
      
      	<?php
				}
		?>
</body>
</html>