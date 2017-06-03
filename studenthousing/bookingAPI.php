<?php

function sh_bookings_get($f = '*',$extra = '')
{
    global $conn;
    $ex = strip_tags($extra);
    $query = sprintf("SELECT %s FROM `booking` %s ",$f,$extra); 
    $qresult = mysqli_query($conn, $query);
    
    if(!$qresult)   
        return NULL;
        
    $rcount = mysqli_num_rows($qresult);
    if($rcount == 0)
        return NULL;
        
    $users = array();
    for($i = 0; $i < $rcount; $i++)
        $users[@count($users)] = mysqli_fetch_object($qresult);
    
    mysqli_free_result($qresult);
    
    return $users;       
}

function sh_bookings_get_by_id($booking_id)
{
    global $conn;
    $id = @mysqli_real_escape_string($conn ,strip_tags($booking_id));
        
    $result = sh_bookings_get('*', 'WHERE `booking_id` = '."'$id'");
    if($result == NULL)
        return NULL;
        
    $user = $result[0];
    return $user;
}

function sh_bookings_get_by_student_id($student_id)
{
    global $conn;
    $id = @mysqli_real_escape_string($conn ,strip_tags($student_id));
    
    $result = sh_bookings_get('*', 'WHERE `student_id` = '."'$id' AND `canceled` = FALSE");
    if($result == NULL)
        return NULL;
        
    $user = $result[0];
    return $user;
}

function sh_bookings_get_by_student_id_without_check_canceled($student_id)
{
    global $conn;
    $id = @mysqli_real_escape_string($conn ,strip_tags($student_id));
    
    $result = sh_bookings_get('*', 'WHERE `student_id` = '."'$id'");
    if($result == NULL)
        return NULL;
        
    return $result;
}

function sh_bookings_check_booking_is_paid($booking_id)
{
    global $conn;
    $id = @mysqli_real_escape_string($conn ,strip_tags($booking_id));
        
    $result = sh_bookings_get('*', 'WHERE `booking_id` = '."'$id'");
    if($result == NULL)
        return NULL;
        
    $booking = $result[0];
    
    if($booking->paid == TRUE){
        return TRUE;
    }
    else{
        return FALSE;
    }
}


function sh_bookings_check_has_booking($student_id)
{
    global $conn;
    
    if((empty($student_id)))
        return false;
        
    $n_student_id = @mysqli_real_escape_string($conn ,strip_tags($student_id));
    
    $result = sh_bookings_get('*', 'WHERE `student_id` = '."'$n_student_id' AND `canceled` = FALSE");
    if($result == NULL)
    {
        return FALSE;
    }
    else if($result[0]->canceled == FALSE){
        return FALSE;
    }
    else {
        return true;
    }
        
}

function sh_bookings_check_cancel_booking($student_id)
{
    global $conn;
    
    if((empty($student_id)))
        return false;
        
    $n_student_id = @mysqli_real_escape_string($conn ,strip_tags($student_id));
    
    $result = sh_bookings_get('*', 'WHERE `student_id` = '."'$n_student_id' AND `canceled` = FALSE");
    if($result != NULL){
        return FALSE;
    }
    else {
        return true;
    }
        
}

function sh_bookings_add($cancel_booking_date, $start_date, $expire_date, $price, $paid, $canceled, $student_id, $apartment_id)
{
    global $conn;
    require_once('apartmentAPI.php');
    
     if( (empty($cancel_booking_date)) || (empty($start_date)) || (empty($expire_date)) || (empty($price)) || 
        (empty($student_id)) || (empty($apartment_id)) )
        return false;
    
    $n_cancel_booking_date = @mysqli_real_escape_string($conn ,strip_tags($cancel_booking_date));
    $n_start_date = @mysqli_real_escape_string($conn ,strip_tags($start_date));
    $n_expire_date = @mysqli_real_escape_string($conn ,strip_tags($expire_date));
    $n_price = @mysqli_real_escape_string($conn ,strip_tags($price));
    $n_student_id = @mysqli_real_escape_string($conn ,strip_tags($student_id));
    $n_apartment_id = @mysqli_real_escape_string($conn ,strip_tags($apartment_id));
    $n_paid = (int)$paid;
    if($n_paid != 0)
        $n_paid = 0;
    $n_canceled = (int)$canceled;
    if($n_canceled != 0)
        $n_canceled = 0;
     
    $query = sprintf("INSERT INTO `booking` VALUE(NULL,'%s','%s','%s','%s',%d,%d,'%s','%s')",$n_cancel_booking_date, $n_start_date, $n_expire_date, $n_price, $n_paid, $n_canceled, $n_student_id, $n_apartment_id);
    $apartment = sh_apartments_get_by_id($n_apartment_id);
    $query_increase_student_number = sh_apartments_increase_one_to_current_student($apartment->apartment_id);
    
    $qresult = mysqli_query($conn, $query);
    
    if(!$qresult && !$query_increase_student_number)
        return false;
    
    return true;    
    
}

