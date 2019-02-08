<?php
	$connect =mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	
	$shopname = $_POST['txtShopname'];
	$ownername = $_POST['txtOwnername'];
	$username = $_POST['txtUsername'];
	$password = $_POST['txtPassword'];
	$place = $_POST['sel_place'];
	$contact = $_POST['txtNumber'];
	$email = $_POST['txtEmail'];
	$proof =$_FILES['imgProof']['name'];
	$temp = $_FILES['imgProof']['tmp_name'];
	move_uploaded_file($temp,"../Shop/Proof/".$proof);
	$logo = $_FILES['imgLogo']['name'];
	$temp = $_FILES['imgLogo']['tmp_name'];
	move_uploaded_file($temp,"../Shop/Logo/".$logo);
	$st = 0;
	
	if(isset($_POST['btnRegister']))
	{
		

		
		$ins = "insert into tbl_shops(shopName,shopOwner,shopUsername,shopPassword,place_id,shopContact,ShopEmail,shopProof,shopLogo,shopStatus,shopLoginStatus)value
		('".$shopname."','".$ownername."','".$username."','".$password."','".$place."','".$contact."','".$email."','".$proof."','".$logo."','".$st."',0)";
		mysql_query($ins);
		header('location:../Guest/UserLogin.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | SHOP REGISTRATION</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="../Guest/style.css"/>
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

<body>
<div class="container">
	<h2>Shop Registration</h2>
    <hr  color="#CC3366"  size="5" style="margin:50px 0"/>
</div>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif">
  <table class="Register">
    <tr>
      <td>Shop Name</td>
      <td><label for="txtShopname"></label>
      <input type="text" name="txtShopname" id="txtShopname" /></td>
    </tr>
    <tr>
      <td>Owner Name</td>
      <td><label for="txtOwnername"></label>
      <input type="text" name="txtOwnername" id="txtOwnername" /></td>
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
      <td>Confirm Password</td>
      <td><label for="txtConfirmpassword"></label>
      <input type="text" name="txtConfirmpassword" id="txtConfirmpassword" onblur="pswdCheck(this,txtPassword)"/></td>
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
      <td>Place</td>
      <td> 
        <select name="sel_place" id="sel_place">
        <option>---Select---</option>
        <option value="<?php echo $rowPlace['place_id'];?>"><?php echo $rowPlace['place_name'];?></option>
      </select>
      </td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txtNumber"></label>
      <input type="text" name="txtNumber" id="txtNumber" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txtEmail"></label>
      <input type="text" name="txtEmail" id="txtEmail" /></td>
    </tr>
    <tr>
      <td>Proof</td>
      <td><label for="imgProof"></label>
      <input type="file" name="imgProof" id="imgProof" /></td>
    </tr>
    <tr>
      <td>Logo</td>
      <td><label for="imgLogo"></label>
      <input type="file" name="imgLogo" id="imgLogo" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnRegister" id="btnRegister" value="Register" class="button"/>
      <input type="reset" name="btnCancel" id="btnCancel" value="Cancel" class="cancelbtn"/></td>
    </tr>
  </table>
</form>
</body>
</html>