<?php

function sh_users_get($f = '*',$extra = '')
{
    global $conn;
    $ex = strip_tags($extra);
    $query = sprintf("SELECT %s FROM `user` %s ",$f,$extra); 
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

function sh_users_get_by_id($uid)
{
    global $conn;
    $id = mysqli_real_escape_string($conn ,strip_tags($uid));
        
    $result = sh_users_get('*', 'WHERE `user_id` = '."'$id'");
    if($result == NULL)
        return NULL;
        
    $user = $result[0];
    return $user;
}

function sh_users_get_by_student_id($student_id)
{
    global $conn;
    $id = mysqli_real_escape_string($conn ,strip_tags($student_id));

    $student = sh_student_get_by_student_id($id);
     
    $result = sh_users_get('*', 'WHERE `user_id` = '."'$student->user_id'");
    if($result == NULL)
        return NULL;
        
    $user = $result[0];
    return $user;
}

function sh_student_get_by_user_id($user_id)
{
    global $conn;
    $id = mysqli_real_escape_string($conn ,strip_tags($user_id));
    
    $query = sprintf("SELECT * FROM `student` WHERE user_id = '%s'",$id); 
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

function sh_student_get_by_student_id($user_id)
{
    global $conn;
    $id = mysqli_real_escape_string($conn ,strip_tags($user_id));
    
    $query = sprintf("SELECT * FROM `student` WHERE student_id = '%s'",$id); 
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

function sh_users_get_by_email($email)
{
    global $conn;
    $n_email = mysqli_real_escape_string($conn ,strip_tags($email));
    $result = sh_users_get('*', "WHERE `email` = '$n_email'");
    
    if($result != NULL)
        $user = $result[0];
    else
        $user = NULL;
    
    return $user;
}
function sh_users_get_by_phone_number($email)
{
    global $conn;
    $n_email = mysqli_real_escape_string($conn ,strip_tags($email));
    $result = sh_users_get('*', "WHERE `phone_number` = '$n_email'");
    
    if($result != NULL)
        $user = $result[0];
    else
        $user = NULL;
    
    return $user;
}

function sh_users_add($fname, $minit, $lname, $email, $password, $dob, $phone, $student_id)
{
    global $conn;
    if((empty($fname)) || (empty($minit)) || (empty($lname)) || 
        (empty($email)) || (empty($password)) || (empty($dob)) || (empty($phone)) || (empty($student_id)) )
        return false;
        
    $n_email = @mysqli_real_escape_string($conn, strip_tags($email));
    if(!filter_var($n_email,FILTER_VALIDATE_EMAIL))
        return false;
    $n_fname = @mysqli_real_escape_string($conn ,strip_tags($fname));
    $n_minit = @mysqli_real_escape_string($conn ,strip_tags($minit));
    $n_lname = @mysqli_real_escape_string($conn ,strip_tags($lname));
    $n_password = @md5(mysqli_real_escape_string($conn , strip_tags($password)));
    $n_dob = @mysqli_real_escape_string($conn ,strip_tags($dob));
    $n_phone = @mysqli_real_escape_string($conn ,strip_tags($phone));
    $n_student_id = @mysqli_real_escape_string($conn ,strip_tags($student_id));
    
    $query = sprintf("INSERT INTO `user` VALUE(NULL,'%s','%s','%s','%s','%s','%s','%s')",$n_fname, $n_minit, $n_lname, $n_email, $n_password, $n_dob, $n_phone);
    
    $qresult = mysqli_query($conn, $query);
    if(!$qresult)
        return false;
        
    $user_student_id = sh_users_get_by_email($n_email);
    
    $query = sprintf("INSERT INTO `student` VALUE('%s','%s',NULL)",$user_student_id->user_id, $n_student_id);
    
    $qresult = mysqli_query($conn, $query);
    if(!$qresult)
        return false;
    
    return true;    
    
}

function sh_users_delete($uid)
{
    global $conn;
    $id = mysqli_real_escape_string($conn ,strip_tags($uid));
        
    $query = sprintf("DELETE FROM `student` WHERE `student_id` = %d",$id);
    
    $qresult = mysqli_query($conn, $query);
    if(!$qresult)
        return false;
        
    return true;

}

function sh_users_update($uid, $fname = NULL, $minit  = NULL, $lname  = NULL, $email  = NULL, $password  = NULL, $dob  = NULL, $phone  = NULL, $student_id  = NULL)
{
    global $conn;
    $id = mysqli_real_escape_string($conn ,strip_tags($uid));
      
    $user = sh_users_get_by_id($id);
    if(!$user)
        return false;
        
        
    if( (empty($fname)) && (empty($minit)) && (empty($lname)) && (empty($email)) && (empty($password)) && (empty($dob)) && (empty($phone)) /* && (empty($student_id))*/ )
        return false;
        
    $fields = array();
    $query = 'UPDATE `user` SET ';
    
    if(!empty($email))
    {
        $n_email = mysqli_real_escape_string($conn, strip_tags($email));
        if(!filter_var($n_email,FILTER_VALIDATE_EMAIL))
            return false;
        $fields[@count($fields)] = "`email` = '$n_email'"; 
    }
    if(!empty($fname))
    {
        $n_fname = mysqli_real_escape_string($conn, strip_tags($fname));
        $fields[@count($fields)] = "`first_name` = '$n_fname'"; 
    }
    if(!empty($minit))
    {
        $n_minit = mysqli_real_escape_string($conn, strip_tags($minit));
        $fields[@count($fields)] = "`middle_name` = '$n_minit'"; 
    }
    if(!empty($lname))
    {
        $n_lname = mysqli_real_escape_string($conn, strip_tags($lname));
        $fields[@count($fields)] = "`last_name` = '$n_lname'"; 
    }
    if(!empty($password))
    {
        $n_password = md5(mysqli_real_escape_string($conn,strip_tags($password)));
        $fields[@count($fields)] = "`password` = '$n_password'"; 
    }
    if(!empty($dob))
    {
        $n_dob = mysqli_real_escape_string($conn, strip_tags($dob));
        $fields[@count($fields)] = "`date_of_birth` = '$n_dob'"; 
    }
        if(!empty($phone))
    {
        $n_phone = mysqli_real_escape_string($conn, strip_tags($phone));
        $fields[@count($fields)] = "`phone_number` = '$n_phone'"; 
    }
    /*if(!empty($student_id))
    {
        $n_student_id = mysqli_real_escape_string($conn, strip_tags($student_id));
        $fields[@count($fields)] = "`student_id` = '$n_student_id'"; 
    }*/
    
    
    
    $fcount = @count($fields);
    if($fcount == 1)
    {
        $query .= $fields[0].' WHERE `user_id` = '."'$id'";
        $qresult = mysqli_query($conn, $query);
        if(!$qresult)
            return false;
        else
            return true;
    }
    
    for($i = 0; $i < $fcount; $i++)
    {
        $query .= $fields[$i];
        if($i != ($fcount - 1))
            $query .=' , ';
    }    
    
    $query .=  ' WHERE `user_id` = '."'$id'";
    $qresult = mysqli_query($conn, $query);
    
    
    if(!$qresult)
        return false;
    else
        return true;
    
}


// function from sultan
function checkStudentId($id){
	global $conn;
	
	$query = mysqli_query($conn, " SELECT * FROM student WHERE student_id = '{$id}'");
	if(mysqli_num_rows($query) == 1){
		return true;
	}else{
		return false;
	}
}

function checkSession(){
	if (!isset($_SESSION['LoginUser']) && $_SESSION['LoginUser'] == "") {
		header("Location: http://localhost/StudentHousing/Sign_in_up/Sign_in_up.php");
	}
}
?>


