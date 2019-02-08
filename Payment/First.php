<?php
	session_start();
	$connect=mysql_connect("localhost","root","root");
	mysql_select_db("db_mywork",$connect)or die("connection error");
	
	
	$chrt_id=$_GET['chrtid'];
	//echo $chrt_id;
	//echo "total=".$_SESSION['total']=$cart['cart_total'];
	$total=$_GET['grandTotal'];
	//echo $total;
	if(isset($_POST['btnsub']))
	{
		header('Location:Second.php?&chrtid='.$chrt_id.'&grandTotal='.$total.'');
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../../include/css/style.css">
<title>UpWork</title>
<script>
function checknum(y)
{
	var numericExp=/^\d{4}$/;
	if(numericExp.test(y)==false)
	{
		alert("Not 4 digit confirmation number");
		return false;
	}
}
</script>

<style type="text/css">
        .auto-style15 {
            height: 134px;
        }
        .auto-style18 {
            text-align: right;
            width: 322px;
        }
        .style5 {}
        .auto-style19 {
            width: 58px;
            height: 31px;
        }
        .auto-style20 {
            height: 52px;
        }
        .auto-style21 {
            height: 23px;
        }
        .auto-style22 {
            height: 52px;
            width: 322px;
        }
        .auto-style23 {
            width: 322px;
        }
        .auto-style24 {
            height: 23px;
            width: 322px;
        }
        .auto-style25 {
            color: #3366FF;
        }
        .auto-style26 {
            text-align: right;
            width: 322px;
            color: #3366FF;
        }
    </style>
    

</head>


</head>


<body>
<div class="container">
<div class="header_holder">
<div class="logo"><img src="../../include/images/logo.png"></div>
</div>
<div id='cssmenu'></div>
</div>
<div class="container">
<div class="slider_holder">
  <img src="../../include/images/banner.jpg">
</div>
</div>
<div class="container">
<div class="content_area">
<div class="menu_holder"> </div>
<div class="content_holder">

           
<body>
<form name="frm" id="frm" method="post"action="">
 
 <fieldset><legend style="font-weight: 700; text-align: center; font-size: large;">Enter Your Card Details</legend>
    <table class="auto-style1">
       <?php
        if($row2['payment_status']!='1'){?>
        <tr>
          <td>&nbsp;</td>
          <td class="auto-style18">&nbsp;</td>
          <td style="vertical-align:middle;">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="auto-style18">Choose your card type</td>
            <td style="vertical-align:middle;"> <input type="radio" id="rdlcard" runat="server"  value="Visa"  
                    name="rdlcard"  Width="57px" CssClass="style5" />
          <img alt="" class="auto-style19" src="Images/1391796960_payment_method_card_visa.png" />&nbsp;&nbsp; <input type="radio" " runat="server" value="Master Card" 
                    name="rdlCard"  Width="108px" CssClass="style5" 
                   /><img alt="" class="auto-style19" src="Images/1391796956_payment_method_master_card.png" /></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="auto-style18">Enter your card number</td>
            <td>
                <input type="text" name="txt1" ID="TextBox1" runat="server" ontextchanged="TextBox1_TextChanged" Width="240px" required/>
                 
                
            </td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="auto-style18">Enter 4 digit Confirmation PIN</td>
            <td>
                <p>
                  <input type="text"  name="txt2" runat="server" CssClass="style4" OnTextChanged="TextBox2_TextChanged" $pattern = "/^\d{4}/" required onblur="checknum(this.value)";/>
                </p>
                 
                
            </td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="auto-style26">&nbsp;</td>
            <td>
                <input type="checkbox" name="chkAccept" ID="CheckBox1" runat="server" CssClass="auto-style25" />
                <span class="auto-style25">&nbsp;I Accept the Terms &amp; Conditions</span></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="auto-style23">&nbsp;</td>
            <td>
                <ID="Label1" runat="server" ForeColor="Red">
            </td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="auto-style23">&nbsp;</td>
            <td>
                <input type="submit" name="btnsub" id="btnsub" value="Submit" />
            </td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="auto-style23">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td class="auto-style21"></td>
            <td class="auto-style24"></td>
            <td class="auto-style21"></td>
            <td class="auto-style21"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="auto-style23">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="auto-style23">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="auto-style23">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="auto-style23">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td class="auto-style23">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="auto-style23">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="auto-style23">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="auto-style23">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </table>
    <?php
		}?>
        </fieldset>
        
</form>
</body>
</html>

<?php

include("footer.php");
?>