<?php
session_start();
// التحقق من السيشن
if (!isset($_SESSION['LoginUser']) && $_SESSION['LoginUser'] == "") {
		header("Location: http://localhost/StudentHousing/Sign_in_up/Sign_in_up.php");
}

/*if(!isset($_POST['terms']) || !isset($_POST['apartment_id']) )
{
    die('Bad Access !');
}*/

require_once('db.php');
require_once('studentsAPI.php');
require_once('bookingAPI.php');

$student = sh_student_get_by_user_id("{$_SESSION['LoginUser']}");
$user = sh_bookings_check_has_booking($student->student_id);

if($user != false)
{
    sh_db_close();
    $_SESSION['has_booking_for_cancel'] = 'لا يوجد لديك حجز لإلغائه';
    header("Location: http://localhost/StudentHousing/cancel-booking.php");
}

//check booking is not paid
$booking = sh_bookings_get_by_student_id($student->student_id);
$is_paid = sh_bookings_check_booking_is_paid($booking->booking_id);
if($is_paid != FALSE){
    sh_db_close();
    $_SESSION['booking_is_paid'] = 'لاتستطيع إلغاء الحجز لأن مبلغ الحجز مدفوع';
    header("Location: http://localhost/StudentHousing/cancel-booking.php");
}

$result = sh_bookings_delete_by_student_id($student->student_id);

sh_db_close();

if($result){
    $_SESSION['cancel_booking_successful'] = 'تم الغاء الحجز بنجاح';
    header("Location: http://localhost/StudentHousing/cancel-booking.php");
}
else
    die('Failed');
?>