<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="fixed">
<head>
    <meta charset="UTF-8">
    <title>
        地区信息 - 列表 | HAPPY-SHARE Admin - Responsive HTML5 CMS
    </title>
    <meta name="keywords" content="HTML5 Admin Template"/>
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/Public/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="/Public/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />


    <link rel="stylesheet" type="text/css" href="/Public/vendor/pnotify/pnotify.custom.css" />
    <link rel="stylesheet" type="text/css" href="/Public/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
    <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
    <!-- Specific Page Vendor CSS -->
    
    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/theme.css" />
    <!-- Skin CSS -->
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/skins/default.css" />
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/theme-custom.css" />
    <!-- Head Libs -->
    <script type="text/javascript" src="/Public/vendor/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="/Public/vendor/jquery/jquery.js"></script>
    <style>
        .sidebar-left{
            width: 228px;
        }
        @media only screen and (min-width: 768px){
            html.fixed .page-header{
                left: 228px;
            }
            html.fixed .content-body{
                margin-left: 228px;
                width: 80%;
            }
        }
        #datatable{
            width: 100%!important;
        }
        td{
            text-overflow:ellipsis;
            -moz-text-overflow:ellipsis;
            overflow:hidden;
            white-space: nowrap;
        }
        #datatable thead th:last-child{
            width: 216px!important;
        }

    </style>
</head>
<body>
<section class="body">

    <!-- start: header -->
    <header class="header">
    <div class="logo-container">
        <a href="../" class="logo">
            <!--<img src="/Public/chellon/image/common/logo.jpg" height="35" alt="壳隆官网 | 管理后台" />-->
            Curiookids管理后台
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <!-- start: search & user box -->
    <div class="header-right">
        <span class="separator"></span>
        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
                <figure class="profile-picture">
                    <!--<img src="/Public/Uploads/<?php echo ($_SESSION['user']['photo']); ?>" alt="<?php echo ($_SESSION['user']['nickname']); ?>" class="img-circle" data-lock-picture="/Public/Uploads/<?php echo ($_SESSION['user']['photo']); ?>" />-->
                </figure>
                <div class="profile-info" data-lock-name="<?php echo ($_SESSION['user']['nickname']); ?>" data-lock-email="<?php echo ($_SESSION['user']['email']); ?>">
                    <span class="name"><?php echo ($_SESSION['user']['nickname']); ?></span>
                    <span class="role"><?php echo (session('groupName')); ?></span>
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled">
                    <li class="divider"></li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="<?php echo U('user/info');?>"><i class="fa fa-user"></i> 我的资料</a>
                    </li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="<?php echo U('sign/out');?>"><i class="fa fa-power-off"></i> 退出</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>
    <!-- end: header -->

    <div class="inner-wrapper">
        <!-- start: sidebar -->
        <aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
            导航
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html"
             data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <?php if(is_array($_SESSION['menu'])): foreach($_SESSION['menu'] as $K=>$menu): ?><li class="nav-parent <?php if(($CMENU) == $K): ?>nav-expanded nav-active<?php endif; ?>">
                        <a>
                            <i class="fa <?php echo (C("MENU_FA.$K")); ?>" aria-hidden="true"></i>
                            <span><?php echo (C("MENU_NAME.$K")); ?></span>
                        </a>
                        <ul class="nav nav-children">
                            <?php if(is_array($menu)): foreach($menu as $K2=>$subMenu): if((CONTROLLER_NAME) == $K2): ?><li class="nav-parent nav-expanded">
                                        <a>
                                            <i class="fa fa-paper-plane"></i>
                                            <?php echo (C("CONTROLLER_NAME.$K2")); ?>
                                        </a>
                                        <ul class="nav nav-children">
                                            <?php if(is_array($subMenu)): foreach($subMenu as $key=>$item): ?><li class="<?php if((ACTION_NAME) == $item): ?>nav-active<?php endif; ?>">
                                                    <a href="<?php echo U('/'.$K2.'/'.$item);?>">
                                                        <i class="fa fa-angle-right"></i>
                                                        <?php echo (C("ACTION_NAME.$item")); ?>
                                                    </a>
                                                </li><?php endforeach; endif; ?>
                                        </ul>
                                    </li>
                                    <?php else: ?>
                                    <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-quote-left"></i>
                                            <?php echo (C("CONTROLLER_NAME.$K2")); ?>
                                        </a>
                                        <ul class="nav nav-children">
                                            <?php if(is_array($subMenu)): foreach($subMenu as $key=>$item): ?><li>
                                                    <a href="<?php echo U('/'.$K2.'/'.$item);?>">
                                                        <i class="fa fa-angle-right"></i>
                                                        <?php echo (C("ACTION_NAME.$item")); ?>
                                                    </a>
                                                </li><?php endforeach; endif; ?>
                                        </ul>
                                    </li><?php endif; endforeach; endif; ?>
                        </ul>
                    </li><?php endforeach; endif; ?>
                </ul>
            </nav>
        </div>

    </div>

