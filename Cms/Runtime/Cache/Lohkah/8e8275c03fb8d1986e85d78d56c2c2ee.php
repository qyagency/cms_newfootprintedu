<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="fixed">
<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <title>
        Error | HAPPY-SHARE Admin - Responsive HTML5 CMS
    </title>
    <meta name="keywords" content="HTML5 Admin Template"/>
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/Public/vendor/font-awesome/css/font-awesome.css" />
    <!-- Specific Page Vendor CSS -->
    
    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/theme.css" />
    <!-- Skin CSS -->
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/skins/default.css" />
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/theme-custom.css" />
    <!-- Head Libs -->
    <script type="text/javascript" src="/Public/vendor/modernizr/modernizr.js"></script>
</head>
<body>
<!-- start: page -->
<section class="body-sign">
    
    <section class="body-error error-outside">
        <div class="center-error">

            <div class="row">
                <div class="col-sm-8">
                    <div class="main-error mb-xlg">
                        <h2 class="error-code text-dark text-center text-weight-semibold m-none">500 <i class="fa fa-file"></i></h2>
                        <p class="error-explanation text-center"><?php echo ($message); echo ($error); ?></p>
                        <p class="jump">
                            页面自动 <a id="href" href="<?php echo ($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo ($waitSecond); ?></b>
                        </p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <h4 class="text">Here are some useful links</h4>
                    <ul class="nav nav-list primary">
                        <li><a href="#"><i class="fa fa-caret-right text-dark"></i> Dashboard</a></li>
                        <li><a href="#"><i class="fa fa-caret-right text-dark"></i> User Profile</a></li>
                        <li><a href="#"><i class="fa fa-caret-right text-dark"></i> FAQ's</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        (function(){
            var wait = document.getElementById('wait'),href = document.getElementById('href').href;
            var interval = setInterval(function(){
                var time = --wait.innerHTML;
                if(time <= 0) {
                    location.href = href;
                    clearInterval(interval);
                };
            }, 1000);
        })();
    </script>

</section>
<!-- end: page -->
</body>
</html>