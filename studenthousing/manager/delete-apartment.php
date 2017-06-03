<?php
session_start();
// التحقق من السيشن
if (!isset($_SESSION['LoginAdmin']) && $_SESSION['LoginAdmin'] == "") {
		header("Location: http://localhost/studenthousing/managerLogin/Sign_in_up.php");
}

require_once('../db.php');

	$countApprts = mysqli_query($conn, "SELECT * FROM apartment");

?>
<!DOCTYPE html>
<html>

 <title>حذف الشقق</title>
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
	   <a href="show-complaint.php" class="w3-bar-item w3-button  w3-border "> الرد على الشكاوي</a>
	   <a href="complete-complaint.php" class="w3-bar-item w3-button  w3-border ">الشكاوي (تم الرد عليها)</a>
	
   </font>

  
</div>

<font face="Changa">
<div class="icon-bar w3-teal">
    <button class=" w3-button w3-teal w3-xlarge w3-right " onclick="openRightMenu()" style="color: #000000!important;">&#9776;</button>
	
<div class="col-sm-9 col-sm-offset-3 col-md-8 col-md-offset-2 ">
 <h1 class="page-header"><font face="changa"> حـذف الشقـق</font></h1>

                
                </div>

                
                </div>

    <div class="w3-container" style="background-color:#D8DCF8">

                <div class="col-sm-9 col-sm-offset-3 col-md-8 col-md-offset-2 ">
                  <center><div class="btn btn-default " style="margin-bottom:15px;">عدد الشقق حاليا : <strong class="text-primary"><?php echo mysqli_num_rows($countApprts); ?></strong></div></center>
                  <form method="post" action="delete-apartment.php">
<?php


	if(isset($_POST['from']) && $_POST['from'] == "DELETE"){
		if(isset($_POST['apartment_id'])){
			$apartment_id = mysqli_real_escape_string($conn, $_POST['apartment_id']);
			
		$queryNumberStudent = mysqli_query($conn, "SELECT * FROM apartment WHERE apartment_id = '{$apartment_id}'");
		$row1 = mysqli_fetch_array($queryNumberStudent);
		
		
		
		if ($row1['current_number_of_students'] != 0 ) {
		echo '<div class="alert alert-success">لاتستطيع حذف الشقة لان يوجد بها طلاب</div>';
		}else{
		
		
			$addApp = mysqli_query($conn, " DELETE FROM apartment WHERE apartment_id = '{$apartment_id}'");
			if($addApp){
				echo '<div class="alert alert-success">تم حذف الشقة بنجاح</div>';
			}
			}
			}
		}
	
	$countApprts = mysqli_query($conn, "SELECT * FROM apartment");
?>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">اختر رقم الشقة لحذفها</label>
                    <div class="col-lg-9">
                      <select name="apartment_id" class="form-control">
                        <option disabled selected>-- اختر رقم الشقة --</option>
                        <?php 
					  		if(mysqli_num_rows($countApprts) != 0){
								while($row = mysqli_fetch_array($countApprts)){
									echo '<option value="'.$row['apartment_id'].'">'.$row['apartment_id'].'</option>';
								}
							}
					    ?>
                      </select>
                    </div>
                  </div>
				  
				 
                  <div class="form-group text-center">
				  <br>
				  
				  </br>
                      <button type="submit" name="from" class="btn btn-primary btn-lg" style="font-size: 14px" value="DELETE">حذف الشقة</button>
                  </div>
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
