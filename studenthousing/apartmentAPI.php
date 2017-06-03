<?php

function sh_apartments_get($f = '*',$extra = '')
{
    global $conn;
    $ex = strip_tags($extra);
    $query = sprintf("SELECT %s FROM `apartment` %s ",$f,$extra); 
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

function sh_apartments_get_by_id($apartment_id)
{
    global $conn;
    $id = @mysqli_real_escape_string($conn ,strip_tags($apartment_id));
        
    $result = sh_apartments_get('*', 'WHERE `apartment_id` = '."'$id'");
    if($result == NULL)
        return NULL;
        
    $user = $result[0];
    return $user;
}

function sh_apartments_get_by_student_id($student_id)
{
    global $conn;
    $id = @mysqli_real_escape_string($conn ,strip_tags($student_id));
    
    require_once('bookingAPI.php');
    
    //check if student has booking and get from it number of apartment 
    $has_booking = sh_bookings_get_by_student_id($id);
    if($has_booking == NULL)
        return FALSE;
    
    $result = sh_apartments_get('*', 'WHERE `apartment_id` = '."'$has_booking->apartment_id'");
    if($result == NULL)
        return NULL;
        
    $user = $result[0];
    return $user;
}

function sh_apartments_check_by_id($apartment_id)
{
    global $conn;
    $id = @mysqli_real_escape_string($conn ,strip_tags($apartment_id));
        
    $result = sh_apartments_get('*', 'WHERE `apartment_id` = '."'$id'");
    if($result == NULL)
        return FALSE;
        
    return TRUE;
}

function sh_apartments_get_by_free_places()
{
    $result = sh_apartments_get('*', 'WHERE `current_number_of_students` < `max_number_of_students`');
    if($result == NULL)
        return NULL;

    return $result; 
}

function sh_apartments_add($fname, $minit, $lname, $email, $password, $dob, $phone, $student_id)
{
    global $conn;
    
    $query = sprintf("INSERT INTO `aparmtent` VALUE(NULL,NULL,NULL)");
    
    $qresult = mysqli_query($conn, $query);
    if(!$qresult)
        return false;
    
    return true;    
    
}

function sh_apartments_delete($apartment_id)
{
    global $conn;
    $id = @mysqli_real_escape_string($conn ,strip_tags($apartment_id));
        
    $query = sprintf("DELETE FROM `apartment` WHERE `apartment_id` = %d",$id);
    
    $qresult = mysqli_query($conn, $query);
    if(!$qresult)
        return false;
        
    return true;

}

function sh_apartments_update()
{
   
}

function sh_apartments_increase_one_to_current_student($apartment_id){
    
    
    global $conn;
    
    $apartment = sh_apartments_get_by_id($apartment_id);
    $increase_students_number = $apartment->current_number_of_students + 1;
    
    if($increase_students_number > $apartment->max_number_of_students)
        return FALSE;
    
    $query = sprintf("UPDATE apartment SET `current_number_of_students` = %d WHERE apartment_id = '%s'",$increase_students_number,$apartment_id);
    $r = mysqli_query($conn, $query);
    
    if(!$r)
        return FALSE;
    
    return TRUE;
    
}

function sh_apartments_decrease_one_to_current_student($apartment_id){
    
    
    global $conn;
    
    $apartment = sh_apartments_get_by_id($apartment_id);
    $decrease_students_number = $apartment->current_number_of_students - 1;
    
    if($decrease_students_number < 0)
        return FALSE;
    
    $query = sprintf("UPDATE apartment SET `current_number_of_students` = %d WHERE apartment_id = '%s'",$decrease_students_number,$apartment_id);
    $r = mysqli_query($conn, $query);
    
    if(!$r)
        return FALSE;
    
    return TRUE;
    
}

?>


