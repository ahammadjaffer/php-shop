<?php
	session_start();
	$connect =mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	
	//To get item id and Rating
	$item_Id = $_REQUEST['id'];
	$rate_No = $_REQUEST['no'];
	
	$flag =0;
	
	
	
	//To select details from table rating
	$selQuery = "select * from tbl_rating where itemId = '".$item_Id."'";
	$res = mysql_query($selQuery);
	while($row=mysql_fetch_array($res))
	{
		if($row['userId']==$_SESSION['loggedInId'])
		{
			$flag = 1;
		}
		
	}
	//To update
	if($flag==1){
	$updateQuery = "update tbl_rating set rateNo='".$rate_No."' where userId='".$_SESSION['loggedInId']."' and itemId = '".$item_Id."'";
	mysql_query($updateQuery);
	}
	else{
	//To insert
	$insQuery="insert into tbl_rating(itemId,userId,rateNo)value('".$item_Id."','".$_SESSION['loggedInId']."','".$rate_No."')";
	mysql_query($insQuery);
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>