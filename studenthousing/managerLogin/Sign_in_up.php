<?php session_start();
	require_once('../db.php');
	require_once('../studentsAPI.php');
	// التحقق من السيشن
	if (isset($_SESSION['LoginAdmin']) && $_SESSION['LoginAdmin'] != "") {
		 header("Location: index.php");
		 exit();
	}
?>
<!DOCTYPE html>
<html>
<head>


    <meta charset="UTF-8">
    <!--main css-->
    <link rel="stylesheet" href="bootstrap.css">

    <!--custom css-->
    <link rel="stylesheet" href="style.css"/>
    <title>سكن جامعة طيبة</title>


</head>

<body>


<

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                          	<font face="cairo" size="3">
							
							<h3> تسجيل الدخول للمدير </h3>
							
							</font>
                        </div>
                        <div class="col-xs-6">
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-8 col-sm-6">

<?php
if(isset($_POST['from']) && $_POST['from'] == "Login" ){
	$username = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);
	$username = mysqli_real_escape_string($conn, $username);
	$password = mysqli_real_escape_string($conn, $password);
	$query = mysqli_query($conn, "SELECT u.*, m.* FROM user AS u LEFT JOIN manager AS m ON u.user_id = m.user_id WHERE m.manager_id = '{$username}'")or die(mysqli_error($conn));
	$row = mysqli_fetch_array($query);
	$count = mysqli_num_rows($query); 
	if($count == 1){
		if (md5($password) == $row['password']) {
			$_SESSION['LoginAdmin'] = $row['user_id'];
			
			header("Location: ../manager/index.php");
		}else{
			sh_db_close();
            $msgError = '<div class="alert alert-danger">خطأ: يرجى التأكد من البيانات</div>';
		}
	}else{
		sh_db_close();
           $msgError = '<div class="alert alert-danger">خطأ: يرجى التأكد من البيانات</div>';
	}
	sh_db_close();
}
	
						
if(isset($msgError) && $msgError != ""){ echo $msgError; }
?>

                            <form id="login-form" action="Sign_in_up.php" method="post" role="form"
                                  style="display: block;"><!-- change the action to main page-->

                                <!-- بداية رسائل الاخطاء والعمليات الناجحة -->


                        <!-- نهاية رسائل الاخطاء والعمليات الناجحة -->
                        <!-------------------------------------->
                        <div class="form_group">
                            <label>Manger number</label>

                            <input type="text" name="username" id="username" tabindex="2"
                                   minlength="7" maxlength="7" class="form-control" placeholder="XXXXXXX" value="" required="">

                        </div>
                        <!-------------------------------------->

                        <div class="form-group">
                            <label>Password</label>

                            <input type="password" name="password" id="password" tabindex="2"
                                   class="form-control" placeholder="Password" required="">
                        </div>
                        <div class="form-group text-center">
                            <input type="checkbox" tabindex="3" class=""  name="remember" id="remember">
                            <label for="remember"> تذكر معلومات الدخول؟</label>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3 col-lg ">
                                    <input type="submit" name="login-submit" id="login-submit" tabindex="4"
                                           class="form-control btn btn-login" value="الدخول">
                                    <input type="hidden" name="from" id="from" value="Login">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">

                            </div>
                        </div>
                </form>
                    </div>
                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!jquary script>
<script src="../js/jquery.js"></script>
<script type="text/javascript" src="FScript.js"></script>

<!jquary script>
<script src="bootstrap.js"></script>


<!--bootstrap code-->

</body>
</html>