</aside>

        <!-- end: sidebar -->

        <section role="main" class="content-body">
            <header class="page-header">
    <h2><?php echo ($navTag); ?></h2>

    <!--<div class="right-wrapper pull-right pr-md">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Dashboard</span></li>
        </ol>
    </div>-->
</header>

            <!-- start: page -->
            
    <style type="text/css">
        table {

            table-layout: fixed;
        }

        .add {
            border-bottom: 10px solid #666666;
            /*下面4行是实现超过td文字变省略号,另外还要给table加上table-layout:fixed;*/
            text-overflow: ellipsis;
            -moz-text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        .signUpInfo {
            background-color: #43CD80;
            color: #ffffff;
            width: 80%;
        }

        .look a {
            display: inline-block;
            vertical-align: middle;
            width: 64px;
            height: 20px;
            text-align: center;
            line-height: 20px;
            color: #fff;
            background: #43CD80;
            margin: 0 4px;
            border-radius: 2px;
        }

        .list_pop {
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            top: 0;
            left: 0;
            z-index: 9999;
            display: none;
        }

        .list_pop .table,
        .user-cont {
            position: relative;
            margin: 0 auto;
            width: 870px;
            top: 50%;
            transform: translateY(-50%);
            background: #fff;
            border: 1px solid #ddd;
            z-index: 1;
        }

        .list_pop tr {
            height: 34px;
        }

        .list_pop th {
            text-align: center;

        }

        .list_pop th:nth-child(1) {
            width: 60px;
        }

        .list_pop th:nth-child(2) {
            width: 90px;
        }

        .list_pop th:nth-child(3),
        .list_pop th:nth-child(4) {
            width: 120px;
        }

        .list_pop th:nth-child(5) {
            padding: 0 10px;
            width: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .list_pop th:nth-child(6) {
            width: 90px;
            color: #225ab5;
            cursor: pointer;
        }

        .list_pop th:last-child {
            width: 290px;
        }

        thead {
            background: #edebeb;
            border-bottom: 1px solid #ddd;
        }

        .box {
            height: 600px;
            overflow: hidden;
            overflow-y: auto;
        }

        .box th {
            font-weight: 400;
            cursor: default;
        }

        /*.box th:nth-child(5){*/
        /*color: #225ab5;*/
        /*cursor: pointer;*/
        /*}*/
        .box tr:nth-child(2n) {
            background: #edebeb;
        }

        .box tr:nth-child(2n+1) {
            background: #fff;
        }

        .close {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        #point_data {
            color: #225ab5;
        }

        #point_data td {
            position: relative;
            text-align: center;
            cursor: pointer;
        }

        #point_data td:after {
            display: none;
            content: '';
            position: absolute;
            width: 20px;
            height: 1px;
            bottom: 4px;
            left: 0;
            right: 0;
            margin: auto;
            background: #225ab5;
        }

        #point_data td:hover:after {
            display: block;
        }

        #point_data td:last-child:hover:after {
            display: none;
        }

        #main {
            margin-top: 60px;
        }

        .screen {
            position: absolute;
            padding: 0 4px;
            height: 34px;
            z-index: 1;
        }

        .screen .item {
            float: left;
            height: 100%;
            margin-right: 20px;
        }

        .screen .item .lab {
            font-size: 18px;
            font-weight: bold;
            float: left;
            line-height: 34px;
        }

        .screen .item input,
        .screen .item select {
            width: 120px;
            height: 34px;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 0 10px;
        }

        .user-cont {
            width: 857px;
            padding: 8px;
            position: absolute;
            left: 0;
            right: 0;
            top: 50%;
            margin: auto;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            background: #fff;
            border: 1px solid rgba(187, 187, 187, 1);
            text-align: center;
            z-index: 1;
            display: none;
        }

        .user-cont .tables {
            border: 1px solid #0088cc;
        }

        .user-cont table {
            width: 100%;
            text-align: center;
            color: #fff;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .user-cont tr,
        .user-cont td,
        .user-cont th {
            text-align: center;
            height: 34px;
            border: 1px solid #fff;
        }

        .user-cont #table1 {
            background: #0088cc;
        }

        .user-cont thead {
            background: #606266;
        }

        .user-cont .width1 {
            width: 180px;
        }

        .user-cont #table2 tbody {
            color: #4a4a4a;
        }

        .user-cont #table2 tbody tr:nth-child(2n+1) {
            background: #ddebf7;
        }

        .user-cont #table2 tbody tr:nth-child(2n) {
            background: #bdd7ee;
        }

        .user-cont #table2 tbody tr td {
            padding: 0 10px;
        }

        .user-cont #table2 tr th:nth-child(3) {
            width: auto;
        }

        .user-cont #table2 tbody tr td:last-child {
            text-align: left;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        #datatable thead th:first-child {
            width: 52px !important;
        }

        #datatable thead th:last-child {
            width: 202px !important;
        }

        #datatable thead th:nth-child(5) {
            width: 90px !important;
        }

        .signUpInfo {
            width: auto;
            margin-right: 0 !important;
        }

        .table-bordered>thead>tr>th,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>tbody>tr>td,
        .table-bordered>tfoot>tr>td {
            border: 0px solid #ddd;
        }

        .table-bordered {
            border: 0px solid #ddd;

        }

        th {
            background-color: #f4f4f4;
        }

        tr {
            border-bottom: 1px solid #ddd;
        }

        .ktx-form-btn {
            display: block;
            text-align: center;
            width: 100px;
            height: 30px;
            line-height: 30px;
            border-radius: 5px;
            background: #444;
            color: #fff;
            /* margin: 10px 0px 20px 820px; */
            margin: 10px 0px 20px 0px;
        }
        a:hover{
            color:#fff;
            text-decoration: none;
        }
    </style>
    <a href="https://curiookids.incker.com/StoreInfo/insert3.html" class="ktx-form-btn" id="select-btn">
        新增
    </a>
    <section class="panel">
        <div class="panel-body">
            <table class="table table-bordered table-condensed mb-none">
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>地区</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr id="StoreInfo_<?php echo ($k); ?>">
                            <td><?php echo ($vo["id"]); ?></td>
                            <td class="add"><?php echo ($vo["area_name"]); ?></td>
                            <td>
                                <?php if(in_array(($cDelete), is_array($_SESSION['routes'])?$_SESSION['routes']:explode(',',$_SESSION['routes']))): ?><a data-target="StoreInfo_<?php echo ($k); ?>" data-href="<?php echo U('/StoreInfo/delete3/id/'.$vo['id']);?>"
                                        data-toggle="confirmation" class="btn btn-xs btn-primary"><i
                                            class="fa fa-trash-o"></i> 删除</a><?php endif; ?>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <?php echo ($page); ?>

        </div>



    </section>

            <!-- end: page -->
        </section>
    </div>

