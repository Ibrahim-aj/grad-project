<?php
session_start();
// التحقق من السيشن
if (!isset($_SESSION['LoginUser']) && $_SESSION['LoginUser'] == "") {
		header("Location: http://localhost/StudentHousing/Sign_in_up/Sign_in_up.php");
}

require_once('db.php');
require_once('studentsAPI.php');
require_once('apartmentAPI.php');
require_once ('bookingAPI.php');
require_once('manager/studentHousingAPI.php');
//التحقق من بداية ونهاية الحجوزات
$can_booking = sh_studenthousing_check_can_booking();
    
sh_bookings_check_booking_expiration();
$student = sh_student_get_by_user_id("{$_SESSION['LoginUser']}");
$booking = sh_bookings_get_by_student_id($student->student_id);
$student_has_booking = sh_bookings_check_cancel_booking($student->student_id);

if($student_has_booking == FALSE)
    $apartment = sh_apartments_get_by_id($booking->apartment_id);

sh_db_close();

?>
<!DOCTYPE html>
<html>
<title>الغاء حجز شقة  </title>
    <head>
        <meta charset="UTF-8">

        <!-- Internet Explorer compatibility -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- First mobile meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
         <script src="js/html5shiv.min.js"></script>
         <script src="js/respond.min.js"></script>
        <![endif]-->
    <!-- GOOGLE FONT-->
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Changa" rel="stylesheet">

    <!-- GOOGLE FONT-->
              <link rel="stylesheet" href="css/bootstrap.css">
              <link rel="stylesheet" href="css/bootstrap-rtl.css">
              <link rel="stylesheet" type="text/css" href="css/show-apartment.css">
              <link rel="stylesheet" href="css/w4.css">
              <link rel="stylesheet" href="css/dashboard.css">

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
                    <form action="Sign_in_up/logout.php" method="post" class="navbar-form navbar-right">
                        <input type="submit" class="btn btn-danger" value="تسجيل الخروج" />
                    </form>
                </div>
            </div>
        </nav>

		<font face="Changa">
<div class="color_forside w3-sidebar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="rightMenu">
    <button onclick="closeRightMenu()" class=" w3-bar-item w3-button w3-large icon-bar w3-border" >إغلاق

        &times;</button>
    <!--SIDE BAR CONATINS-->
 <a href="modifyStudentInfo.php"class="text w3-bar-item w3-button  ibrahim ">تعديل بيانات الطلاب</a>


    <?php 
    if($can_booking)
        echo "<a href=\"index.php\"class=\"text w3-bar-item w3-button  w3-border  \">حجز شقة</a>";
    ?>
    <a href="cancel-booking.php" class="w3-bar-item w3-button  w3-border">الغاء حجز الشقة</a>
    <a href="request-cancel-booking.php" class="w3-bar-item w3-button  w3-border">طلب تغيير الشقة</a>
    <a href="rate/apartment-info.php" class="w3-bar-item w3-button  w3-border">بيانات الشقة</a>
    <a href="rate/rate.php" class="w3-bar-item w3-button alignright  ul.b w3-border">تقييم الشقة</a>
    <a href="complaint/Complaint.php" class="w3-bar-item w3-button  w3-border">إرسال شكوى</a>
    <a href="complaint/complaint-view.php" class="w3-bar-item w3-button  w3-border">عرض الشكوى</a>

</div>


<div class="icon-bar w3-teal">
    <button class=" w3-button w3-teal w3-xlarge w3-right " onclick="openRightMenu()"style="color: #000000!important;">&#9776;</button>

    <div class="w3-container" style="background-color:#D8DCF8">

                
                <div class="col-sm-9 col-sm-offset-3 col-md-8 col-md-offset-2 ">
                    <h1 class="page-header"><font face="changa">إلغاء الحجز</font></h1>

                <!-- بداية رسائل الاخطاء والعمليات الناجحة -->

                <?php 

                  if (!empty($_SESSION['has_booking_for_cancel'])) {
                    echo "<div class=\"alert alert-danger\" role=\"alert\">{$_SESSION['has_booking_for_cancel']}</div>";
                    unset($_SESSION['has_booking_for_cancel']);
                  }
                  if (!empty($_SESSION['booking_is_paid'])) {
                    echo "<div class=\"alert alert-danger\" role=\"alert\">{$_SESSION['booking_is_paid']}</div>";
                    unset($_SESSION['booking_is_paid']);
                  }
                  if (!empty($_SESSION['cancel_booking_successful'])) {
                    echo "<div class=\"alert alert-success\" role=\"alert\">{$_SESSION['cancel_booking_successful']}</div>";
                    unset($_SESSION['cancel_booking_successful']);
                  }


                ?>
                <!-- نهاية رسائل الاخطاء والعمليات الناجحة -->
                <?php
                if($student_has_booking == FALSE){
                    echo "<form class=\"form-cancel-book-apartment\" action=\"deleteBooking.php\" method=\"post\">";
                    echo    "<div class=\"card w-75\">";
                    echo        "<div class=\"card-block\">";
                    echo            "<h3 class=\"card-title\">رقم الشقة<font face=\"Changa\">  $apartment->apartment_id</font></h3>";
                    echo            "<p class=\"card-text\">";
                    echo            "<ul class=\"list-unstyled\">";
                    echo                "<li><h5><font face=\"Changa\">عدد الاشخاص الحالي:$apartment->current_number_of_students</font></h5></li>";
                    echo                "<li><h5>عدد الاشخاص الحالي:$apartment->max_number_of_students</h5></li>";
                    echo "<img src=\"img/ap.jpg\" class=\"img-responsive\" style=\"width:25%\" >";
                    echo           "</ul>";
                    echo        "</p>";
                    echo            "<button type=\"submit\" class=\"btn btn-primary\">الغاء الحجز</button>";
                    echo        "</div>";
                    echo    "</div>";
                    echo "</form>";
                }
                else{
                    echo "ليس لديك حجز";
                }
                ?>
                </div>
            </div>
        </div>
</font>



        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/dashboard.js"></script>
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
