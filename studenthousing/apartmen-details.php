<?php session_start();
	require_once('db.php');
	require_once('studentsAPI.php');
	require_once('apartmentAPI.php');
require_once('manager/studentHousingAPI.php');
	// التحقق من السيشن
	checkSession();
	// استعلام الشقة المحجوزة للطالب

        require_once('manager/studentHousingAPI.php');
//التحقق من بداية ونهاية الحجوزات
$can_booking = sh_studenthousing_check_can_booking();
	
if($can_booking == FALSE){
    die('Bad access');
}

	$queryAppartement = mysqli_query($conn, "SELECT * FROM apartment WHERE apartment_id = '{$_GET['apartment_id']}'");
	$row = mysqli_fetch_array($queryAppartement);
	
?>
<!DOCTYPE html>
<html >
<title> بيـانات الشقة </title>
<head>

    <meta charset="UTF-8">
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

    <!-------------------------------------------------------meeeow -->


    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="rate/css/star-rating.css">

    <link rel="stylesheet" href="rate/css/bootstrap-rtl.css">

    <link rel="stylesheet" href="rate/css/uni/theme.css">
    <link rel="stylesheet" href="rate/css/svg/theme.css">
    <link rel="stylesheet" href="rate/css/fn/theme.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="rate/javascript/star-rating.js"></script>
    <script src="rate/javascript/uni/theme.js"></script>
    <script src="rate/javascript/svg/theme.js"></script>
    <script src="rate/javascript/fa/theme.js"></script>

   <link rel="stylesheet" href="css/dashboard.css">
        <link rel="stylesheet" href="css/w4.css">
    <!-------------------------------------------------------meeeow -->

</head>
<body style="background-color:#D8DCF8" >

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
            <style>
                @import url('https://fonts.googleapis.com/css?family=Amiri:700');

                .button-success {
                    background: rgb(21, 152, 23); /* this is a green */
                }

                .color


            </style>
            <a class="navbar-brand" href="#" > <font size="6" face="cairo" color="white">  سكن جامعة طيبة</font></a>

        </div>
            
                   <form action="Sign_in_up/logout.php" method="post" class="navbar-form navbar-right">
                        <input type="submit" class="btn btn-danger" value="تسجيل الخروج" />
                    </form>
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
</div>

<div class="icon-bar w3-teal">
    <button class=" w3-button w3-teal w3-xlarge w3-right " onclick="openRightMenu()"style="color: #000000!important;">&#9776;</button>
    <div class="w3-container" style="background-color:#D8DCF8">








<!-- --------------------------------------------------------->
<div class="col-sm-5 col-sm-offset-4 col-md-8 col-md-offset-2 main" style="background-color:#D8DCF8">
        <div class="form-group">


            <div class="row" style="background-color:#D8DCF8">
                <div class="col-sm-12" style="background-color:#D8DCF8">
<?php
if(mysqli_num_rows($queryAppartement) == 0 ){
	echo '<div class="alert alert-warning">لا يوجد لديك شقق محجوزة</div>';
}else{ 
	// استعلام تقييم الشقة 
	$queryRates = mysqli_query($conn, "SELECT * FROM rate WHERE apartment_id = '{$_GET['apartment_id']}' ");
	$countRate = mysqli_num_rows($queryRates);
	$TRatings = 0;
	
	while($rat = mysqli_fetch_array($queryRates)){
		$TRatings = $TRatings + $rat['rate'];
	}
	
if($countRate == 0 ){
	$displayRate =0; 
}else{
	
	
	
	$displayRate = ($TRatings / $countRate);
	
}
?>
                    <h3 class="intro"> <font face="Changa"> رقم الشقة: <?=$row['apartment_id'];?></font></h3>
                    <div class="well col-lg-6" style="height:350px;"><img style="height:100%; width:100%" src="rate/images/cover.jpg" class="img-responsive"></div>
                    <div class="well col-lg-4" style="min-height:350px;">
                      <ul class="list-group">
                        <li class="list-group-item">عدد الطلاب الحاليين <span class="badge"><?=$row['current_number_of_students'];?></span></li>
                        <li class="list-group-item">عدد الطلاب الاقصى <span class="badge"><?=$row['max_number_of_students'];?></span></li>
						
					
                      </ul>
					  
					    <?php 

echo $row['apartment_info']
						?>
                    </div>
                    
                    <div class="clearfix"></div>
                    <p class="form-group">
                    <label class="col-sm-3">التقييم :</label>
                    <div class="col-sm-9">
                   <?php if($countRate == 0){ ?>
                      <div class="text-center text-warning">لايوجد تقييم</div>
                   <?php }else{ ?>

                     <input id="input-3" name="input-3" class="rating-loading" dir="rtl" value="<?=substr($displayRate,0,1)?>"><br><small>عدد التقييمات : <?=$countRate?></small>
                    <?php } ?>
                    </div>
                    </p>
                   
<?php } ?>

                </div>
            </div>
        </div>
</div>
 </body>
<script>
    $(document).on('ready', function () {
       $('#input-3').rating({displayOnly: true, step: 1});
    });

                       function openRightMenu() {
                            document.getElementById("rightMenu").style.display = "block" ;
                        }
                        function closeRightMenu() {
                            document.getElementById("rightMenu").style.display = "none";
                        }

</script>
</html>