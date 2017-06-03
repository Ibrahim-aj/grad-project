<?php

require_once('../db.php');
require_once('../bookingAPI.php');
require_once('../apartmentAPI.php');
require_once('../RequestChangeApartmentAPI.php');
require_once('../studentsAPI.php');


sh_bookings_check_booking_expiration();

//request change apartment
$requests = sh_requestchangeapartment_get();

if($requests == NULL)
    die('Problem'); 
$acount = @count($requests);

if($acount == 0)
    die('there is no Request change apartment');

?>

<!DOCTYPE html>

<!--    MAIN PAGE     -->
<html>
<title> ادارة طلبات تغيير الشقة</title>
    <head>
        <meta charset="UTF-8">

        <!--[if lt IE 9]>
        <script src="javascript/htm15shiv.js"></script>
        <script src="javascript/respond.js"></script>
        <![endif]-->

    <!-- GOOGLE FONT-->
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Changa" rel="stylesheet">

    <!-- GOOGLE FONT-->
        <!--CSS FILES , ONLY EDIT DASHBOARD.CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-rtl.css">
        <link rel="stylesheet" href="css/dashboard.css">
        <link rel="stylesheet" type="text/css" href="managePanelStyle.css">
        <link rel="stylesheet" href="css/w4.css">


        <title></title>
    </head>
    <body id="content" style="background-color:#D8DCF8;" >


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
                     <form action="../managerLogin/logout.php" method="post" class="navbar-form navbar-right">
                        <input type="submit" class="btn btn-danger" value="تسجيل الخروج" />
                    </form>
                </div>
            </div>
        </nav>
                <!------------ -SIDEBAR --------------------------------------->

        
        <!------------ -SIDEBAR --------------------------------------->


        <!------------ -SIDEBAR CONTAINS --------------------------------------->



<div class="color_forside w3-sidebar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="rightMenu"> <font face="Changa">
    <button onclick="closeRightMenu()" class=" w3-bar-item w3-button w3-large icon-bar w3-border" >إغلاق

        &times;</button>
    <!--SIDE BAR CONATINS-->
   	<font face="cairo" size="3">
	
	 <b> ادارة الوحدات السكنية </b>
    <a href="Add-apartment.php" class="text w3-bar-item w3-button  ibrahim ">اضافة شقق</a>
    <a href="modify-apartment.php" class="text w3-bar-item w3-button  ibrahim w3-border ">تعديل الشقق</a>
    <a href="delete-apartment.php" class="w3-bar-item w3-button  w3-border ">حذف شقق</a>
	<a href="show-apartment.php" class="w3-bar-item w3-button  w3-border ">عرض الشقق </a>
	 <b>  ادارة الطلاب والحجوزات </b>
    <a href="delete-student.php" class="w3-bar-item w3-button  w3-border ">حذف الطلاب </a>
	 <a href="manageBookings.php" class="w3-bar-item w3-button  w3-border ">ادارة الحجوزات</a>
	  <a href="manageStudentHousing.php" class="w3-bar-item w3-button  w3-border ">ادارة اوقات الحجوزات واسعارها</a>
	   <a href="manageRequestChangeApartment.php" class="w3-bar-item w3-button  w3-border "> ادارة طلبات تغيير الشقة</a>
	    <b> ادارة الشكاوي </b>
	   <a href="show-complaint.php" class="w3-bar-item w3-button  w3-border "> الرد على الشكاوي</a>
	   <a href="complete-complaint.php" class="w3-bar-item w3-button  w3-border ">الشكاوي (تم الرد عليها)</a>
	
   </font>
    </font>
</div>

