<?php  session_start();
	require_once('../db.php');
	require_once('../studentsAPI.php');
	// التحقق من السيشن
	checkSession();
?>
<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <!--main css-->
    <link rel="stylesheet" href="bootstrap.css">
    <title>نظام سكن جامعة طيبة</title>


</head>

<body>
<div class="container" dir="rtl">
<center>
<br>
  <h1>مرحبا بك في لوحة تحكم الطالب <a href="logout.php">تسجيل الخروج</a></h1>
</center>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="bootstrap.js"></script>

<!--bootstrap code-->

</body>
</html>