</section>

<!-- Vendor -->
<script type="text/javascript" src="/Public/vendor/jquery/jquery.js"></script>
<script type="text/javascript" src="/Public/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script type="text/javascript" src="/Public/vendor/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="/Public/vendor/nanoscroller/nanoscroller.js"></script>
<script type="text/javascript" src="/Public/vendor/bootstrap-datepicker/js/bootstrap-datepicker-cn.js"></script>
<script type="text/javascript" src="/Public/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script type="text/javascript" src="/Public/vendor/jquery-placeholder/jquery-placeholder.js"></script>
<script type="text/javascript" src="/Public/vendor/pnotify/pnotify.custom.js"></script>
<script type="text/javascript" src="/Public/vendor/bootstrap-confirmation/bootstrap-confirmation.js"></script>
<script type="text/javascript" src="/Public/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="/Public/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="/Public/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

<!-- Specific Page Vendor -->


<!-- Theme Base, Components and Settings -->
<script type="text/javascript" src="/Public/admin/js/theme.js"></script>

<!-- Theme Custom -->
<script type="text/javascript" src="/Public/admin/js/theme.custom.js"></script>

<!-- Theme Initialization Files -->
<script type="text/javascript" src="/Public/admin/js/theme.init.js"></script>

<!-- DataTables -->
<style>
    table td, table th {
        white-space: nowrap;
    }

    table td .title {
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-block;
    }
</style>
<script>
    $(function () {
        'use strict';

        /*
         Positions
         */
        var stack_topleft = {"dir1": "down", "dir2": "right", "push": "top"};
        var stack_bottomleft = {"dir1": "right", "dir2": "up", "push": "top"};
        var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 15, "firstpos2": 15};
        var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
        var stack_bar_bottom = {"dir1": "up", "dir2": "right", "spacing1": 0, "spacing2": 0};


        $('#datatable').dataTable({
            "bLengthChange": false,
        });
        $('#datatable').on('draw.dt', function () {
            initConfirmation();
        });
        function initConfirmation() {
            $('[data-toggle="confirmation"]').confirmation({
                onConfirm: function () {
                    var that = $('#' + $(this).attr('target'));
                    $.ajax({
                        url: $(this).attr('href'), success: function (data) {
                            if (data.status == 1) {
                                // success
                                var notice = new PNotify({
                                    title: '删除成功',
                                    text: data.info,
                                    type: 'success',
                                    addclass: 'stack-bar-top',
                                    stack: stack_bar_top,
                                    width: "100%"
                                });
                                that.remove();
                            } else {
                                // error
                                var notice = new PNotify({
                                    title: '删除失败',
                                    text: data.info,
                                    type: 'error',
                                    addclass: 'stack-bar-top',
                                    stack: stack_bar_top,
                                    width: "100%"
                                });
                            }
                        }
                    });
                },
                onCancel: function () {
                }
            });
        }

        initConfirmation();
    });