<div class="icon-bar w3-teal" > <font face="Changa">
    <button class=" w3-button w3-teal w3-xlarge w3-right " onclick="openRightMenu()"style="color: #000000!important;">&#9776;</button>

    <div class="w3-container" style="background-color:#D8DCF8;">


                        <!--------------------- PAGE CONTAINS -------------------------->
                         <div class="container">
                            <div class="row col-md-offset 2 col-lg-offset 4">
                              <div class="col-md-12 col-sm-12 col-lg-12">
                          <div class="row col-md-12">

                          <script src="../js/jquery.js">
                                $(".dropdown-menu li a").click(function(){

                                    $(this).parents(".btn-group").find('.selection').text($(this).text());
                                    $(this).parents(".btn-group").find('.selection').val($(this).text());
                                    alert($(this).parents(".btn-group").find('.selection').val($(this).text()));
                                });
                          </script>
                                         
                          
                          <table>
                              <tr>
                                  <th>رقم الطلب</th>
                                  <th>رقم الطالب</th>
                                  <th>اسم الطالب</th>
                                  <th>رقم الحجز</th>
                                  <th>تاريخ إنشاء الحجز</th>
                                  <th>تاريخ نهاية الحجز</th>
                                  <th>رقم الشقة الحالية | عدد المستأجرين</th>
                                  <th>رقم الشقة المطلوبة | عدد المستأجرين</th>
                                  <th>حالة الحجز</th>
                                  <th>مبلغ الحجز</th>
                                  <th>حالة الطلب</th>
                                  <th>تغيير الشقة</th>
                              </tr>
                              <?php
                                foreach($requests as $request){
                                $booking = sh_bookings_get_by_student_id($request->student_id);
                                if($booking != NULL && $booking->canceled == FALSE && $request->done == FALSE){
                                    echo "<tr>";
                                    echo    "<td>$request->request_id</td>";
                                    echo    "<td>$request->student_id</td>";
                                    $student_name = sh_users_get_by_student_id($request->student_id);
                                    echo    "<td>$student_name->first_name $student_name->middle_name $student_name->last_name</td>";

                                    echo    "<td>$booking->booking_id</td>";
                                    echo    "<td>$booking->start_date</td>";
                                    echo    "<td>$booking->expire_date</td>";
                                    $current_apartment = sh_apartments_get_by_student_id($request->student_id);
                                    echo    "<td>$current_apartment->apartment_id | $current_apartment->current_number_of_students / $current_apartment->max_number_of_students </td>";
                                    $apartment_requested = sh_apartments_get_by_id($request->apartment_requested);
                                    echo    "<td>$apartment_requested->apartment_id | $apartment_requested->current_number_of_students / $apartment_requested->max_number_of_students</td>";
                                    if(strtotime($booking->expire_date) >= time() && ($booking->canceled == 0))
                                        echo    "<td><font color=\"#ffcc00\">ساري</font></td>";
                                    else
                                        echo    "<td><font color=\"#999999\">منتهي</font></td>";
                                    if($booking->paid)
                                        echo    "<td><font color=\"#4CAF50\">مدفوع</font></td>";
                                    else
                                        echo    "<td><font color=\"#cc0052\">غير مدفوع</font></td>";
                                    if($request->status == "لم يوافق عليه")
                                        echo    "<td><font color=\"#cc0052\">لم يوافق عليه</font></td>";
                                    else
                                        echo    "<td><font color=\"#4CAF50\">موافق عليه</font></td>";
                                    if($request->status == "لم يوافق عليه" && $apartment_requested->current_number_of_students < $apartment_requested->max_number_of_students && $booking->paid && strtotime($booking->expire_date) >= time())
                                        echo    "<td><a href=\"acceptRequestChangeApartment.php?request_id=$request->request_id\">الموافقة على الطلب</a></td>";
                                    echo "</tr>";
                                }
                              }
                              sh_db_close();
                              ?>
                          </table>
                          <h4>  هنا تعرض طلبات تغيير الشقة الغير معتمدة </h4>
                          <a href="manageAllRequestChangeApartment.php" target="_top">عرض جميع طلبات تغيير الشقة</a>
                          
                        </div>

                </div>
            </div>
        </div>



        <!------------------JAVASCRIPT ------------------------->
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.min.js"></script>
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
