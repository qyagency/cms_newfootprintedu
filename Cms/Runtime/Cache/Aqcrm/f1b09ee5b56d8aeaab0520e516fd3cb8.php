<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="fixed">
<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <title>
        登录 | HAPPY-SHARE Admin - Responsive HTML5 CMS
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
    
    <style>
        #code {
            width: 100%;
        }
    </style>

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
    
    <div class="center-sign">
        <div class="panel panel-sign">
            <div class="panel-title-sign mt-xl text-right">
                <h2 class="title m-none"><?php echo (C("COMPANY")); ?></h2>
            </div>
            <div class="panel-body">
                <form action="/sign/in" method="post">
                    <div class="form-group">
                        <label>用户名</label>
                        <div class="input-group input-group-icon">
                            <input name="passport" type="text" maxlength="10" class="form-control input-lg" required>
                                <span class="input-group-addon">
                                    <span class="icon icon-lg">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </span>
                        </div>
                    </div>
                    <div class="form-group mb-lg">
                        <label>密码</label>
                        <div class="input-group input-group-icon">
                            <input name="password" type="password" maxlength="20" class="form-control input-lg"
                                   required>
                            <span class="input-group-addon">
                                <span class="icon icon-lg">
                                    <i class="fa fa-lock"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group mb-lg">
                        <label>验证码</label>
                        <div class="input-group">
                            <input name="passcode" type="text" maxlength="5" class="form-control input-lg" required
                                   style="padding-right: 200px">
                            <div>
                                <img id="code" src="<?php echo U('sign/code');?>" onclick='this.src="<?php echo U('sign/code');?>"' />
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="checkbox-custom checkbox-default">
                                <input id="RememberMe" name="rememberme" type="checkbox" value="yes">
                                <label for="RememberMe">记住登录</label>
                            </div>
                        </div>
                        <div class="col-sm-4 text-right">
                            <button type="submit" class="btn btn-primary hidden-xs">登录</button>
                            <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">登录</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2015. All Rights Reserved.</p>
    </div>

</section>
<!-- end: page -->
</body>
</html>