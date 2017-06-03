<?php session_start();
	require_once('../db.php');
	require_once('../studentsAPI.php');
	// التحقق من السيشن
	if (isset($_SESSION['LoginUser']) && $_SESSION['LoginUser'] != "") {
		 header("Location: studentcontrol.php");
		 exit();
	}

require_once('../db.php');
require_once('../studentsAPI.php');

if(isset($_POST['from']) && $_POST['from'] == "signUp"){
	if(empty($_POST['firstname']) && empty($_POST['middlename']) && empty($_POST['lastname'])
			&& empty($_POST['email']) && empty($_POST['password']) && empty($_POST['confirm-password'])
			&& empty($_POST['dateofbirth']) && empty($_POST['phonenumber'])
			&& empty($_POST['studentnumber']) )
	{
		$_GET['empty_fields'] = 'خطأ: يرجى ملء جميع الحقول';
                header("Location: http://localhost/StudentHousing/Sign_in_up/Sign_in_up.php?empty_fields=خطأ: يرجى ملء جميع الحقول");
	}elseif(sh_users_get_by_email($_POST['email']) != NULL){
		$_GET['email_exist'] = 'خطأ: البريد الإلكتروني موجود مسبقا';
                header("Location: http://localhost/StudentHousing/Sign_in_up/Sign_in_up.php?email_exist=خطأ: البريد الإلكتروني موجود مسبقا");
	}elseif(sh_users_get_by_phone_number($_POST['phonenumber']) != NULL){
		$_GET['phone_exist'] = 'خطأ: رقم الجوال موجود مسبقا';
                header("Location: http://localhost/StudentHousing/Sign_in_up/Sign_in_up.php?phone_exist=خطأ: رقم الجوال موجود مسبقا");
	}elseif(checkStudentId(trim($_POST['studentnumber'])) == true){
		$_GET['student_number'] = 'خطأ: رقم الطالب موجود مسبقا';
                header("Location: http://localhost/StudentHousing/Sign_in_up/Sign_in_up.php?student_number=خطأ: رقم الطالب موجود مسبقا");
	}else{
		$result = sh_users_add(
					trim($_POST['firstname']),
					trim($_POST['middlename']),
					trim($_POST['lastname']),
					trim($_POST['email']),
					trim($_POST['password']),
					trim($_POST['dateofbirth']),
					trim($_POST['phonenumber']),
					trim($_POST['studentnumber']));
		
				if($result){
					$msgError = '<div class="alert alert-success">Success</div>';
					 header("Location: Sign_in_up.php");
				}else{
					$msgError = '<div class="alert alert-danger">Failed</div>';
				}
			sh_db_close();
	}
}elseif(isset($_POST['from']) && $_POST['from'] == "Login" ){
	$username = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);
	$username = mysqli_real_escape_string($conn, $username);
	$password = mysqli_real_escape_string($conn, $password);
	$query = mysqli_query($conn, "SELECT u.*, s.* FROM user AS u LEFT JOIN student AS s ON u.user_id = s.user_id WHERE student_id = '{$username}'");
	$row = mysqli_fetch_array($query);
	$count = mysqli_num_rows($query); 
	if($count == 1){
		if (md5($password) == $row['password']) {
			$_SESSION['LoginUser'] = $row['user_id'];
			$_SESSION['LoginStudent'] = $row['student_id'];
			
			header("Location: ../index.php");
		}else{
			sh_db_close();
                        $_GET['login_error'] = 'خطأ: يرجى التأكد من البيانات';
                        header("Location: http://localhost/StudentHousing/Sign_in_up/Sign_in_up.php?login_error=خطأ: يرجى التأكد من البيانات");
		}
	}else{
		sh_db_close();
                $_GET['login_error'] = 'خطأ: يرجى التأكد من البيانات';
                header("Location: http://localhost/StudentHousing/Sign_in_up/Sign_in_up.php?login_error=خطأ: يرجى التأكد من البيانات");
	}
	sh_db_close();
}
	
						
if($msgError){ echo $msgError; }
?>