function sh_bookings_delete($booking_id)
{
    global $conn;
    require_once('apartmentAPI.php');
    
    $id = @mysqli_real_escape_string($conn ,strip_tags($booking_id));
        
    $query = sprintf("UPDATE `booking` SET `canceled` = TRUE WHERE `booking_id` = '%s'",$id);
    
    $booking = sh_bookings_get_by_id($id);
    $apartment = sh_apartments_get_by_id($booking->apartment_id);
    
    $query_decrease_student_number = sh_apartments_decrease_one_to_current_student($apartment->apartment_id);
    
    $qresult = mysqli_query($conn, $query);
    
    if(!$qresult && !$query_decrease_student_number)
        return false;
        
    return true;

}

function sh_bookings_delete_by_student_id($student_id)
{
    global $conn;
    require_once('apartmentAPI.php');
    $id = @mysqli_real_escape_string($conn ,strip_tags($student_id));
        
    $query = sprintf("UPDATE `booking` SET `canceled` = TRUE WHERE `student_id` = '%s'",$id);  
    $booking = sh_bookings_get_by_student_id($id);
    $apartment = sh_apartments_get_by_id($booking->apartment_id);
    
    $query_decrease_student_number = sh_apartments_decrease_one_to_current_student($apartment->apartment_id);
    
    $qresult = mysqli_query($conn, $query);
    if(!$qresult && !$query_decrease_student_number)
        return false;
        
    return true;

}

function sh_bookings_update()
{
   
}

function sh_bookings_update_apartment($old_apartment, $new_apartment)
{
     global $conn;
    
    $o_apartment = sh_apartments_get_by_id($old_apartment);
    $n_apartment = sh_apartments_get_by_id($new_apartment);
       
    $query = sprintf("UPDATE booking SET `apartment_id` = '%s' WHERE apartment_id = '%s'",$n_apartment->apartment_id,$o_apartment->apartment_id);
    $r = mysqli_query($conn, $query);
    
    if(!$r)
        return FALSE;
    
    return TRUE;
}


function sh_bookings_confirm_booking($booking_id){
    global $conn;
    $id = @mysqli_real_escape_string($conn ,strip_tags($booking_id));
     
    $query = sprintf("UPDATE `booking` SET `paid` = TRUE WHERE `booking_id` = '%s'",$id);
    
    $qresult = mysqli_query($conn, $query);
    
    if(!$qresult)
        return false;
        
    return true;
    
}

function sh_bookings_cencel_booking($booking_id){
    global $conn;
    $id = @mysqli_real_escape_string($conn ,strip_tags($booking_id));
     
    $query = sprintf("UPDATE `booking` SET `canceled` = TRUE WHERE `booking_id` = '%s'",$id);
    
    $qresult = mysqli_query($conn, $query);
    
    if(!$qresult)
        return false;
        
    return true;
    
}

function sh_bookings_check_booking_expiration(){
    global $conn;
        
    $bookings = sh_bookings_get();
    
    if($bookings != NULL){
    
        foreach($bookings as $booking){
            date_default_timezone_set('Asia/Riyadh');

            if(strtotime($booking->expire_date) < time() && $booking->canceled == FALSE){
                sh_bookings_cencel_booking($booking->booking_id);
                sh_apartments_decrease_one_to_current_student($booking->apartment_id);
            }

            if( (strtotime($booking->booking_date) < time()) && ($booking->paid == FALSE && $booking->canceled == FALSE)){
                sh_bookings_cencel_booking($booking->booking_id);
                sh_apartments_decrease_one_to_current_student($booking->apartment_id);
            }

        }
    }
}





?>


