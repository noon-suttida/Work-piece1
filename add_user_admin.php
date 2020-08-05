<!DOCTYPE html>
<?php
    session_start();
  if($_SESSION['userid'] == "")
  {
      echo "Please Login!";
      exit();
  }

  if($_SESSION['status'] != "ADMIN")
  {
      echo "This page for Admin only!";
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
body{
  background-color:chocolate;
  color:white;
}
  input[type=text],[type=password]{
    width: 70%;
    padding: 5px 5px;
    margin: 3px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }
  input[type=submit]{
    width: 15%;
    padding: 5px 5px;
    margin: 3px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    background-color:rgb(255, 125, 125);
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
  <div class="w3-container w3-display-container w3-padding-16" style="" >
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <h1 class="w3-wide" style="color:coral;"><b>NAMTAN FOOD</b></h1>
  </div>
  <div class="w3-large" style="font-weight:bold;">
    <a href="edit_profile_admin.php" class="w3-bar-item w3-button" style="text-decoration: none;"><font face="FC Lamoon">Welcome <?php echo $objResult["fname"];?></font></a>
    <a href="home_admin.php" class="w3-bar-item w3-button"><font face="FC Lamoon">รายการสั่งซื้อ</font></a>
    <a href="show_products_admin.php" class="w3-bar-item w3-button"><font face="FC Lamoon">รายการอาหาร</font></a>
    <a href="show_status_food_admin.php" class="w3-bar-item w3-button"><font face="FC Lamoon">สถานะอาหาร</font></a>
    <a href="show_user_admin.php" class="w3-bar-item w3-button"><font face="FC Lamoon">สมาชิก</font></a>
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
  <header class="w3-container w3-xlarge" style="margin:5px 0">
  </header>
  <form id="form2" name="form2" action="save_user_admin.php" method="post">
        <table border="0" width="99%" style="margin: 3px 0; padding: 5px 25px;">
            <thead>
                <tr>
                    <th colspan="2"><h2><font face="FC Lamoon">เพิ่มสมาชิก</font></h2></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ชื่อผู้ใช้ </td>
                    <td>: <input type="text" name="txtUsername" id="txtUsername"/><br></td>
                </tr>
                <tr>
                    <td>รหัสผ่าน </td>
                    <td>: <input type="password" name="txtPassword" id="txtPassword"/><br></td>
                </tr>
                <tr>
                    <td>ยืนยัน รหัสผ่าน</td>
                    <td>: <input name="txtConPassword" type="password" id="txtConPassword">
                    </td>
                </tr>
                <tr>
                    <td>ชื่อ </td>
                    <td>: <input type="text" name="txtfname" id="txtfname"/><br></td>
                </tr>
                <tr>
                    <td>นามสกุล </td>
                    <td>: <input type="text" name="txtlname" id="txtlname"/><br></td>
                </tr>
                <tr>
                    <td>เบอร์โทรศัพท์ </td>
                    <td>: <input type="text" name="txttel" id="txttel"/></td>
                </tr>
                <tr>
                    <td>บ้านเลขที่ </td>
                    <td>: <input type="text" name="txthouse_no" id="txthouse_no"/><br></td>
                </tr>
                <tr>
                    <td>หมู่บ้าน </td>
                    <td>: <input type="text" name="txtvillage" id="txtvillage"/><br></td>
                </tr>
                <tr>
                    <td>หมู่ที่ </td>
                    <td>: <input type="text" name="txtvillage_no" id="txtvillage_no"/><br></td>
                </tr>
                <tr>
                    <td>ซอย </td>
                    <td>: <input type="text" name="txtlane" id="txtlane"/><br></td>
                </tr>
                <tr>
                    <td>ถนน </td>
                    <td>: <input type="text" name="txtroad" id="txtroad"/><br></td>
                </tr>
                <tr>
                    <td>ตำบล </td>
                    <td>: <input type="text" name="txtsubdistrict" id="txtsubdistrict"/><br></td>
                </tr>
                <tr>
                    <td>อำเภอ </td>
                    <td>: <input type="text" name="txtdistrict" id="txtdistrict"/><br></td>
                </tr>
                <tr>
                    <td>จังหวัด </td>
                    <td>: <select name="txtprovince" id="txtprovince">
                    <option selected ="true" value="" disabled="disabled">จังหวัด</option>
                    <option value="" disabled="disabled">-----</option>
                    <option value="นครราชสีมา">นครราชสีมา</option>
                    <option value="สระบุรี">สระบุรี</option>
                    <option value="ชลบุรี">ชลบุรี</option>
                    <option value="ลพบุรี">ลพบุรี</option>
                    <option value="ตาก">ตาก</option>
                    <option value="ขอนแก่น">ขอนแก่น</option>
                    <option value="กรุงเทพฯ">กรุงเทพฯ</option>
                    <option value="อยุธยา">อยุธยา</option>
                    <option value="อุบล">อุบล</option>
                    <option value="เชียงใหม่">เชียงใหม่</option>
                    <option value="เชียงราย">เชียงราย</option>
                    <option value="สมุทปราการ">สมุทปราการ</option>
                    <option value="สมุทรสาคร">สมุทรสาคร</option>
                    <option value="เพรชบุรี">เพรชบุรี</option>
                    <option value="ยะลา">ยะลา</option>
                    <option value="ลำปาง">ลำปาง</option>
                    <option value="สงขลา">สงขลา</option>
                    <option value="ระยอง">ระยอง</option>
                    <option value="ระนอง">ระนอง</option>
                    <option value="ปัตตานี">ปัตตานี</option>
                </select></td>
                </tr>
                <tr>
                    <td>เพศ </td>
                    <td>: <input type="radio" name="txtgender" id="txtgender" value="ชาย"/> ชาย 
                    <input type="radio" name="txtgender" id="txtgender" value="หญิง"/> หญิง<br>
                    </td>
                </tr>
                <tr>
                    <td>อีเมล์ </td>
                    <td>: <input type="text" name="txtemail" id="txtemail"/><br></td>
                </tr>
                <tr>
                    <td>Status </td>
                    <td>: <select name="ddlStatus" id="ddlStatus">
                    <option value="ADMIN">ADMIN</option>
                    <option value="USER">USER</option>
                </select></td>            
                <tr>
                    <td colspan="2" align="center"><br><input type="submit" value="สมัคร"></td>
                </tr>                
                </tr>
            </tbody>
        </table>
    </form> <br>

    <div class="w3-black w3-center w3-padding-24" >Powered by Piyarat, Arthit, Chartchai, Suttida</div>
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
