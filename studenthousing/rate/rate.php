<?php session_start();
	require_once('../db.php');
	require_once('../studentsAPI.php');
	// التحقق من السيشن
	checkSession();
	// استعلام الشقة المحجوزة للطالب
$query = mysqli_query($conn, "SELECT * FROM booking WHERE student_id = '{$_SESSION['LoginStudent']}' And canceled ='0'  LIMIT 1 "); 
	$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
<title > تقييم الشقـة</title>
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

    <link rel="stylesheet" href="css/star-rating.css">

    <link rel="stylesheet" href="css/bootstrap-rtl.css">

    <link rel="stylesheet" href="css/uni/theme.css">
    <link rel="stylesheet" href="css/svg/theme.css">
    <link rel="stylesheet" href="css/fn/theme.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="javascript/star-rating.js"></script>
    <script src="javascript/uni/theme.js"></script>
    <script src="javascript/svg/theme.js"></script>
    <script src="javascript/fa/theme.js"></script>

    <link rel="stylesheet" href="../css/dashboard.css">
        <link rel="stylesheet" href="../css/w4.css">

    <!-------------------------------------------------------meeeow -->

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
            <style>
                @import url('https://fonts.googleapis.com/css?family=Amiri:700');

                .button-success {
                    background: rgb(21, 152, 23); /* this is a green */
                }

                .color


            </style>
            <a class="navbar-brand" href="#" > <font size="6" face="cairo" color="white"> سكن جامعة طيبة</font></a>

        </div>
            <form action="../Sign_in_up/logout.php" method="post" class="navbar-form navbar-right">
                        <input type="submit" class="btn btn-danger" value="تسجيل الخروج" />
                    </form>

    </div>
</nav>






<div class="color_forside w3-sidebar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="rightMenu"> <font face="Changa">
    <button onclick="closeRightMenu()" class=" w3-bar-item w3-button w3-large icon-bar w3-border" >إغلاق

        &times;</button>
    <!--SIDE BAR CONATINS-->
    <a href="../modifyStudentInfo.php"class="text w3-bar-item w3-button alignright ul.b ibrahim ">تعديل بيانات الطلاب</a>


    <a href="../index.php"class="text w3-bar-item w3-button  ibrahim w3-border ">حجز شقة</a>
    <a href="../cancel-booking.php" class="w3-bar-item w3-button  w3-border">الغاء حجز الشقة</a>
    <a href="../request-cancel-booking.php" class="w3-bar-item w3-button  w3-border">طلب تغيير الشقة</a>
    <a href="apartment-info.php" class="w3-bar-item w3-button  w3-border">بيانات الشقة</a>
    <a href="../rate/rate.php" class="w3-bar-item w3-button  w3-border">تقييم الشقة</a>
    <a href="../complaint/Complaint.php" class="w3-bar-item w3-button  w3-border">إرسال شكوى</a>
    <a href="../complaint/complaint-view.php" class="w3-bar-item w3-button   w3-border">عرض الشكوى</a>

    </ul>
    </font>
</div>

<div class="icon-bar w3-teal" > <font face="Changa">
    <button class=" w3-button w3-teal w3-xlarge w3-right " onclick="openRightMenu()"style="color: #000000!important;">&#9776;</button>
    <div class="w3-container" style="background-color:#D8DCF8;">



<!-- --------------------------------------------------------->
<div class="col-sm-5 col-sm-offset-4 col-md-10 col-md-offset-2 main" style="background-color:#D8DCF8;">
<?php




	
$apartment_id = $row['apartment_id'];

if(isset($_GET['action']) && $_GET['action'] == "delRating"){
	$rating_exists = mysqli_query($conn, "SELECT * FROM rate WHERE apartment_id = '{$apartment_id}' AND student_id = '{$_SESSION['LoginStudent']}'");
	if(mysqli_num_rows($rating_exists) == 1){
		$dQuery = mysqli_query($conn, "DELETE FROM rate WHERE apartment_id = '{$apartment_id}' AND student_id = '{$_SESSION['LoginStudent']}'");
		if($dQuery){
			echo '<div class="alert alert-success">تم حذف التقييم بنجاح يمكنك اعادة التقييم من جديد </div>';
		}
	}else{
		echo '<div class="alert alert-success">تم حذف التقييم من قبل </div>';
	}
}
if(isset($_POST['from']) && $_POST['from'] == "Rating"){
	if(mysqli_num_rows($query) != 0){
		if(isset($_POST['input-1']) && $_POST['input-1'] != ''){

			$rating_exists = mysqli_query($conn, "SELECT * FROM rate WHERE apartment_id = '{$apartment_id}' AND student_id = '{$_SESSION['LoginStudent']}'");
			if(mysqli_num_rows($rating_exists) == 0){
				
				mysqli_query($conn,"INSERT INTO rate (rate, apartment_id, student_id)VALUES( '{$_POST['input-1']}', '{$apartment_id}', '{$_SESSION['LoginStudent']}')");
				echo '<div class="alert alert-success">تم ارسال التقييم بنجاح شكرا لك</div>';
			}else{
				echo '<div class="alert alert-danger">لا يمكنك التقيم اكثر من مرة <b href="rate.php?action=delRating" style="color:blue;">انقر هنا لاعادة التقييم</b></div>';
			}
		}else{
			echo '<div class="alert alert-danger">يرجى تحديد التقييم </div>';
		}
	}else{
		echo '<div class="alert alert-danger">رقم الشقة غير صحيح او غير موجود في حجزك </div>';
	}
}
?>
    <form action="rate.php" method="post">
        <div class="form-group" style="background-color:#D8DCF8;">


            <!-- IN THIS PLACE WE SHOULD PUT THE APRTMENT THAT STUDENT BOOKED LIKE IN THE BOOKING -->
            <!-----------------  تحت المفترض يكون الشقة الطالب حجزها وتكون مأخوذة من الدتابيس -------------------->
            <div class="row">
                <div class="col-lg-3">
                    <h3 class="intro"> <font face=Changa> رقم الشقة: <?=$row['apartment_id'];?></font></h3>
                    <img src="css/ap.jpg" class="img-responsive">
                    <!-----------------  فوق المفترض يكون الشقة الطالب حجزها وتكون مأخوذة من الدتابيس -------------------->

