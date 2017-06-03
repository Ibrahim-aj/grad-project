<?php
session_start();
// التحقق من السيشن
if (!isset($_SESSION['LoginAdmin']) && $_SESSION['LoginAdmin'] == "") {
		header("Location: http://localhost/StudentHousing/manager/Sign_in_up/Sign_in_up.php");
}

require_once('../db.php');

	$countComplaint = mysqli_query($conn, "SELECT * FROM complaint WHERE status = '1'");

?>
<!DOCTYPE html>
<html>
<title> الشكاوي التي تم الرد عليها</title>
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
              <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
              <link rel="stylesheet" type="text/css" href="css/show-apartment.css">
              <link rel="stylesheet" href="css/w4.css">
              <link rel="stylesheet" href="css/dashboard.css">


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

    <div class="w3-container" style="background-color:#D8DCF8">

                <div class="col-sm-9 col-sm-offset-3 col-md-8 col-md-offset-2 ">
                  <center><div class="btn btn-default " style="margin-bottom:15px;">عدد شكاوي الطلاب التي تم الرد عليها : <strong class="text-primary"><?php echo mysqli_num_rows($countComplaint); ?></strong></div></center>
                    <h4> اضغط على اسم الشكوى لمشاهدة الرد </h4>
<?php
if(isset($_GET['delete']) && $_GET['delete'] != ""){
	$delete = mysqli_real_escape_string($conn,$_GET['delete']);
	$query = mysqli_query($conn, "SELECT * FROM complaint WHERE complaint_id = '{$delete}'");
	if(mysqli_num_rows($query) != 0){
		$deleteQuery = mysqli_query($conn, "DELETE FROM complaint WHERE complaint_id = '{$delete}'");
		echo '<div class="alert alert-success">تم حذف الشكوى بنجاح</div>';
	}
}
	$countComplaint = mysqli_query($conn, "SELECT * FROM complaint WHERE status = '1'");
?>
								<table id="zctb" class="display dataTable table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="background-color:#fff;">
                                    <thead>
                                        <tr>
                                            <th style="width:25px; text-align:right !important;">رقم الشكوى</th>
                                            <th style=" text-align:center !important;">الشكوى</th>
                                            <th style=" text-align:center !important;">رقم الطالب المشتكي</th>
                                            <th style=" text-align:center !important;">الحالة</th>
                                            <th style="text-align:center !important;">حذف</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        <?php 
					  		if(mysqli_num_rows($countComplaint) != 0){
								while($row = mysqli_fetch_array($countComplaint)){
						?>
                                        <tr>
                                            <td style=" text-align:right !important;"><?=$row['complaint_id'];?></td>
                                            <td style=" text-align:center !important;"><a href="reply-complaint.php?id=<?=$row['complaint_id'];?>"><b><?=$row['complaint_text'];?></b></a></td>
                                            <td style=" text-align:center !important;"><?=$row['student_id'];?></td>
                                            <td style=" text-align:center !important;"><p class="label label-success">تم الرد</p></td>
                                            <td style=" text-align:center !important;"><a href="complete-complaint.php?delete=<?=$row['complaint_id'];?>"><i class="glyphicon glyphicon-trash"></i></a></td>
                                        </tr>
                            <?php 
								}
							}else{
					    ?>
                                        <tr><td class="td2" colspan="3"><center>لا يوجد شكاوي حاليا</center></td></tr>
                        <?php } ?>
                                    </tbody>
                                </table>
                    </div>
                  </div>
                </div>
				
				
            </div>
			
        </div>
		
</font>



        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
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