</script>

<!-- Form -->
<script type="text/javascript" src="/Public/vendor/jquery.validation/jquery.validation.js"></script>
<script type="text/javascript" src="/Public/vendor/jquery-form/jquery-form.js"></script>
<script type="text/javascript" src="/Public/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<script>
    (function() {

        'use strict';

        /*
         Positions
         */
        var stack_topleft = {"dir1": "down", "dir2": "right", "push": "top"};
        var stack_bottomleft = {"dir1": "right", "dir2": "up", "push": "top"};
        var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 15, "firstpos2": 15};
        var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
        var stack_bar_bottom = {"dir1": "up", "dir2": "right", "spacing1": 0, "spacing2": 0};


        /* 表单提交 */
        $('.ajaxForm').each(function(){
            var that = $(this);
            that.ajaxForm({
                beforeSubmit : checkForm, // pre-submit callback
                success : complete, // post-submit callback
                dataType : 'json'
            });
            function checkForm(target) {
                return that.valid();
            }
        });
        function complete(data) {
            $.magnificPopup.close();
            if (data.status == 1) {
                // success
                var notice = new PNotify({
                    title: '操作成功',
                    text: data.info,
                    type: 'success',
                    addclass: 'stack-bar-top',
                    stack: stack_bar_top,
                    width: "100%"
                });
                if (data.url != '') {
                    setTimeout(function(){location.href=data.url},2000);
                }
            } else {
                // error
                var notice = new PNotify({title: '操作失败',text: data.info,type: 'error',addclass: 'stack-bar-top',stack: stack_bar_top, width: "100%"});
            }
        }

        /* 表单检查 */
        $('.validForm').each(function(){
            $(this).validate({
                highlight: function( label ) {
                    $(label).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                success: function( label ) {
                    $(label).closest('.form-group').removeClass('has-error');
                    label.remove();
                },
                errorPlacement: function( error, element ) {
                    var placement = element.closest('.validate-area');
                    if (!placement.get(0)) {
                        placement = element;
                    }
                    if (error.text() !== '') {
                        placement.after(error);
                    }
                }
            });
        });

        // 表单取消 - 返回
        $(document).on('click', '.btn-back', function (e) {
            e.preventDefault();
            history.back(-1);
        });

        // 图片上传
        var $upCnt = 1;
        function insertOneUP() {
            var $newUP = $("<div class='fileupload fileupload-new mb-md' data-provides='fileupload'> <div class='input-append'> <div class='uneditable-input'> <i class='fa fa-file fileupload-exists'></i> <span class='fileupload-preview'></span> </div> <span class='btn btn-default btn-file'> <span class='fileupload-exists'>变更</span> <span class='fileupload-new'>选择文件</span> <input type='file' name='photo_" + (++$upCnt) + "'/> </span> <a href='#' class='btn btn-default fileupload-exists' data-dismiss='fileupload'>移除</a> </div></div>");
            $('#uparea').append($newUP);
        }

        $('#addUP').click(function (e) {
            e.preventDefault();
            insertOneUP();
        });
        $('.upareaRemove').click(function (e) {
            e.preventDefault();
            // 移除选项
            var that = $(this);
            var target = $('#'+that.attr('data-target'));
            if(target){
                var newInput = target.find('input');
                //newInput.attr('required','required');
                target.show();
            }
            that.hide().next().show();
            var thumbnail = $(this).closest('.thumbnail');
            var input = thumbnail.find('input');
            var image = thumbnail.find('.thumb-preview>img');
            image.css('opacity', '.2');
            input.attr("disabled", "disabled");

        });
        $('.upareaUnRemove').click(function (e) {
            e.preventDefault();
            var that = $(this);
            var target = $('#'+that.attr('data-target'));
            if(target){
                var newInput = target.find('input');
                newInput.removeAttr('required');
                target.hide();
            }
            that.hide().prev().show();
            var thumbnail = $(this).closest('.thumbnail');
            var input = thumbnail.find('input');
            var image = thumbnail.find('.thumb-preview>img');
            image.css('opacity', 1);
            input.removeAttr('disabled');
        }).hide();

    }).apply( this, [ jQuery ]);
</script>

<!-- Specific -->



</body>
</html>