<?php


if(!isset($_GET['request_id']) )
{
    die('Bad Access !');
}

require_once('../db.php');
require_once('../bookingAPI.php');
require_once('../apartmentAPI.php');
require_once('../RequestChangeApartmentAPI.php');
require_once('../studentsAPI.php');

//get the request
$request = sh_requestchangeapartment_get_by_id($_GET['request_id']);
if($request == NULL){
    sh_db_close();
    die("There is no request");
}
//get booking by student id
$booking = sh_bookings_get_by_student_id($request->student_id);
if($booking == NULL){
    sh_db_close();
    die("There is no booking");
}
//check if old apartment < 0 and new apartment < max number of studemt
$old_apartment = sh_apartments_get_by_id($booking->apartment_id);
$new_apartment = sh_apartments_get_by_id($request->apartment_requested);
if($old_apartment->current_number_of_students <= 0){
    sh_db_close();
    die ('Old apartment has ZERO students, cannot decrease number of students');
}
if($new_apartment->current_number_of_students >= $new_apartment->max_number_of_students){
    sh_db_close();
    die ('New apartment has MAX number of students, cannot increase number of students');
}
//decreace number of old apartment
$result_decrease_old_apartment = sh_apartments_decrease_one_to_current_student($booking->apartment_id);
if($result_decrease_old_apartment == FALSE){
    sh_db_close();
    die("Problem in decrease number of apartment");
}
//increase number of new apartment
$result_increase_new_apartment = sh_apartments_increase_one_to_current_student($request->apartment_requested);
if($result_increase_new_apartment == FALSE){
    sh_db_close();
    die("Problem in increase number of apartment");
}
//change status of request accepted
$result_request = sh_requestchangeapartment_update_status($_GET['request_id']);
if($result_request == FALSE){
    sh_db_close();
    die("Problem in change request's status");
}
//change apartment of booking
$result_booking = sh_bookings_update_apartment($booking->apartment_id, $request->apartment_requested);
if($result_booking == FALSE){
    sh_db_close();
    die("Problem in change booking's apartment");
}
$done = sh_requestchangeapartment_update_done($request->request_id);
if($done == FALSE){
    sh_db_close();
    die("Problem in change booking's apartment");
}

sh_db_close();

if($result_decrease_old_apartment && $result_increase_new_apartment && $result_booking && $result_request){
    header("Location: http://localhost/StudentHousing/Manager/manageRequestChangeApartment.php");
}
else
    die('Failed');
?>