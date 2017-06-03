<?php
session_start();
// التحقق من السيشن
if (!isset($_SESSION['LoginUser']) && $_SESSION['LoginUser'] == "") {
		header("Location: http://localhost/StudentHousing/Sign_in_up/Sign_in_up.php");
}

require_once('db.php');
require_once('studentsAPI.php');
require_once('manager/studentHousingAPI.php');
//التحقق من بداية ونهاية الحجوزات
$can_booking = sh_studenthousing_check_can_booking();

$user = sh_users_get_by_id("{$_SESSION['LoginUser']}");
sh_db_close();

if($user == NULL)
    die('Bad User');
?>

<!DOCTYPE html>
<html>

<title> تعديل بيـانات الطالب </title>
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
               <link rel="stylesheet" href="css/dashboard.css">
                              <link rel="stylesheet" href="css/w4.css">

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


                    <!-- بداية رسائل الاخطاء والعمليات الناجحة -->
                          
                          <?php 

                            if (!empty($_SESSION['empty_fields'])) {
                              echo "<div class=\"alert alert-danger\" role=\"alert\">{$_SESSION['empty_fields']}</div>";
                              unset($_SESSION['empty_fields']);
                            }
                            if (!empty($_SESSION['email_exist'])) {
                              echo "<div class=\"alert alert-danger\" role=\"alert\">{$_SESSION['email_exist']}</div>";
                              unset($_SESSION['email_exist']);
                            }
                            if (!empty($_SESSION['phone_exist'])) {
                              echo "<div class=\"alert alert-danger\" role=\"alert\">{$_SESSION['phone_exist']}</div>";
                              unset($_SESSION['phone_exist']);
                            }
                            if (!empty($_SESSION['update_successful'])) {
                              echo "<div class=\"alert alert-success\" role=\"alert\">{$_SESSION['update_successful']}</div>";
                              unset($_SESSION['update_successful']);
                            }
                            
                            
                          ?>
                          <!-- نهاية رسائل الاخطاء والعمليات الناجحة -->







                    <div class="row" style="background-color:#D8DCF8">
                        <div class="col-md-4 col-md-offset-4">
                            <form action="updateStudentInfo.php" method="post" class="form-horizontal">

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="textinput">الاسم الاول</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="fname" placeholder="الاسم الاول" value="<?php echo $user->first_name;?>" class="form-control">
                                        </div>
                                    </div>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="textinput">اسم الاب</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="mname" placeholder="اسم الاب" value="<?php echo $user->middle_name;?>" class="form-control">
                                        </div>
                                    </div>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="textinput">الاسم الاخير</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="lname" placeholder="الاسم الاخير" value="<?php echo $user->last_name;?>" class="form-control">
                                        </div>
                                    </div>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="textinput">البريد الإلكتروني</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" placeholder="البريد الإلكتروني" value="<?php echo $user->email;?>" class="form-control">
                                        </div>
                                    </div>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="textinput">كلمة المرور</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" placeholder="كلمة المرور"  class="form-control">
                                        </div>
                                    </div>

                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="textinput">تاريخ الميلاد</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="dob" placeholder="YYYY-MM-DD" value="<?php echo $user->date_of_birth;?>" class="form-control">
                                        </div>
                                    </div>



                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="textinput">رقم الجوال</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="phone" placeholder="رقم الجوال" value="<?php echo $user->phone_number;?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <div class="pull-right">
                                                <button type="reset" name="reset" class="btn btn-default">Reset</button>
                                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>

                            </form>
                        </div><!-- /.col-lg-12 -->
                    </div><!-- /.row -->

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
