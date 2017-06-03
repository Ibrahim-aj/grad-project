<?php

session_start();
// التحقق من السيشن
if (!isset($_SESSION['LoginUser']) && $_SESSION['LoginUser'] == "") {
		header("Location: http://localhost/StudentHousing/Sign_in_up/Sign_in_up.php");
}

if(!isset($_POST['fname']) || !isset($_POST['mname']) || !isset($_POST['lname'])
        || !isset($_POST['email']) || !isset($_POST['password'])
        || !isset($_POST['dob']) || !isset($_POST['phone'])
        )
{
    die('Bad Access !');
}


require_once('db.php');
require_once('studentsAPI.php');



$user = sh_users_get_by_email($_POST['email']);
if($user != NULL && ($user->user_id != "{$_SESSION['LoginUser']}")) 
{
    sh_db_close();
    $_SESSION['email_exist'] = 'البريد الإلكتروني موجود مسبقا';
    header("Location: http://localhost/StudentHousing/modifyStudentInfo.php");
}

$user = sh_users_get_by_phone_number($_POST['phone']);
if($user != NULL && ($user->user_id != "{$_SESSION['LoginUser']}"))
{
    sh_db_close();
    $_SESSION['phone_exist'] = 'رقم الهاتف موجود مسبقا';
    header("Location: http://localhost/StudentHousing/modifyStudentInfo.php");
}

$pass = trim($_POST['password']);

if(strlen($pass) == 0)
    $pass = NULL;
    
$result = sh_users_update("{$_SESSION['LoginUser']}",
        trim($_POST['fname']), trim($_POST['mname']), trim($_POST['lname']),
        trim($_POST['email']), trim($_POST['password']),
        trim($_POST['dob']), trim($_POST['phone']), NULL);

sh_db_close();

if($result){
    $_SESSION['update_successful'] = 'نم تعديل البيانات بنجاح';
    header("Location: http://localhost/StudentHousing/modifyStudentInfo.php");
}
else
    die('Failed');
?>