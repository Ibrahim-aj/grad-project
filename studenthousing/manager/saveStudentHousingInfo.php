<?php

    if(!isset($_POST['price1']) || !isset($_POST['price2']) || !isset($_POST['price3']) 
            || !isset($_POST['start_date_bookings']) || !isset($_POST['expire_date_bookings']) 
            || !isset($_POST['start_date_booking'])
            || !isset($_POST['number_of_days_before_cancel_booking'])
            || !isset($_POST['first_term']) || !isset($_POST['second_term']) || !isset($_POST['summer_term']))
    {
        die('Bad Access !');
    }

    require_once('../db.php');
    require_once('studentHousingAPI.php');
    
    $result = sh_studenthousing_update($_POST['price1'], $_POST['price2'], $_POST['price3'], $_POST['start_date_bookings'],
            $_POST['expire_date_bookings'], $_POST['start_date_booking'], $_POST['number_of_days_before_cancel_booking'],
            $_POST['first_term'], $_POST['second_term'], $_POST['summer_term']);
    
    if($result == FALSE)
    {
        sh_db_close();
        die("Error !!");
    }
    
     header("Location: http://localhost/StudentHousing/Manager/manageStudentHousing.php");

?>
