<?php

require_once('../db.php');
require_once('../bookingAPI.php');
require_once('../apartmentAPI.php');
require_once('../studentsAPI.php');


//bookings
$bookings = sh_bookings_get();

if($bookings == NULL)
    die('Problem');
$acount = @count($bookings);

if($acount == 0)
    die('there is no bookings');

?>

<!DOCTYPE html>

<!--    MAIN PAGE     -->
<html>
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
    <body id="content">


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
                    <a class="navbar-brand" href="#" > <font size="6" face="cairo" color="white">سكن جامعة طيبة - لوحة تحكم المدير</font></a>
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



<div class="color_forside w3-sidebar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="rightMenu"> <font face="Changa">
    <button onclick="closeRightMenu()" class=" w3-bar-item w3-button w3-large icon-bar w3-border" >إغلاق

        &times;</button>
    <!--SIDE BAR CONATINS-->


    <a href="manageBookings.php"class="text w3-bar-item w3-button  ibrahim w3-border ">إدارة الحجوزات</a>
    <a href="managerequestchangeapartment.php" class="w3-bar-item w3-button  w3-border">إدارة الطلبات</a>
    <a href="managestudenthousing.php" class="w3-bar-item w3-button  w3-border">إدارة الغرف</a>
    <a href="S_manage.php" class="w3-bar-item w3-button  w3-border">إدارة الطالب</a>
     <a href="c_manage.php" class="w3-bar-item w3-button  w3-border">إدارة الشكاوى</a>


    </ul>
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


                        </div>

                </div>
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
