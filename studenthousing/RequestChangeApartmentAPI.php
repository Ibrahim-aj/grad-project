<?php

function sh_requestchangeapartment_get($f = '*',$extra = '')
{
    global $conn;
    $ex = strip_tags($extra);
    $query = sprintf("SELECT %s FROM `request_change_apartment` %s ",$f,$extra); 
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

function sh_requestchangeapartment_get_by_id($uid)
{
    global $conn;
    $id = @mysqli_real_escape_string($conn ,strip_tags($uid));
        
    $result = sh_requestchangeapartment_get('*', 'WHERE `request_id` = '."'$id'");
    if($result == NULL)
        return NULL;
        
    $user = $result[0];
    return $user;
}

function sh_requestchangeapartment_get_all_by_student_id($uid)
{
    global $conn;
    $id = @mysqli_real_escape_string($conn ,strip_tags($student_id));
    
        
    $result = sh_requestchangeapartment_get('*', 'WHERE `student_id` = '."'$id'");
    if($result == NULL)
        return NULL;
        
    $user = $result;
    return $user;
}

function sh_requestchangeapartment_get_by_student_id($student_id)
{
    global $conn;
    $id = @mysqli_real_escape_string($conn ,strip_tags($student_id));
    
        
    $result = sh_requestchangeapartment_get('*', 'WHERE `student_id` = '."'$id'".' AND `done` = 0');
    if($result == NULL)
        return NULL;
      
    $user = $result[0];
    return $user;
}


function sh_requestchangeapartment_check_student_has_apartment($student_id)
{
    global $conn;
    $id = @mysqli_real_escape_string($conn ,strip_tags($student_id));
    
    require_once 'apartmentAPI.php';
    require_once 'bookingAPI.php';
    
    // check if student has booking
    $r = sh_bookings_check_has_booking($id);
    if($r != false)
        return FALSE;
    
    //get apartment whick book by booking above
    $student_apartment = sh_bookings_get_by_student_id($id);
    if($student_apartment == NULL)
        return FALSE;
    
    //check value of paid in booking
    if($student_apartment->paid == false)
        return FALSE;
   
    //check if apartment in booking match witch apartment table
    $r = sh_apartments_check_by_id($student_apartment->apartment_id);
    if($r == false)
        return FALSE;

    return TRUE; 
}

function sh_requestchangeapartment_check_student_has_rquest_change_apartment($student_id)
{
    global $conn;
    $id = @mysqli_real_escape_string($conn ,strip_tags($student_id));
      
    require_once('bookingAPI.php');
    
    $r = sh_requestchangeapartment_get_by_student_id($id);
    if($r != NULL){
        $booking = sh_bookings_get_by_id($r->booking_id);

        if($booking->canceled == FALSE)
            return FALSE;
    }
    
    return TRUE; 
}

function sh_requestchangeapartment_add($student_id, $booking_id, $status, $done, $apartment_requested_id)
{
    global $conn;
    
     if( (empty($student_id)) || (empty($booking_id)) ||  (empty($status)) || (empty($apartment_requested_id)) )
        return false;
    
    $n_student_id = @mysqli_real_escape_string($conn ,strip_tags($student_id));
    $n_booking_id = @mysqli_real_escape_string($conn ,strip_tags($booking_id));
    $n_status = @mysqli_real_escape_string($conn ,strip_tags($status));
    $n_apartment_requested_id = @mysqli_real_escape_string($conn ,strip_tags($apartment_requested_id));
     
    $n_done = (int)$done;
    if($n_done != 0)
        $n_done = 0;
    
    $query = sprintf("INSERT INTO `request_change_apartment` VALUE(NULL,'%s','%s','%s',%d,'%s')",$n_student_id, $n_booking_id, $n_status, $n_done, $n_apartment_requested_id);
    
    $qresult = mysqli_query($conn, $query);
    if(!$qresult)
        return false;
    
    return true;   
    
}

function sh_requestchangeapartment_delete($uid)
{
    global $conn;
    $id = (int)$uid;
    if($id == 0)
        return false;
        
    $query = sprintf("DELETE FROM `request_change_apartment` WHERE `request_id` = %d",$id);
    
    $qresult = mysqli_query($conn, $query);
    if(!$qresult)
        return false;
        
    return true;

}

function sh_requestchangeapartment_update()
{
    
}

function sh_requestchangeapartment_update_status($request_id)
{
    global $conn;
    
    $id =  @mysqli_real_escape_string($conn ,strip_tags($request_id));
    $status = "موافق عليه";
       
    $query = sprintf("UPDATE `request_change_apartment` SET `status` = '%s' WHERE `request_id` = '%s'",$status, $id);
    
    $r = mysqli_query($conn, $query);
    
    if(!$r)
        return FALSE;
    
    return TRUE;
}

function sh_requestchangeapartment_update_done($request_id)
{
    global $conn;
    
    $id =  @mysqli_real_escape_string($conn ,strip_tags($request_id));

    $query = sprintf("UPDATE `request_change_apartment` SET `done` = TRUE WHERE `request_id` = '%s'", $id);
    
    $r = mysqli_query($conn, $query);
    
    if(!$r)
        return FALSE;
    
    return TRUE;
}

function sh_requestchangeapartment_check_if_student_has_booking_of_request_and_update($request_id)
{
   
}

?>


