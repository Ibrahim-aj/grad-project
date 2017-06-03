<?php

session_start();
// التحقق من السيشن
if (!isset($_SESSION['LoginUser']) && $_SESSION['LoginUser'] == "") {
		header("Location: http://localhost/StudentHousing/Sign_in_up/Sign_in_up.php");
}

if(!isset($_POST['apartments']))
{
    die('Bad Access !');
}

require_once('db.php');
require_once('studentsAPI.php');
require_once ('bookingAPI.php');
require_once('RequestChangeApartmentAPI.php');

$student = sh_student_get_by_user_id("{$_SESSION['LoginUser']}");
$user = sh_requestchangeapartment_check_student_has_apartment($student->student_id);
$booking = sh_bookings_get_by_student_id($student->student_id);

if($user == false)
{
    sh_db_close();
    $_SESSION['has_booking_for_change'] = 'لايوجد لديك حجز لشقة أو ان مبلغ الحجز غير مدفوع';
    header("Location: http://localhost/StudentHousing/request-cancel-booking.php");
}

$request = sh_requestchangeapartment_check_student_has_rquest_change_apartment($student->student_id);

if($request == false)
{
   sh_db_close();
   $_SESSION['has_request_change_apartment'] = 'لديك طلب تغيير للشقة بالفعل';
   header("Location: http://localhost/StudentHousing/request-cancel-booking.php"); 
}

$result = sh_requestchangeapartment_add($student->student_id,$booking->booking_id,"لم يوافق عليه",0,$_POST['apartments']);

sh_db_close();

if($result){
    $_SESSION['request_change_apartment_successful'] = 'تم ارسال طلب تغيير الشقة بنجاح';
    header("Location: http://localhost/StudentHousing/request-cancel-booking.php"); 
}
else
    die('Failed');
?>