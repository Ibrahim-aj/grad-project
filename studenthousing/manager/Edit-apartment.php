<?php
session_start();
// التحقق من السيشن
if (!isset($_SESSION['LoginAdmin']) && $_SESSION['LoginAdmin'] == "") {
	header("Location: http://localhost/studenthousing/managerLogin/Sign_in_up.php");
}

require_once('../db.php');

	$countApprts = mysqli_query($conn, "SELECT * FROM apartment");
	if(isset($_GET['id']) && mysqli_real_escape_string($conn, $_GET['id'] == "")){
		header("location: modify-apartment.php");
		exit;
	}
	$id = mysqli_real_escape_string($conn, $_GET['id']);
	$queryEdit = mysqli_query($conn, "SELECT * FROM apartment WHERE apartment_id = '{$id}'");
	if(mysqli_num_rows($queryEdit) == 0){
		header("location: modify-apartment.php");
		exit;
	}else
	$row = mysqli_fetch_assoc($queryEdit);
?>
<!DOCTYPE html>
<html>
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

        <title>تعديل الشقة رقم <?=$row['apartment_id'];?></title>
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
               <form action="../managerLogin/logout.php" method="post" class="navbar-form navbar-right">
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
	    <a href="manageComplaints.php" class="w3-bar-item w3-button  w3-border "> الرد على الشكاوي</a>
	
   </font>
   

  
</div>

<font face="Changa">
<div class="icon-bar w3-teal">
    <button class=" w3-button w3-teal w3-xlarge w3-right " onclick="openRightMenu()" style="color: #000000!important;">&#9776;</button>
	
	<div class="col-sm-9 col-sm-offset-3 col-md-8 col-md-offset-2 ">
 <h1 class="page-header"><font face="changa">تعديل الشقق</font></h1>

                
                </div>

    <div class="w3-container" style="background-color:#D8DCF8">

                <div class="col-sm-9 col-sm-offset-3 col-md-8 col-md-offset-2 ">
                  <center><div class="btn btn-default " style="margin-bottom:15px;">عدد الشقق الحالي: <strong class="text-primary"><?php echo mysqli_num_rows($countApprts); ?></strong></div></center>
                  <form method="post" action="Edit-apartment.php?id=<?=$row['apartment_id'];?>">
<?php


	if(isset($_POST['from']) && $_POST['from'] == "EditAppart"){
		if((isset($_POST['max_number_of_students']) && $_POST['max_number_of_students'] == "") or (isset($_POST['apartment_info']) && $_POST['apartment_info'] == "") or (isset($_POST['current_number_of_students']) && $_POST['current_number_of_students'] == "")){
			echo '<div class="alert alert-danger">يرجى ملئ جميع الحقول </div>';
		}else{
			$max_number_of_students = mysqli_real_escape_string($conn, $_POST['max_number_of_students']);
			$current_number_of_students = mysqli_real_escape_string($conn, $_POST['current_number_of_students']);
			$apartment_info = mysqli_real_escape_string($conn, $_POST['apartment_info']);
			
			$addApp = mysqli_query($conn, "UPDATE apartment SET current_number_of_students = '{$current_number_of_students}', max_number_of_students = '{$max_number_of_students}', apartment_info = '{$apartment_info}' WHERE apartment_id = '{$id}'");
			if($addApp){
				echo '<div class="alert alert-success">تم تحديث بيانات الشقة بنجاح</div>';
			}
		}
	}
	$queryEdit = mysqli_query($conn, "SELECT * FROM apartment WHERE apartment_id = '{$id}'");
	$row = mysqli_fetch_assoc($queryEdit);
?>
                  <div class="form-group">
                    <label for="max_number_of_students" class="col-lg-3 control-label">عدد الطلاب الأقصى</label>
                    <div class="col-lg-9">
                      <input type="text" name="max_number_of_students" value="<?=$row['max_number_of_students'];?>" id="max_number_of_students" class="form-control">
                    </div>
                  </div>
                  <hr />
                  <div class="form-group">
                    <label for="current_number_of_students" class="col-lg-3 control-label">عدد الطلاب الحالي</label>
                    <div class="col-lg-9">
                      <input type="text" name="current_number_of_students" value="<?=$row['current_number_of_students'];?>" id="current_number_of_students" class="form-control">
                    </div>
                  </div>
                  <hr />
                  <div class="form-group">
                    <label for="apartment_info" class="col-lg-3 control-label">بيانات الشقة</label>
                    <div class="col-lg-9">
                      <textarea name="apartment_info" id="apartment_info" class="form-control" rows="3"><?=$row['apartment_info'];?></textarea>
                    </div>
                  </div>
                  
                      <button type="submit" name="from" class="btn btn-primary btn-lg" value="EditAppart">تحديث الشقة</button>
               
                  </form>
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
