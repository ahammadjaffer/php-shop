<?php
	session_start();
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	
	$fname = $_POST['txtName'];
	$username = $_POST['txtUsername'];
	$password = $_POST['txtPassword'];
	$place = $_POST['sel_place'];
	$email = $_POST['txtEmail'];
	$contact = $_POST['txtNumber'];
	$proof =$_FILES['imgProof']['name'];
	$temp = $_FILES['imgProof']['tmp_name'];
	move_uploaded_file($temp,"../Admin/Proof/".$proof);
	
	if(isset($_POST['btnSubmit']))
	{
		$ins = "update tbl_ShopAdminReg set adminName='".$fname."',adminUsername='".$username."',adminPassword='".$password."',place_id='".$place."',adminEmail='".$email."',adminContact='".$contact."',adminProof='".$proof."' where adminId = '".$_SESSION['loggedInId']."'";
		mysql_query($ins);
		//header('location:../Admin/MyProfile.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | ADMIN REGISTRATION</title>
<script src="jQuery.js" type="text/javascript"></script>
<script>
	function getdis(a)
	{
		$.ajax 
		(
			{
				url:"ajax_reg_dstr.php?id="+a,
				success:function(result)
				{
					$("#sel_district").html(result);
				}
			}
		);
	}
	function getplace(a)
	{
		$.ajax 
		(
			{
				url:"ajax_reg_place.php?id="+a,
				success:function(result)
				{
					$("#sel_place").html(result);
				}
			}
		);
	}
</script>
<script>
function pswdCheck(rpwd,pwd)
{
	if(rpwd.value != pwd.value)
	{
		alert('Password Mismatch');
		rpwd.value = '';
		pwd.focus();	
	}
}

</script>
</head>

<body style="background-color:#FCFCF8">

<h2 style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">Admin Registration</h2>

<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="" style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif">
  <table width="50%" style="background-color:#FFF" >
    <tr>
      <td>FullName</td>
      <td><label for="txtName"></label>
      <input type="text" name="txtName" id="txtName" autofocus="autofocus"/></td>
    </tr>
    <tr>
      <td>UserName</td>
      <td><label for="txtUsername"></label>
      <input type="text" name="txtUsername" id="txtUsername" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txtPassword"></label>
      <input type="text" name="txtPassword" id="txtPassword" /></td>
    </tr>
    <tr>
      <td>ConfirmPassword</td>
      <td><label for="txtConfirmPassword"></label>
      <input type="text" name="txtConfirmPassword" id="txtConfirmPassword" onblur="pswdCheck(this,txtPassword)"/></td>
    </tr>
    <tr>
      <td>State</td>
      <td><label for="selstate"></label>
      		<?php
				$selQueryState = "select * from tbl_states";
				$resState=mysql_query($selQueryState,$connect) or die('Cannot connect to table');
			?>
        <select name="selstate" id="selstate" onchange="getdis(this.value)">
        <option>---Select---</option>
 			 <?php
				while($rowState=mysql_fetch_array($resState))
				{
	 		?>
    	    <option value="<?php echo $rowState['st_id'];?>"><?php echo $rowState['st_name'];?></option>
      
      		 <?php
					}
			 ?>
        </select></td>
    </tr>
    <tr>
       <td>District</td>
     <td>
        <select name="sel_district" id="sel_district" onchange="getplace(this.value)">
        <option>---Select---</option>
    	<option value="<?php echo $rowDistrict['district_id'];?>"><?php echo $rowDistrict['district_name'];?></option>
      </select>
      </td>
    </tr>
    <tr>
    <tr>
      <td>Place</td>
      <td> 
        <select name="sel_place" id="sel_place">
        <option>---Select---</option>
        <option value="<?php echo $rowPlace['place_id'];?>"><?php echo $rowPlace['place_name'];?></option>
      </select>
      </td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txtEmail"></label>
      <input type="text" name="txtEmail" id="txtEmail" /></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txtNumber"></label>
      <input type="text" name="txtNumber" id="txtNumber" /></td>
    </tr>
    <tr>
      <td>Proof</td>
      <td><label for="imgProof"></label>
      <input type="file" name="imgProof" id="imgProof" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSubmit" id="btnSubmit" value="Register" />
      <input type="reset" name="btnCancel" id="btnCancel" value="Cancel" /></td>
    </tr>
  </table>
</form>
</body>
</html>