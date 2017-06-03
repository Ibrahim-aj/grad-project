<?php

session_start();
// التحقق من السيشن
if (!isset($_SESSION['LoginAdmin']) && $_SESSION['LoginAdmin'] == "") {
		header("Location: http://localhost/StudentHousing/manager/Sign_in_up/Sign_in_up.php");
}


 require_once('../db.php');
require_once('studentHousingAPI.php');
    
$info = sh_studenthousing_get();

if($info == NULL){
    sh_db_close();
    die('Error !!');
}
sh_db_close();
?>


<!DOCTYPE html>

<!--    MAIN PAGE     -->
<html>
    <head>
        <meta charset="UTF-8">
		
		<title> ادارة اوقات الحجوزات واسعارها</title>

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
                                         
                          
                          <form action="saveStudentHousingInfo.php" method="post">

						  <!-------------------------->


    <div class="panel panel-success">
      <div class="panel-heading">ادارة اسعار الحجوزات</div>
      <div class="panel-body">                                  <label>سعر فصل دراسي واحد:</label>
                                  <input type="number" name="price1" value="<?php echo $info->PRICE_OF_ONE_TERM ?>"/>
                                  <label>سعر فصلين دراسيين:</label>
                                  <input type="number" name="price2" value="<?php echo $info->PRICE_OF_TWO_TERM; ?>"/>
                                  <label>سعر ثلاث فصول دراسية:</label>
                                  <input type="number" name="price3" value="<?php echo $info->PRICE_OF_THREE_TERM; ?>"/>
</div>
    </div>

<!-------------------------->

    <div class="panel panel-success">
      <div class="panel-heading">ادارة فترة بداية الحجوزات ونهايتها</div>
      <div class="panel-body">                              <fieldset>
                                  <label>تاريخ بداية الحجوزات:</label>
                                  <input type="date" name="start_date_bookings" value="<?php echo $info->TIME_OF_STARTING_BOOKINGS; ?>"/>
                                  <label>تاريخ نهاية الحجوزات:</label>
                                  <input type="date" name="expire_date_bookings" value="<?php echo $info->TIME_OF_ENDING_BOOKINGS; ?>"/>
                              </fieldset></div>
    </div>




<!-------------------------->


    <div class="panel panel-success">
      <div class="panel-heading">ادارة بداية حجز الشقة</div>
      <div class="panel-body">  <fieldset>
                                  <label>يبدأ الحجز من تاريخ:</label>
                                  <input type="date" name="start_date_booking" value="<?php echo $info->START_DATE_OF_NEW_BOOKING; ?>"/>
                              </fieldset>
							  </div>
    </div>

<!-------------------------->

    <div class="panel panel-successs">
      <div class="panel-heading">المدة المسموحة قبل نهاية حذف الحجز المدفوع</div>
      <div class="panel-body">                                  <label>عدد الايام:</label>
                                  <input type="number" name="number_of_days_before_cancel_booking" value="<?php echo $info->NUMBER_OF_DAYS_BEFORE_CANCEL_BOOKING; ?>"/>
</div>
    </div>
	


<!-------------------------->




    <div class="panel panel-success">
      <div class="panel-heading">ادارة عدد اشهر الفصل الدراسي الواحد:</div>
      <div class="panel-body">
                                      <label>الفصل الدراسي الأول:</label>
                                                                <input type="number" name="first_term" value="<?php echo $info->TIME_OF_FIRST_TERM; ?>"/>
                                                                <label>الفصل الدراسي الثاني:</label>
                                                                <input type="number" name="second_term" value="<?php echo $info->TIME_OF_SECOND_TERM; ?>"/>
                                                                <label>الفصل الدراسي الصيفي:</label>
                                                                <input type="number" name="summer_term" value="<?php echo $info->TIME_OF_SUMMER_TERM; ?>"/>

                                                                </div>
    </div>

	
                              <input type="submit" class="btn-primary" value="تعديل"/>

                          </form>
                          
                        </div>


<!-------------------------->
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


