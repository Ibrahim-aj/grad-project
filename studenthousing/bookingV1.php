<?php
session_start();
// التحقق من السيشن
if (!isset($_SESSION['LoginUser']) && $_SESSION['LoginUser'] == "") {
		header("Location: http://localhost/StudentHousing/Sign_in_up/Sign_in_up.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        <!-- Internet Explorer compatibility -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- First mobile meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
         <script src="js/html5shiv.min.js"></script>
         <script src="js/respond.min.js"></script>
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-rtl.css">
        <link rel="stylesheet" type="text/css" href="css/dashboard.css">
        <link rel="stylesheet" type="text/css" href="css/show-apartment.css">

        <title></title>
    </head>
    <body id="content">



                <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#" > <font size="6" face="cairo" color="white">سكن جامعة طيبة</font></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <form action="Sign_in_up/logout.php" method="post" class="navbar-form navbar-right">
                        <input type="submit" class="btn btn-warning" value="تسجيل الخروج" />
                    </form>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
<li ><a href="modifyStudentInfo.php">تعديل البيانات</a></li>

                    </ul>
                    <ul class="nav nav-sidebar">
                        <li class="active"><a href="#">حجز شقة</a></li>
                        <li><a href="#">الغاء حجز الشقة</a></li>
                        <li><a href="#">طلب تغيير الشقة</a></li>
                        <li><a href="">بيانات الشقة</a></li>
                        <li><a href="">تقييم الشقة</a></li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li><a href="">إرسال شكوى</a></li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h1 class="page-header">حجز شقة</h1>

                    <form class="form-book-apartment">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-18 col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <img src="http://placehold.it/500x250/EEE">
                                        <div class="caption">
                                            <h3>رقم الشقة: 5</h3>
                                            <p>
                                            <ul>
                                                <li>عدد الاشخاص الحالي: 2</li>
                                                <li>عدد الاشخاص الأقصى: 5</li>
                                            </ul>
                                            </p>
                                            <!-- Single button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    المدة - السعر <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">المدة - السعر</a></li>
                                                    <li><a href="#">فصل دراسي واحد - السعر 500 ريال سعودي</a></li>
                                                    <li><a href="#">فصلين دراسيين - السعر 1000 ريال سعودي</a></li>
                                                    <li><a href="#">ثلاث فصول دراسية - السعر 1500 ريال سعودي</a></li>
                                                </ul>
                                            </div>             

                                            <div>
                                                <div class="pull-left"><a href="#" class="btn btn-primary" role="button">حجز</a></div>
                                                <div id="stars-existing" class="starrr" data-rating='4'></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-xs-18 col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <img src="http://placehold.it/500x250/EEE">
                                        <div class="caption">
                                            <h3>رقم الشقة: 5</h3>
                                            <p>
                                            <ul>
                                                <li>عدد الاشخاص الحالي: 2</li>
                                                <li>عدد الاشخاص الأقصى: 5</li>
                                            </ul>
                                            </p>
                                            <!-- Single button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    المدة - السعر <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">المدة - السعر</a></li>
                                                    <li><a href="#">فصل دراسي واحد - السعر 500 ريال سعودي</a></li>
                                                    <li><a href="#">فصلين دراسيين - السعر 1000 ريال سعودي</a></li>
                                                    <li><a href="#">ثلاث فصول دراسية - السعر 1500 ريال سعودي</a></li>
                                                </ul>
                                            </div>             

                                            <div>
                                                <div class="pull-left"><a href="#" class="btn btn-primary" role="button">حجز</a></div>
                                                <div id="stars-existing" class="starrr" data-rating='4'></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-xs-18 col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <img src="http://placehold.it/500x250/EEE">
                                        <div class="caption">
                                            <h3>رقم الشقة: 5</h3>
                                            <p>
                                            <ul>
                                                <li>عدد الاشخاص الحالي: 2</li>
                                                <li>عدد الاشخاص الأقصى: 5</li>
                                            </ul>
                                            </p>
                                            <!-- Single button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    المدة - السعر <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">المدة - السعر</a></li>
                                                    <li><a href="#">فصل دراسي واحد - السعر 500 ريال سعودي</a></li>
                                                    <li><a href="#">فصلين دراسيين - السعر 1000 ريال سعودي</a></li>
                                                    <li><a href="#">ثلاث فصول دراسية - السعر 1500 ريال سعودي</a></li>
                                                </ul>
                                            </div>             

                                            <div>
                                                <div class="pull-left"><a href="#" class="btn btn-primary" role="button">حجز</a></div>
                                                <div id="stars-existing" class="starrr" data-rating='4'></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-xs-18 col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <img src="http://placehold.it/500x250/EEE">
                                        <div class="caption">
                                            <h3>رقم الشقة: 5</h3>
                                            <p>
                                            <ul>
                                                <li>عدد الاشخاص الحالي: 2</li>
                                                <li>عدد الاشخاص الأقصى: 5</li>
                                            </ul>
                                            </p>
                                            <!-- Single button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    المدة - السعر <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">المدة - السعر</a></li>
                                                    <li><a href="#">فصل دراسي واحد - السعر 500 ريال سعودي</a></li>
                                                    <li><a href="#">فصلين دراسيين - السعر 1000 ريال سعودي</a></li>
                                                    <li><a href="#">ثلاث فصول دراسية - السعر 1500 ريال سعودي</a></li>
                                                </ul>
                                            </div>             

                                            <div>
                                                <div class="pull-left"><a href="#" class="btn btn-primary" role="button">حجز</a></div>
                                                <div id="stars-existing" class="starrr" data-rating='4'></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-xs-18 col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <img src="http://placehold.it/500x250/EEE">
                                        <div class="caption">
                                            <h3>رقم الشقة: 5</h3>
                                            <p>
                                            <ul>
                                                <li>عدد الاشخاص الحالي: 2</li>
                                                <li>عدد الاشخاص الأقصى: 5</li>
                                            </ul>
                                            </p>
                                            <!-- Single button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    المدة - السعر <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">المدة - السعر</a></li>
                                                    <li><a href="#">فصل دراسي واحد - السعر 500 ريال سعودي</a></li>
                                                    <li><a href="#">فصلين دراسيين - السعر 1000 ريال سعودي</a></li>
                                                    <li><a href="#">ثلاث فصول دراسية - السعر 1500 ريال سعودي</a></li>
                                                </ul>
                                            </div>             

                                            <div>
                                                <div class="pull-left"><a href="#" class="btn btn-primary" role="button">حجز</a></div>
                                                <div id="stars-existing" class="starrr" data-rating='4'></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-xs-18 col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <img src="http://placehold.it/500x250/EEE">
                                        <div class="caption">
                                            <h3>رقم الشقة: 5</h3>
                                            <p>
                                            <ul>
                                                <li>عدد الاشخاص الحالي: 2</li>
                                                <li>عدد الاشخاص الأقصى: 5</li>
                                            </ul>
                                            </p>
                                            <!-- Single button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    المدة - السعر <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">المدة - السعر</a></li>
                                                    <li><a href="#">فصل دراسي واحد - السعر 500 ريال سعودي</a></li>
                                                    <li><a href="#">فصلين دراسيين - السعر 1000 ريال سعودي</a></li>
                                                    <li><a href="#">ثلاث فصول دراسية - السعر 1500 ريال سعودي</a></li>
                                                </ul>
                                            </div>             

                                            <div>
                                                <div class="pull-left"><a href="#" class="btn btn-primary" role="button">حجز</a></div>
                                                <div id="stars-existing" class="starrr" data-rating='4'></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-xs-18 col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <img src="http://placehold.it/500x250/EEE">
                                        <div class="caption">
                                            <h3>رقم الشقة: 5</h3>
                                            <p>
                                            <ul>
                                                <li>عدد الاشخاص الحالي: 2</li>
                                                <li>عدد الاشخاص الأقصى: 5</li>
                                            </ul>
                                            </p>
                                            <!-- Single button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    المدة - السعر <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">المدة - السعر</a></li>
                                                    <li><a href="#">فصل دراسي واحد - السعر 500 ريال سعودي</a></li>
                                                    <li><a href="#">فصلين دراسيين - السعر 1000 ريال سعودي</a></li>
                                                    <li><a href="#">ثلاث فصول دراسية - السعر 1500 ريال سعودي</a></li>
                                                </ul>
                                            </div>             

                                            <div>
                                                <div class="pull-left"><a href="#" class="btn btn-primary" role="button">حجز</a></div>
                                                <div id="stars-existing" class="starrr" data-rating='4'></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/row-->
                        </div><!--/container -->
                    </form>

                </div>
            </div>
        </div>




        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/dashboard.js"></script>
    </body>
</html>
