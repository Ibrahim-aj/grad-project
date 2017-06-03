<?php

session_start();
// التحقق من السيشن
if (!isset($_SESSION['LoginUser']) && $_SESSION['LoginUser'] == "") {
		header("Location: http://localhost/StudentHousing/Sign_in_up/Sign_in_up.php");
}


if(!isset($_POST['terms']) || !isset($_POST['apartment_id']) )
{
    die('Bad Access !');
}

require_once('db.php');
require_once('studentsAPI.php');
require_once('bookingAPI.php');
require_once('manager/studentHousingAPI.php');
    
$info = sh_studenthousing_get();

if($info == NULL){
    sh_db_close();
    die('Error !!');
}

$start_date = "$info->START_DATE_OF_NEW_BOOKING";
$expire_date;
$format_expire_date;
$price;

if(isset($_POST['terms']) )
{
    switch ($_POST['terms']){
        case '1': 
            $expire_date = strtotime($start_date." +$info->TIME_OF_FIRST_TERM month");
            $format_expire_date = date('Y-m-d', $expire_date);
            $price = $info->PRICE_OF_ONE_TERM;
            ;break;
        case '2': 
            $expire_date = strtotime($start_date." +$info->TIME_OF_SECOND_TERM month");
            $format_expire_date = date('Y-m-d', $expire_date);
            $price = $info->PRICE_OF_TWO_TERM;
            ;break;
        case '3': 
            $expire_date = strtotime($start_date." +$info->TIME_OF_SUMMER_TERM month");
            $format_expire_date = date('Y-m-d', $expire_date);
            $price = $info->PRICE_OF_THREE_TERM;
            ;break;
    }
}




$student = sh_student_get_by_user_id("{$_SESSION['LoginUser']}");
$user = sh_bookings_check_has_booking($student->student_id);
$check_cancel_booking = sh_bookings_check_cancel_booking($student->student_id);

/*if($user == false)
{
    sh_db_close();
    $_SESSION['has_booking_already'] = 'لاتستطيع حجز شقة لأن لديك حجز بالفعل';
    header("Location: http://localhost/StudentHousing/index.php");
}*/
if($check_cancel_booking == false)
{
    sh_db_close();
    $_SESSION['has_booking_already'] = 'لاتستطيع حجز شقة لأن لديك حجز بالفعل';
    header("Location: http://localhost/StudentHousing/index.php");
}

$cancel_booking_date_before_paid = date('Y-m-d', strtotime("+$info->NUMBER_OF_DAYS_BEFORE_CANCEL_BOOKING day"));

$result = sh_bookings_add($cancel_booking_date_before_paid, $start_date, $format_expire_date, $price, 0, 0, $student->student_id, trim($_POST['apartment_id']) );

sh_db_close();

if($result){
   $_SESSION['booking_successful'] = 'تم حجز الشقة بنجاح';
   header("Location: http://localhost/StudentHousing/index.php");
}
else
    die('Failed');
?>