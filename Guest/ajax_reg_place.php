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

				$district_id = $_REQUEST ['id'];
				$selQueryPlace = "select * from tbl_places where district_id = '".$district_id."'";
				$resPlace=mysql_query($selQueryPlace,$connect) or die('Cannot connect to table');
		?>
        <select name="sel_place" id="sel_place">
        <option>---Select---</option>
        <?php
				while($rowPlace=mysql_fetch_array($resPlace))
				{
	 	?>
    	<option value="<?php echo $rowPlace['place_id'];?>"><?php echo $rowPlace['place_name'];?></option>
      
      	<?php
				}
		?>
</body>
</html>