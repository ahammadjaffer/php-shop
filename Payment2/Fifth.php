<?php
	session_start();
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_mywork',$connect);
	
	//To select from Cart, Cart head, Items
	$selCartQuery = "select * from tbl_cart c inner join tbl_carthead ch on c.userId=ch.userId inner join tbl_items i on c.itemId=i.itemId where ch.chStatus = 0 and c.cartStatus = 0 and c.userId='".$_SESSION['loggedInId']."'";
	
	$selCartResp = mysql_query($selCartQuery) or die ("cannot connect");
	$rowp = mysql_fetch_array($selCartResp);
	$ctp = $rowp['itemTotal'];
	$chTP = $rowp['chGrandtotal'];
	
	//To calculate new cartHead total Price
	$chTP=$chTP-$ctp;
	
	//date and time
	$date=date("d.m.y");
	date_default_timezone_set("Asia/Kolkata");
	$time=date("h:i:sa");
	
  ob_start();
  if(isset($_POST['btnsub']))
  {
	  	//To Update table cart
		$upQuery = "update tbl_cart set cartStatus = 1 where userId='".$_SESSION['loggedInId']."' and cartId='".$_SESSION['crtId']."'";
  		mysql_query($upQuery);
		
		//To update table cartHead
		$updateCHQuery = "update tbl_carthead set chGrandtotal = '".$chTP."' where userId = '".$_SESSION['loggedInId']."'";
  		mysql_query($updateCHQuery);
		
		//If a single row is purchased, that row is entered to table cart head
		$insertCHQuery = "insert into tbl_carthead (userId,chDate,chTime,chStatus,chGrandTotal) value ('".$_SESSION['loggedInId']."','".$date."','".$time."',1,'".$ctp."')";
		mysql_query($insertCHQuery);
		
		header('location:../User/CartPage.php');
  }
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <style type="text/css">
        .auto-style18 {
            height: 35px;
        }
        .auto-style21 {
            height: 39px;
        }
        .auto-style24 {
            width: 50px;
            height: 30px;
        }
        .auto-style28 {
            width: 34px;
            height: 27px;
        }
        .auto-style29 {
            height: 55px;
        }
        .auto-style30 {
            text-align: right;
            font-weight: 700;
            width: 422px;
            height: 29px;
        }
        .auto-style32 {
            height: 29px;
        }
        .auto-style33 {
            text-align: right;
            font-weight: 700;
            width: 422px;
            height: 30px;
        }
        .auto-style35 {
            height: 30px;
        }
        .auto-style36 {
            text-align: right;
            font-weight: 700;
            width: 422px;
            height: 32px;
        }
        .auto-style38 {
            height: 32px;
        }
        .auto-style39 {
            height: 108px;
        }
        .auto-style40 {
            height: 29px;
            width: 11px;
        }
        .auto-style41 {
            height: 30px;
            width: 11px;
        }
        .auto-style42 {
            height: 32px;
            width: 11px;
        }
    </style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form name="frm" id="frm" method="post">
<script type="text/javascript">
 <!--
    function printPartOfPage(elementId) {
        var printContent = document.getElementById(elementId);
        var windowUrl = 'about:blank';
        var uniqueName = new Date();
        var windowName = 'Print' + uniqueName.getTime();
        var printWindow = window.open(windowUrl, windowName, 'left=50000,top=50000,width=0,height=0');

        printWindow.document.write(printContent.innerHTML);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    }
    // -->
    </script>
    <div id="printablediv"><fieldset><legend style="text-align: center; font-weight: 700">Payment Details</legend>
       
        <table class="auto-style1">
            <tr>
                <td class="auto-style29"></td>
                <td style="text-align: right" class="auto-style29">
                    <asp:LinkButton ID="LinkButton1" runat="server" OnClientClick="JavaScript: printPartOfPage('printablediv');" Font-Underline="False" ForeColor="White"> <img alt="" class="auto-style28" src="Icons/1391813769_printer.png" /></asp:LinkButton>
                   </td>
                <td class="auto-style29"></td>
            </tr>
            <tr>
                <td class="auto-style18"></td>
                <td class="auto-style18" style="text-align: center; color: #3399FF">Payment Success...</td>
                <td class="auto-style18"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <table class="auto-style1">
                        <tr>
                            <td class="auto-style30">Merchant</td>
                            <td class="auto-style40"></td>
                            <td class="auto-style32">
                                &nbsp;<input type="text"  runat="server" value="<?php echo $_SESSION['shopName'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-style33">Date</td>
                            <td class="auto-style41"></td>
                            <td class="auto-style35">
                                &nbsp;<input type="text"  runat="server" value="<?php echo date("Y-m-d");?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-style36">Amount</td>
                            <td class="auto-style42"></td>
                            <td class="auto-style38">
                                Rs.<input type="text" runat="server" value="<?php echo $_SESSION['totalPrice'];?>"/>
                                <strong>/-</strong></td>
                        </tr>
                        <tr>
                            <td class="auto-style36">Transaction ID</td>
                            <td class="auto-style42"></td>
                            <td class="auto-style38">&nbsp; <input type="text" runat="server" value=<?php echo rand(10000,10000000);?>>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="auto-style21" style="text-align: center">
                                <input type="submit" runat="server" Text="Continue" name="btnsub" Width="108px" OnClick="Button1_Click" style="font-weight: 700"  />
                            </td>
                        </tr>
                    </table>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="auto-style39"></td>
                <td style="text-align: center" class="auto-style39">&nbsp;&nbsp;&nbsp;
                    <img alt="" class="auto-style24" src="Icons/1391813453_mastercard1.gif" />
                    <img alt="" class="auto-style24" src="Icons/1391813456_visa2.gif" />
                    <img alt="" class="auto-style24" src="Icons/1391813466_westernunion.gif" />
                    <img alt="" class="auto-style24" src="Icons/1391813469_cirrus1.gif" />
                    <img alt="" class="auto-style24" src="Icons/1391813513_visa1.gif" /></td>
                <td class="auto-style39"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
       
    </fieldset></div>
    </form>
</body>
</html>