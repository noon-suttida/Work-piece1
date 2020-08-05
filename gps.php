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
<style>
  input[type=text],[type=password]{
    width: 50%;
    padding: 5px 5px;
    margin: 3px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;;
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
  <header class="w3-container w3-xlarge">
    <p class="w3-right">  
      <a href="cart.php"><i class="fa fa-shopping-cart w3-margin-right"></i></a>
    </p>
  </header>


  <?php
  error_reporting( error_reporting() & ~E_NOTICE );
    $userid = $_REQUEST["ID"];
    $strSQL = "SELECT * FROM user WHERE userid='$userid'";
    extract($objResult);
  ?>
  <form name="user" method="POST" action="save_gps_user.php" id="user">
  <h2 align="center"> <font face="FC Lamoon">แก้ไข ที่อยู่ปัจจุบัน</font></h2>
  <br>
  <table border="0" style="width:60%" align="center">
    <tbody>
    <input type="hidden" name="userid" value="<?php echo $userid;?>">
      <tr>
        <td width="30%">บ้านเลขที่</td>
        <td>: <input name="house_no" type="text" required id="house_no" value="<?=$house_no;?>"></td>
      </tr>
      <tr>
        <td>หมู่บ้าน</td>
        <td>: <input name="village" type="text" required id="village" value="<?=$village;?>"></td>
      </tr>
      <tr>
        <td>หมู่ที่</td>
        <td>: <input name="village_no" type="text" required id="village_no" value="<?=$village_no;?>"></td>
      </tr>
      <tr>
        <td>ซอย</td>
        <td>: <input name="lane" type="text" required id="lane" value="<?=$lane;?>"></td>
      </tr>
      <tr>
        <td>ถนน</td>
        <td>: <input name="road" type="text" required id="road" value="<?=$road;?>"></td>
      </tr>
      <tr>
        <td>ตำบล</td>
        <td>: <input name="sub_district" type="text" required id="sub_district" value="<?=$sub_district;?>"></td>
      </tr>
      <tr>
        <td>อำเภอ</td>
        <td>: <input name="district" type="text" required id="district" value="<?=$district;?>"></td>
      </tr>
      <tr>
        <td>จังหวัด</td>
        <td>: <select name="province" required id="province">
                    <option selected ="true" value="นครราชสีมา">นครราชสีมา</option>
                </select><br>
                <div style="color:red">*ภายในจังหวัดนครราชสีมาเท่านั้น</div></td>
      </tr>
      <tr>
        <td>ระบุลักษณะสถานที่อย่างชัดเจน</td>
        <td>: <input name="description" type="text" required id="description" value="<?=$description;?>"></td>
      </tr>
      <tr>
        <td>เบอร์โทรศัพท์</td>
        <td>: <input name="tel" type="text" required id="tel" value="<?=$tel;?>"></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="Submit" value="Save"></td>
      </tr>
    </tbody>
  </table>


  <!-- Footer -->
  <footer class="w3-padding-64 w3-pale-yellow w3-small w3-center" id="footer">
    <div class="w3-row-padding">
    <div class="w3-center w3-padding-24"  style="background-color:coral;" >Powered by Piyarat, Arthit, Chartchai, Suttida</div>
      </div>
    </div>
  </footer>
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
