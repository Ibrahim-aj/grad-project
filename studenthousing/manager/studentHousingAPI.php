<?php

function sh_studenthousing_get($f = '*',$extra = ''){
    global $conn;
    $ex = strip_tags($extra);
    $query = sprintf("SELECT %s FROM `student_housing_info` %s ",$f,$extra); 
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
    
    return $users[0];  
}

function sh_studenthousing_update($price1 = NULL, $price2  = NULL, $price3  = NULL, $start_date_of_bookings  = NULL, $end_date_of_bookings  = NULL,
        $start_date_of_new_booking  = NULL, $number_of_days_before_cancel_booking  = NULL, $term1  = NULL, $term2  = NULL, $term3  = NULL){
    
    
    global $conn;
    
    if( (empty($price1)) && (empty($price2)) && (empty($price3)) && (empty($start_date_of_bookings)) && (empty($end_date_of_bookings))
            && (empty($start_date_of_new_booking)) && (empty($number_of_days_before_cancel_booking)) && (empty($term1))  && (empty($term2)) && (empty($term3)) )
        return false;
    
    $p1 = (float) $price1;
    $p2 = (float) $price2;
    $p3 = (float) $price3;
    
    $start_date = @mysqli_real_escape_string($conn ,strip_tags($start_date_of_bookings));
    $end_date = @mysqli_real_escape_string($conn ,strip_tags($end_date_of_bookings));
    
    $new_start_date = @mysqli_real_escape_string($conn ,strip_tags($start_date_of_new_booking));
    $new_start_date_of_new_booking = @mysqli_real_escape_string($conn ,strip_tags($number_of_days_before_cancel_booking));
    
    $t1 = (int) $term1;
    $t2 = (int) $term2;
    $t3 = (int) $term3;

    $fields = array();
    $query = 'UPDATE `student_housing_info` SET ';
    
    if(!empty($p1))
    {
        $fields[@count($fields)] = "`PRICE_OF_ONE_TERM` = '$p1'"; 
    }
    if(!empty($p2))
    {
        $fields[@count($fields)] = "`PRICE_OF_TWO_TERM` = '$p2'"; 
    }
    if(!empty($p3))
    {
        $fields[@count($fields)] = "`PRICE_OF_THREE_TERM` = '$p3'"; 
    }
    if(!empty($start_date))
    {
        $fields[@count($fields)] = "`TIME_OF_STARTING_BOOKINGS` = '$start_date'"; 
    }
    if(!empty($end_date))
    {
        $fields[@count($fields)] = "`TIME_OF_ENDING_BOOKINGS` = '$end_date'"; 
    }
    if(!empty($new_start_date))
    {
        $fields[@count($fields)] = "`START_DATE_OF_NEW_BOOKING` = '$new_start_date'"; 
    }
    if(!empty($new_start_date_of_new_booking))
    {
        $fields[@count($fields)] = "`NUMBER_OF_DAYS_BEFORE_CANCEL_BOOKING` = '$new_start_date_of_new_booking'"; 
    }
    if(!empty($t1))
    {
        $fields[@count($fields)] = "`TIME_OF_FIRST_TERM` = '$t1'"; 
    }
    if(!empty($t2))
    {
        $fields[@count($fields)] = "`TIME_OF_SECOND_TERM` = '$t2'"; 
    }
    if(!empty($t3))
    {
        $fields[@count($fields)] = "`TIME_OF_SUMMER_TERM` = '$t3'"; 
    }
    
    $count = @count($fields);
    if($count == 1)
    {
        $query .= $fields[0];
        $qresult = mysqli_query($conn, $query);
        if(!$qresult)
            return false;
        else
            return true;
    }
    
    for($i = 0; $i < $count; $i++)
    {
        $query .= $fields[$i];
        if($i != ($count - 1))
            $query .=' , ';
    }   
    
    $query .=  '';
    $qresult = @mysqli_query($conn, $query);
    
    echo $query;
    
    if(!$qresult)
        return FALSE;
    
    return TRUE;
    
}


function sh_studenthousing_check_can_booking(){
    
    global $conn;
    $r = sh_studenthousing_get();
    
    if( (strtotime($r->TIME_OF_STARTING_BOOKINGS) <= time()) && time() <= (strtotime($r->TIME_OF_ENDING_BOOKINGS)) ){
        Return TRUE;
    }
    else{
        return FALSE;
    }
    
}


?>

