<?php
session_start();
// التحقق من السيشن
if (!isset($_SESSION['LoginUser']) && $_SESSION['LoginUser'] == "") {
		header("Location: http://localhost/StudentHousing/Sign_in_up/Sign_in_up.php");
}

require_once('../db.php');


?>
<!DOCTYPE html>
<html>
<title> ارسال شـكوى</title>
    <head>
        <meta charset="UTF-8">

        <!-- Internet Explorer compatibility -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- First mobile meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
         <script src="../js/html5shiv.min.js"></script>
         <script src="../js/respond.min.js"></script>
        <![endif]-->
    <!-- GOOGLE FONT-->
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Changa" rel="stylesheet">

    <!-- GOOGLE FONT-->
              <link rel="stylesheet" href="../css/bootstrap.css">
              <link rel="stylesheet" href="../css/bootstrap-rtl.css">
              <link rel="stylesheet" type="text/css" href="../css/show-apartment.css">
              <link rel="stylesheet" href="../css/w4.css">
              <link rel="stylesheet" href="../css/dashboard.css">

        <title></title>
    </head>
    <body style="background-color:#D8DCF8">



               <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#" > <font size="6" face="cairo" color="white">سكن جامعة طيبة</font></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <form action="../Sign_in_up/logout.php" method="post" class="navbar-form navbar-right">
                        <input type="submit" class="btn btn-danger" value="تسجيل الخروج" />
                    </form>
                </div>
            </div>
        </nav>

<div class="color_forside w3-sidebar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="rightMenu">
    <button onclick="closeRightMenu()" class=" w3-bar-item w3-button w3-large icon-bar w3-border" >إغلاق

        &times;</button>
    <!--SIDE BAR CONATINS-->
	

	<font face="cairo" size="3">
    <a href="../modifyStudentInfo.php"class="text w3-bar-item w3-button  ibrahim ">تعديل بيانات الطلاب</a>

    <a href="../index.php"class="text w3-bar-item w3-button  ibrahim w3-border ">حجز شقة</a>
    <a href="../cancel-booking.php" class="w3-bar-item w3-button  w3-border ">الغاء حجز الشقة</a>
    <a href="../request-cancel-booking.php" class="w3-bar-item w3-button  w3-border">طلب تغيير الشقة</a>
    <a href="../rate/apartment-info.php" class="w3-bar-item w3-button  w3-border">بيانات الشقة</a>
    <a href="../rate/rate.php" class="w3-bar-item w3-button alignright  ul.b w3-border">تقييم الشقة</a>
    <a href="../complaint/Complaint.php" class="w3-bar-item w3-button  w3-border">إرسال شكوى</a>
    <a href="../complaint/complaint-view.php" class="w3-bar-item w3-button  w3-border">عرض الشكوى</a>
	
	</font>

    </ul>
</div>

<font face="Changa">
<div class="icon-bar w3-teal">
    <button class=" w3-button w3-teal w3-xlarge w3-right " onclick="openRightMenu()"style="color: #000000!important;">&#9776;</button>

    <div class="w3-container" style="background-color:#D8DCF8">

                
                <div class="col-sm-9 col-sm-offset-3 col-md-8 col-md-offset-2 ">
                    <h1 class="page-header"><font face="changa">ارسال شكوى</font></h1>

					     <div class="form-group" >

                <label for="inputsm">الشكوى</label>
				
				<form action="insertValue.php" method="post"  >
				<input type="hidden" name="from" value="SendReport">
                <textarea class="form-control input-lg"  name="textarea1" >
				
				</textarea>
				
				</br>
				
				<input type="submit" value="ارسال الشكوى" class="btn btn-primary" >  
				
				
				</form>
				

				


            </div>


                </div>
            </div>
        </div>
</font>



        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/dashboard.js"></script>
        <script>
                                    function openRightMenu() {
                                        document.getElementById("rightMenu").style.display = "block" ;
                                    }

                                    function closeRightMenu() {
                                        document.getElementById("rightMenu").style.display = "none";
                                    }

            </script>
    </body>
</html>
