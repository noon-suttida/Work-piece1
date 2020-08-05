<!DOCTYPE html>
<?php
  include("connect.php");
  mysqli_query($objCon,"SET NAMES UTF8");
  session_start();
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
    width: 99%;
    padding: 5px 5px;
    margin: 3px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }
  input[type=submit]{
    background-color:coral;
    color:white;
    padding:4px 9px;
    margin: 5px 0;
    border-radius: 10px;
    cursor: pointer;
    
  }
.w3-sidebar a {font-family: "Roboto", sans-serif}
body,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
h1{
  font-size:50px;
}
</style>
<script>
  function btn(){
            alert("กรุณาเข้าสู่ระบบเพื่อสั่งอาหารของคุณ");
        }
</script>
<body class="w3-content" style="max-width:100%">

<!-- Sidebar/menu -->

<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:300px;" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16" style="background-color:;" >
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <div align="center"><img src="img/band.png" alt="" width="50%" ></div>
    <h1 class="w3-wide" style="color:coral;"><b>NAMTAN FOOD</b></h1>
  </div>
  <div class="w3-large w3-text-grey" style="font-weight:bold; background-color:;">

    <!-- LOGIN -->
    <form name="form1" method="post" action="check_login.php">
    <table style="width: 90%" align="center">
      <thead>
        <tr>
          <td align="center" style="font-weight:bold; color:white; padding:5px; box-sizing:border-box; background:coral;" >LOGIN</td>
        </tr>
      </thead>
      <tbody align="center">
        <tr>
          <td>
            <input name="txtUsername" type="text" id="txtUsername" placeholder="Username">
          </td>
        </tr>
        <tr>
          <td><input name="txtPassword" type="password" id="txtPassword" placeholder="Password">
          </td>
        </tr>
      </tbody>
    </table>
    <div align="center" ><input type="submit" name="Submit" value="Login"></div>
    <div align="center"> <h3> <a href="register.php" style="text-decoration: none;" ><font face="FC Lamoon">สมัครสมาชิก?</font></a></h3><br></div>
    </form>       
  </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
  <div class="w3-bar-item w3-padding-24 w3-wide" >NAMTAN FOOD</div>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>
  
  <!-- Top header -->
  <header class="w3-container">
    <p class="w3-right">   
      <!-- <i class="fa fa-shopping-cart w3-margin-right"></i>
      <i class="fa fa-search"></i> -->
      
    </p>
  </header>

  <!-- Image header -->
  <div class="w3-display-container w3-container">
    <img src="img/bg1.jpg" style="width:100%">
    <div class="w3-display-topleft w3-text-white" style="padding:24px 48px">
      <h1 class="w3-jumbo w3-hide-small" style="color:white;text-shadow: 4px 3px black;"><b>NAMTAN FOOD</b></h1>
      <h1 class="w3-hide-large w3-hide-medium">New arrivals</h1>
      <p class="w3-hide-small" style="color:black;font-size:50px;text-shadow: 1px 1px rgb(250, 250, 250);">DELIVERY</p>
      <h1><font face="FC Lamoon" style="color:white;">" เ ข้ า สู่ ร ะ บ บ เ พื่ อ สั่ ง อ า ห า ร ข อ ง คุ ณ "</font></h1>
    </div>
  </div>

  <div class="w3-container w3-text-grey" id="jeans">
    <p>แนะนำ</p>
  </div>

  <!-- Product grid -->
  <div>
  <?php 
  $sql = "SELECT * FROM products WHERE ProductID = '000000016' OR ProductID = '000000028' OR ProductID = '000000021' OR ProductID = '000000013'   ";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($objCon, $sql);  
  ?>
    
    <?php while($row = mysqli_fetch_array($result)) { ?>
      <div class="w3-container w3-col s3">
        <div class="w3-display-container"><br>
          <?php echo "<img src='pd_img/".$row['pd_img']."' width='100%'>";?>
          <div class="w3-display-middle w3-display-hover">
            <button class="w3-button w3-amber" onclick="btn();">Buy now <i class="fa fa-shopping-cart"></i></button>
          </div>
        </div>
        <p><?php echo $row["pd_name"];?><br><b><?php echo $row["pd_price"];?> บาท</b></p>
      </div>
    <?php } ?>
    </div>
  
  <!-- Footer -->
  <footer class="w3-padding-64 w3-small w3-center" id="footer">
    <div class="w3-row-padding">
    </div>
  </footer>

  <div class="w3-center w3-padding-24" style="background-color:coral;">Powered by Piyarat, Arthit, Chartchai, Suttida</div>

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
