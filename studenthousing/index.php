<?php

session_start();
// التحقق من السيشن
if (!isset($_SESSION['LoginUser']) && $_SESSION['LoginUser'] == "") {
		header("Location: http://localhost/StudentHousing/Sign_in_up/Sign_in_up.php");
}


require_once('db.php');
require_once('apartmentAPI.php');
require_once('manager/studentHousingAPI.php');
require_once('bookingAPI.php');
 
//التحقق من بداية ونهاية الحجوزات
$can_booking = sh_studenthousing_check_can_booking();

sh_bookings_check_booking_expiration();

$apartments = sh_apartments_get_by_free_places();
$info = sh_studenthousing_get();

sh_db_close();
if($apartments == NULL)
    die('Problem'); 
$acount = @count($apartments);

if($acount == 0)
    die('there is no apartments');

if($info == NULL){
    sh_db_close();
    die('Error !!');
}
?>

<!DOCTYPE html>

<!--    MAIN PAGE     -->
<html>
<title> حجز شقة </title>
    <head>
        <!-- GOOGLE FONT-->
        <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Changa" rel="stylesheet">

        <!-- GOOGLE FONT-->

        <!-- Internet Explorer compatibility -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- First mobile meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- css files-->


        <!-- css files(THEY MUST BE IN THIS ORDER IT'S IMPORTANT '-->


        <meta charset="UTF-8">

        <!--[if lt IE 9]>
        <script src="javascript/htm15shiv.js"></script>
        <script src="javascript/respond.js"></script>
        <![endif]-->

        <!--CSS FILES , ONLY EDIT DASHBOARD.CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-rtl.css">
        <link rel="stylesheet" type="text/css" href="css/show-apartment.css">
        <link rel="stylesheet" href="css/dashboard.css">
        <link rel="stylesheet" href="css/w4.css">







        <title></title>
    </head>
    <body  >


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
                    <a class="navbar-brand" href="index.php" > <font size="6" face="cairo" color="white">  سكن جامعة طيبة   </font></a>

                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <form action="Sign_in_up/logout.php" method="post" class="navbar-form navbar-right">
                        <input type="submit" class="btn btn-danger" value="تسجيل الخروج" />
                    </form>
                </div>
            </div>
        </nav>
                <!------------ -SIDEBAR --------------------------------------->

        
        <!------------ -SIDEBAR --------------------------------------->


        <!------------ -SIDEBAR CONTAINS --------------------------------------->


<font face="Changa">




<div class=" w3-sidebar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="rightMenu">
    <button onclick="closeRightMenu()" class=" w3-bar-item w3-button w3-large icon-bar w3-border" >إغلاق

        &times;</button>
    <!--SIDE BAR CONATINS-->
    <a href="modifyStudentInfo.php"class="  text w3-bar-item w3-button   ">تعديل بيانات الطلاب</a>

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

    </ul>
</div>

<div class="icon-bar w3-teal">
    <button class=" w3-button w3-teal w3-xlarge w3-right  " onclick="openRightMenu()"style="color: #000000!important;">&#9776;</button>

    <div class="w3-container">

















                        <!--------------------- PAGE CONTAINS -------------------------->
                        <div class="row">

                          <script src="js/jquery.js">
                                $(".dropdown-menu li a").click(function(){

                                    $(this).parents(".btn-group").find('.selection').text($(this).text());
                                    $(this).parents(".btn-group").find('.selection').val($(this).text());
                                    alert($(this).parents(".btn-group").find('.selection').val($(this).text()));
                                });
                          </script>
                                               
                          
                          <!-- بداية رسائل الاخطاء والعمليات الناجحة -->
                          
                          <?php 

                            if (!empty($_SESSION['has_booking_already'])) {
                              echo "<div class=\"alert alert-danger\" role=\"alert\">{$_SESSION['has_booking_already']}</div>";
                              unset($_SESSION['has_booking_already']);
                            }
                            if (!empty($_SESSION['booking_successful'])) {
                              echo "<div class=\"alert alert-success\" role=\"alert\">{$_SESSION['booking_successful']}</div>";
                              unset($_SESSION['booking_successful']);
                            }
                            
                            
                          ?>
                          <!-- نهاية رسائل الاخطاء والعمليات الناجحة -->
                          
                          
                          <?php
                          
                          
                          if($can_booking){
               
                            //couinter for forms
                            $counter_apartments = 0;
                            
                            foreach($apartments as $apartment){
                                echo "<div class=\"col-lg-3\">";
                                echo "<form id=\"form$counter_apartments\" action=\"saveBooking.php\" method=\"post\" >";
                                echo "<a href=\"apartmen-details.php?apartment_id=$apartment->apartment_id\" ><h3 class=\"intro\"> <font face=\"Changa\"> رقم الشقة: $apartment->apartment_id</font></h3></a>";
                                echo "<input type=\"hidden\" name=\"apartment_id\" value=\"$apartment->apartment_id\">";
                                //echo "<input type=\"hidden\" name=\"apartment_number\" value=\"$counter_apartments\">";
                                echo "<img src=\"img/ap.jpg\" class=\"img-responsive\" >";
                                echo "<ul class=\"list-unstyled\">";
                                echo "<h5>عدد الاشخاص الحالي:$apartment->current_number_of_students</h5>";
                                echo "<h5>عدد الاشخاص الأقصى: $apartment->max_number_of_students</h5>";
                                echo "</ul>";
                                
                                /*
                                echo "<div class=\"btn-group \" >";
                                echo "<button type=\"button\"  class=\"btn btn-default dropdown-toggle btn-default\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" >";
                                echo "المدة - السعر <span class=\"caret\"></span>";
                                echo "</button>";
                                echo "<ul class=\"dropdown-menu\" >";
                                echo "<li><a href=\"#\">المدة - السعر</a></li>";
                                echo "<li><a href=\"#\">فصل دراسي واحد - السعر 500 ريال سعودي</a></li>";
                                echo "<li><a href=\"#\">فصلين دراسيين - السعر 1000 ريال سعودي</a></li>";
                                echo "<li><a href=\"#\">ثلاث فصول دراسية - السعر 1500 ريال سعودي</a></li>";
                                echo "</ul>";
                                echo "</div>";
                                */
                                echo "<select name=\"terms\">";
                                echo "<option value=\"1\">فصل دراسي واحد - السعر $info->PRICE_OF_ONE_TERM ريال سعودي</option>";
                                echo "<option value=\"2\">فصلين دراسيين - السعر $info->PRICE_OF_TWO_TERM ريال سعودي</option>";
                                echo "<option value=\"3\">ثلاث فصول دراسية - السعر $info->PRICE_OF_THREE_TERM ريال سعودي</option>";
                                echo "</select>";
                                
                                //echo "<p><input type=\"submit\" class=\"btn btn-primary\" value=\"حجز\"></p>";
                                echo "<p><button type=\"submit\"  class=\"btn btn-primary\"  value=\"حجز\">حجز</button></p>";
                                //echo "<p><input type=\"submit\" name=\"btn$counter_apartments\" class=\"btn btn-primary\" onclick=\"alert(\'form$counter_apartments\');\"  value=\"حجز\"></p>";
                                
                                echo "</form>";
                                echo "</div>";
                                $counter_apartments++;
                            }
                          }
                          else{
                              echo 'لاتستطيع الحجز في الوقت الحالي';
                          }
                            ?>
                            
                          

                          
                        </div>

                </div>
            </div>
        </div>
</font>


        <!------------------JAVASCRIPT ------------------------->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
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
