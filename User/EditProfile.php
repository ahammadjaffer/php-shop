<?php
	
	session_start();
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	
	$fname = $_POST['txtName'];
	$email = $_POST['txtEmail'];
	$contact = $_POST['txtNumber'];
	$gender = $_POST['rdogender'];
	$address = $_POST['txtAddress'];
	$place = $_POST['sel_place'];
	$username = $_POST['txtUsername'];
	$password = $_POST['txtPassword'];
	$sqans = $_POST['txtSqAnswer'];
	if(isset($_POST['btn_register']))
	{
		$ins = "update tbl_shopsuserreg set userName = '".$fname."',userEmail = '".$email."',userContact = '".$contact."',userGender = '".$gender."',userAddress = '".$address."',place_id = '".$place."',userUsername = '".$username."',userPassword = '".$password."',userSQans = '".$sqans."' where userId = '".$_SESSION['loggedInId']."'";
		mysql_query($ins);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MY SHOP | SHOP EDIT PROFILE</title>
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
<h3 style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">User Edit Profile</h3>
<hr  color="#CC3366"  size="5"/>
<form id="form1" name="form1" method="post" action=""  style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif">
  <table width="50%" style="background-color:#FFF" >
    <tr>
      <td width="41%">FullName</td>
      <td width="59%"><label for="txtName"></label>
      <input type="text" name="txtName" id="txtName" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txtEmail"></label>
      <input type="text" name="txtEmail" id="txtEmail" /></td>
    </tr>
    <tr>
      <td>Contact Number</td>
      <td><label for="txtNumber"></label>
      <input type="text" name="txtNumber" id="txtNumber" /></td>
    </tr>
    <tr>
      <td>Gender</td>
      <td><input type="radio" name="rdogender" id="rdogender" value="Male" />
      <label for="rdogender">Male
        <input type="radio" name="rdogender" id="rdogender" value="Female" />
      Female</label></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><label for="txtAddress"></label>
      <textarea name="txtAddress" id="txtAddress" cols="21" rows="2"></textarea></td>
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
      <td><label for="txtConfirmPassword"></label>
      <input type="text" name="txtConfirmPassword" id="txtConfirmPassword" onblur="pswdCheck(this,txtPassword)"/></td>
    </tr>
    <tr>
      <td>Sequrity Questions</td>
      <td><label for="selSequrityQuestion"></label>
        <select name="selSequrityQuestion" id="selSequrityQuestion">
        <option>---Select---</option>
        <option>Favorite Color</option>
        <option>Favorite Sport</option>
        <option>Favorite Food</option>
      </select></td>
    </tr>
    <tr>
      <td>Your Answer</td>
      <td><label for="txtSqAnswer"></label>
      <input type="text" name="txtSqAnswer" id="txtSqAnswer" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="btn_register" id="btn_register" value="Submit" />
      <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
</form>
</body>
</html>