<!DOCTYPE html>
<?php
  session_start();
	    if($_SESSION['userid'] == "")
	    {
		    echo "Please Login!";
		    exit();
	    }

	    if($_SESSION['status'] != "USER")
	    {
		    echo "Welcome User";
		    exit();
	    }	

      include("connect.php");
      mysqli_query($objCon,"SET NAMES UTF8");
	    $strSQL = "SELECT * FROM user WHERE userid = '".$_SESSION['userid']."' ";
	    $objQuery = mysqli_query($objCon,$strSQL);
	    $objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
?> 
<html>
<title>Namtan food</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<style>
  input[type=text],[type=password]{
    width: 60%;
    padding: 1px 1px;
    margin: 6px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 15px;
    box-sizing: border-box;;
  }
  input[type=submit]{
    width: 30%;
    padding: 1px 1px;
    margin: 3px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 15px;
    box-sizing: border-box;
    background-color:coral;
    color:white;
  }
.w3-sidebar a {font-family: "Roboto", sans-serif}
body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
a{
  font-size:25px;
}

</style>
<body class="w3-content" style="max-width:100%">

<!-- Sidebar/menu -->

<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:300px;" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16" style="background-color:;" >
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <h1 class="w3-wide" style="color:coral;"><b>NAMTAN FOOD</b></h1>
  </div>
  <div class="w3-large" style="font-weight:bold">
    <a href="edit_profile_user.php" class="w3-bar-item w3-button" style="text-decoration: none;"><font face="FC Lamoon">ยินดีต้อนรับ คุณ <?php echo $objResult["fname"];?></font></a>
    <a href="home_user.php" class="w3-bar-item w3-button"><font face="FC Lamoon">หน้าแรก</font></a>
    <a href="menu.php" class="w3-bar-item w3-button"><font face="FC Lamoon">เมนู</font></a>
    <a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align"><font face="FC Lamoon">
      ประเภทอาหาร </font> <i class="fa fa-caret-down"></i>
    </a>
    <div id="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium">
      <a href="jandioa.php" class="w3-bar-item w3-button"><font face="FC Lamoon">อาหารจานเดียว</font></a>
      <a href="gubkao.php" class="w3-bar-item w3-button"><font face="FC Lamoon">กับข้าว</font></a>
      <a href="kiangduem.php" class="w3-bar-item w3-button"><font face="FC Lamoon">เครื่องดื่ม</font></a>
      <a href="kongwan.php" class="w3-bar-item w3-button"><font face="FC Lamoon">ของหวาน</font></a>
    </div>
    <a href="status_food_user.php?ID=<?php echo $objResult["userid"];?>" class="w3-bar-item w3-button"><font face="FC Lamoon">สถานะอาหารของคุณ</font></a>
    <a href="gps.php" class="w3-bar-item w3-button"><font face="FC Lamoon">ระบุตำแหน่งปัจจุบัน</font></a>
    <div align="center" ><a href="logout.php" class="w3-button w3-black w3-padding-large w3-large" style="border-radius: 25px; width:60%;margin: 15px 0;">LOGOUT</a></div>
    
  </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
  <div class="w3-bar-item w3-padding-24 w3-wide">NAMTAN FOOD</div>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>
  
  <!-- Top header -->

  <!-- Product grid -->

<?php

if(!isset($_SESSION["intLine"]))
{
	echo "Cart Empty";
	exit();
}

if (!$objCon) {
    echo $objCon->connect_error;
    exit();
}
?>
<div align="right"><?php  $objResult["userid"];?></div>
<table width="100%"  border="0" align="center">
  <tr style="background-color:coral">
    <td width="101">รหัสอาหาร</td>
    <td width="82">ชื่ออาหาร</td>
    <td width="82">ราคา</td>
    <td width="79">จำนวน</td>
    <td width="79">ราคารวม</td>
    <td width="10">ลบ</td>
  </tr>
  <?php
  $Total = 0;
  $SumTotal = 0;

  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["strProductID"][$i] != "")
	  {
		$strSQL = "SELECT * FROM products WHERE ProductID = '".$_SESSION["strProductID"][$i]."' ";
		$objQuery = mysqli_query($objCon,$strSQL);
		$objResult = $objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
		$Total = $_SESSION["strQty"][$i] * $objResult["pd_price"];
		$SumTotal = $SumTotal + $Total;
	  ?>
	  <tr>
    
		<td><?=$_SESSION["strProductID"][$i];?></td>
		<td><?=$objResult["pd_name"];?></td>
		<td><?=$objResult["pd_price"];?></td>
		<td><?=$_SESSION["strQty"][$i];?></td>
		<td><?=number_format($Total,2);?></td>
		<td ><a href="delete.php?Line=<?=$i;?>"><i class='fas fa-trash'></i></a></td>
	  </tr>
	  <?php
	  }
  }
  ?>
  <tr>
	<td colspan="6" align="right" style="background-color:coral">Sum Total <?php echo number_format($SumTotal,2);?></td>
  </tr>
</table>
<br>
<?php
	if($SumTotal > 0)
	{
?>
	<div align="center"><button class="w3-button w3-amber" onclick="btn();"><a href="checkout.php" style="text-decoration: none;"> <font face="FC Lamoon">ยืนยันการสั่งซื้อ</font></a></button><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div>
<?php
	}
?>
<?php
mysqli_close($objCon);
?>
    

  <!-- Footer -->

    <div  class="w3-center w3-padding-24"  style="background-color:coral;" >Powered by Piyarat, Arthit, Chartchai, Suttida</div>


  <!-- End page content -->
</div>

<!-- Newsletter Modal -->
<div id="newsletter" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom" style="padding:32px">
    <div class="w3-container w3-white w3-center">
      <i onclick="document.getElementById('newsletter').style.display='none'" class="fa fa-remove w3-right w3-button w3-transparent w3-xxlarge"></i>
      <h2 class="w3-wide">NEWSLETTER</h2>
      <p>Join our mailing list to receive updates on new arrivals and special offers.</p>
      <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail"></p>
      <button type="button" class="w3-button w3-padding-large w3-red w3-margin-bottom" onclick="document.getElementById('newsletter').style.display='none'">Subscribe</button>
    </div>
  </div>
</div>

<script>
// Accordion 
function myAccFunc() {
  var x = document.getElementById("demoAcc");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}

// Click on the "Jeans" link on page load to open the accordion for demo purposes
document.getElementById("myBtn").click();


// Open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>

