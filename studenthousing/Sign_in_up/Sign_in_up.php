<!DOCTYPE html>
<html>
<head>


    <meta charset="UTF-8">
    <!--main css-->
    <link rel="stylesheet" href="bootstrap.css">

    <!--custom css-->
    <link rel="stylesheet" href="style.css"/>
    <title>نظام سكن جامعة طيبة</title>


</head>

<body>
<div class="container">


    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="active" id="login-form-link">الدخول</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="#" id="register-form-link">التسجيل لأول مرة</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <!--------------------------- LOG IN PART------------------------------------------------>
                            <form id="login-form" action="saveUser_Student.php" method="post" role="form"
                                  style="display: block;"><!-- change the action to main page-->
                                
                                     <!-- بداية رسائل الاخطاء والعمليات الناجحة -->
                          
                          <?php 
                            if (!empty($_GET['login_error'])) {
                              echo "<div class=\"alert alert-danger\" role=\"alert\">{$_GET['login_error']}</div>";
                              unset($_GET['login_error']);
                            }
                            
                            
                          ?>
                          <!-- نهاية رسائل الاخطاء والعمليات الناجحة -->
                             <!-------------------------------------->
                                <div class="form_group">
                                    <label>Student number</label>

                                    <input type="text" name="username" id="user_id" tabindex="2"
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
                                    </div>
                                </div>
                            </form>




                            <!-----------------------RIGSTER IN PART--------------------------------------------->
                            <form name="form1" id="register-form" action="saveUser_Student.php" method="post"
                                  role="form" style="display:none;" > <!-- change the action to sing in page-->

                                 <!-- بداية رسائل الاخطاء والعمليات الناجحة -->
                          
                          <?php 
                            if (!empty($_GET['empty_fields'])) {
                              echo "<div class=\"alert alert-danger\" role=\"alert\">{$_GET['empty_fields']}</div>";
                              unset($_GET['empty_fields']);
                            }
                            if (!empty($_GET['email_exist'])) {
                              echo "<div class=\"alert alert-danger\" role=\"alert\">{$_GET['email_exist']}</div>";
                              unset($_GET['email_exist']);
                            }
                            if (!empty($_GET['phone_exist'])) {
                              echo "<div class=\"alert alert-danger\" role=\"alert\">{$_GET['phone_exist']}</div>";
                              unset($_GET['phone_exist']);
                            }
                            if (!empty($_GET['student_number'])) {
                              echo "<div class=\"alert alert-danger\" role=\"alert\">{$_GET['student_number']}</div>";
                              unset($_GET['student_number']);
                            }
                            
                            
                          ?>
                          <!-- نهاية رسائل الاخطاء والعمليات الناجحة -->
                                
                                <!-- <div class="form-group">
                                    <input type="text" name="username" id="user_name" tabindex="1" class="form-control"
                                           placeholder="Username" value="">
                                </div> -->
                                <input type="hidden" name="from" id="from" value="signUp">

                                <!---------------------------------------->

                                <div class="form-group">
                                    <label>First name</label>

                                    <input type="text" name="firstname" id="first_name" tabindex="1"
                                           maxlength="20" class="form-control" placeholder="first name" value="" required="">
                                </div>

                                <!---------------------------------------->
                                <div class="form-group">
                                    <label>Middle name</label>

                                    <input type="text" name="middlename" id="middle_name" tabindex="1"
                                           maxlength="20" class="form-control" placeholder="middle name" value="" required="">
                                </div>

                                <!----------------------------------------->

                                <div class="form-group">
                                    <label>Last name</label>

                                    <input type="text" name="lastname" id="last_name" tabindex="1" class="form-control"
                                           maxlength="20" placeholder="last name" value="" required="">

                                </div>


                                <!------------------------------------------->

                                <div class="form-group">
                                    <label>Email address</label>

                                    <input type="email" name="email" id="email" tabindex="1" class="form-control"
                                           maxlength="64" placeholder="e.g user@gmail.com" value="" required="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                                </div>



                                <!-------------------------------------->
								
                                <div class="form-group">
                                    <label>Password</label>

                                    <input type="password" name="password" id="password_user" tabindex="2"
                                           maxlength="128" class="form-control" placeholder="Password" required="" minlength="4">
                                </div>
								
                                <!---------------------------------------->
								
                                <div class="form-group">
                                    <label>Confirm Password</label>

                                    <input type="password" name="confirm_password" id="confirm_password" tabindex="2"
                                           maxlength="128" class="form-control" placeholder="Confirm Password" required="" minlength="4">
                                </div>
								
                                <!---------------------------------------->
								
                                <div class="form-group">
                                    <label>Birth date</label>

                                    <input type="date" name="dateofbirth" id="date-of-birth" tabindex="2"
                                           maxlength="10" class="form-control" placeholder="Date of birth" required="">
                                </div>
								
                                <!---------------------------------------->
								
                                <div class="form-group">
                                    <label>Phone number</label>

                                    <input type="text" name="phonenumber" id="phone-number" tabindex="2"
                                          minlength="10" maxlength="10"  class="form-control" placeholder="05X-XXX-XXX" required="">
                                </div>
								
                                <!------------------------------------------>


								<div class="form_group">
                                    <label>Student number</label>

                                    <input type="text" name="studentnumber" id="Student_number" tabindex="2"
                                           minlength="7" maxlength="7" class="form-control" placeholder="XXXXXXX" value="" required="">

                                </div>
								
								
								
                                

                                <div class="form-group">
                                    <div class="row">

                                        <div class="col-sm-6 col-sm-offset-3">

                                            <input type="submit" name="register-submit" id="register-submit"
                                                   tabindex="4" class="form-control btn btn-register" value="تسجيل">

                                        </div>
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


<!jquary script>
<script src="../js/jquery.js"></script>
<script type="text/javascript" src="FScript.js"></script>
<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
<script>
    webshims.setOptions('forms-ext', {types: 'date'});
webshims.polyfill('forms forms-ext');
</script>
<!jquary script>
<script src="bootstrap.js"></script>
<script>

    var password_user = document.getElementById("password_user")
        , confirm_password= document.getElementById("confirm_password");

    function validatePassword(){
        if(password_user.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password_user.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

</script>


<!--bootstrap code-->

</body>
</html>