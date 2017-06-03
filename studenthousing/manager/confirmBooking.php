<?php


if(!isset($_GET['booking_id']) )
{
    die('Bad Access !');
}

require_once('../db.php');
require_once('../bookingAPI.php');

$result = sh_bookings_confirm_booking($_GET['booking_id']);

sh_db_close();

if($result){
    header("Location: http://localhost/StudentHousing/Manager/manageBookings.php");
}
else
    die('Failed');
?>