<?php

if(mysqli_num_rows($query) == 0 )
	echo '<div class="alert alert-warning">لا يوجد لديك شقق محجوزة</div>';
else{

			$rating_exists = mysqli_query($conn, "SELECT * FROM rate WHERE apartment_id = '{$row['apartment_id']}' AND student_id = '{$_SESSION['LoginStudent']}'");
			if(mysqli_num_rows($rating_exists) == 1){
				
             $rating_last = mysqli_query($conn, "SELECT rate FROM rate WHERE student_id = '{$_SESSION['LoginStudent']}' And apartment_id = '{$row['apartment_id']}' ");
				$row1 = mysqli_fetch_array($rating_last);	
			
				
			echo '<div class="alert alert-warning">لايمكنك التقييم اكثر من مرة   <a href="rate.php?action=delRating" style="color:blue;" >انقر هنا لاعادة التقييم</a></div>'   ;
			echo "  تقييمك السابق    " . $row1['rate'] . "نجوم  " ;

			      
			}else{
				
			}
?>
                    <!------------------------------------------------------ التقييم النجوم------------------>
                    <input id="input-1" name="input-1" class="rating rating-loading" dir="rtl" data-size="sm"
                           data-min="0" data-max="5" data-step="1" >
                    <div class="clearfix"></div>
                    <!------------------------------------------------------ التقييم النجوم------------------>


                    <!-----------------  الزر -------------------->
                    <input type="hidden" name="from" value="Rating">
                    <button type="submit"  class="btn btn-primary"> تقييم</button>
                    <!-----------------  الزر -------------------->

<?php } ?>
                </div>
            </div>
            </font>

        </div>
    </form>

</div>

</body>
<script>
    $(document).on('ready', function () {
        $('.kv-gly-star').rating({
            containerClass: 'is-star'
        });
        $('.kv-gly-heart').rating({
            containerClass: 'is-heart',
            defaultCaption: '{rating} hearts',
            starCaptions: function (rating) {
                return rating == 1 ? 'One heart' : rating + ' hearts';
            },
            filledStar: '<i class="glyphicon glyphicon-heart"></i>',
            emptyStar: '<i class="glyphicon glyphicon-heart-empty"></i>'
        });
        $('.kv-fa').rating({
            theme: 'krajee-fa',
            filledStar: '<i class="fa fa-star"></i>',
            emptyStar: '<i class="fa fa-star-o"></i>'
        });
        $('.kv-fa-heart').rating({
            defaultCaption: '{rating} hearts',
            starCaptions: function (rating) {
                return rating == 1 ? 'One heart' : rating + ' hearts';
            },
            theme: 'krajee-fa',
            filledStar: '<i class="fa fa-heart"></i>',
            emptyStar: '<i class="fa fa-heart-o"></i>'
        });
        $('.kv-uni-star').rating({
            theme: 'krajee-uni',
            filledStar: '&#x2605;',
            emptyStar: '&#x2606;'
        });
        $('.kv-uni-rook').rating({
            theme: 'krajee-uni',
            defaultCaption: '{rating} rooks',
            starCaptions: function (rating) {
                return rating == 1 ? 'One rook' : rating + ' rooks';
            },
            filledStar: '&#9820;',
            emptyStar: '&#9814;'
        });
        $('.kv-svg').rating({
            theme: 'krajee-svg',
            filledStar: '<span class="krajee-icon krajee-icon-star"></span>',
            emptyStar: '<span class="krajee-icon krajee-icon-star"></span>'
        });
        $('.kv-svg-heart').rating({
            theme: 'krajee-svg',
            filledStar: '<span class="krajee-icon krajee-icon-heart"></span>',
            emptyStar: '<span class="krajee-icon krajee-icon-heart"></span>',
            defaultCaption: '{rating} hearts',
            starCaptions: function (rating) {
                return rating == 1 ? 'One heart' : rating + ' hearts';
            },
            containerClass: 'is-heart'
        });

        $('.rating,.kv-gly-star,.kv-gly-heart,.kv-uni-star,.kv-uni-rook,.kv-fa,.kv-fa-heart,.kv-svg,.kv-svg-heart').on(
            'change', function () {
                console.log('Rating selected: ' + $(this).val());
            });
    });





                    function openRightMenu() {
                        document.getElementById("rightMenu").style.display = "block" ;
                    }
                    function closeRightMenu() {
                        document.getElementById("rightMenu").style.display = "none";
                    }

</script>
</html>