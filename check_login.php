<?php
	session_start();
    include("connect.php");

	$strSQL = "SELECT * FROM user WHERE username = '".mysqli_real_escape_string($objCon,$_POST['txtUsername'])."' and password = '".mysqli_real_escape_string($objCon,$_POST['txtPassword'])."'";
	$objQuery = mysqli_query($objCon,$strSQL);
	$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
	if(!$objResult)
	{
			echo "username and password Incorrect!";
	}
	else
	{
			$_SESSION["userid"] = $objResult["userid"];
			$_SESSION["status"] = $objResult["status"];

			session_write_close();
			
			if($objResult["status"] == "ADMIN")
			{
				header("location:home_admin.php");
			}
			else
			{
				header("location:home_user.php");
			}
	}
	mysqli_close($objCon);
?>