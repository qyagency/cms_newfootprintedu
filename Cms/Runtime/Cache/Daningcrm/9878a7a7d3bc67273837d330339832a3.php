<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="fixed">
<head>
    <meta charset="UTF-8">
    <title>
        用户信息 - 列表 | HAPPY-SHARE Admin - Responsive HTML5 CMS
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
            大宁社区管理后台
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
        .DateSelect {
            display: none;

        }
        .DateSelect2 {
            display: inline;

        }
        .alltext{
            position: absolute;
            left: 40px;
            right: 40px;
            padding: 10px 20px;
            background: #fff;
            border-radius: 8px;
            color: #4a4a4a;;
            text-align: left;
            font-size: 13px;
            z-index: 2;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .panel-body{
            position: relative;
        }
        .dataTables_wrapper .datatables-footer{
            margin-top: 60px;
        }
        .mailbtn,.filebtn{
            bottom: 60px;
            position: absolute;
            z-index: 1;

        }
        .mailbtn{
            margin-left: -10px
        }
        .filebtn{
            margin-left: 60px
        }
        .screen{
            position: absolute;
            height: 34px;
            z-index: 1;
        }
        .screen .item{
            float: left;
            height: 100%;
            margin-right: 20px;
        }
        .screen .item .lab{
            float: left;
            line-height: 34px;
        }
        .screen .item input,
        .screen .item select{
            width: 120px;
            height: 34px;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 0 10px;
        }
        .projectList,
        .upfile{
            position: absolute;
            width: 300px;
            background: #fff;
            text-align: center;
            top: 50%;
            left: 0;
            right: 0;
            margin: auto;
            transform: translateY(-50%);
            display: none;
            z-index: 2;
        }
        .projectList .list{
            height:140px ;
            margin-top: 20px;
            text-align: left;
        }
        .projectList h2,
        .upfile h2{
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 2px;
        }
        ul,li{
            padding:0;
            margin:0;
            list-style:none
        }
        .projectList li{
            padding: 4px 20px;
            cursor: pointer;
        }
        .projectList li:hover{
            color: #fff;
            background: #0088cc;
        }
        .upfile input{
            margin: 40px auto;
        }
        .upfile .upload{
            width: 60px;
            height: 34px;
            text-align: center;
            line-height: 34px;
            border-radius: 8px;
            background: #0088cc;
            color: #fff;
            margin: 40px auto;
        }
        #infoPage span{
            color: #0088cc
        }
        #infoPage .current{
            color:#777
        }

        .verifyNo{
            background-color:#CD0000;
            color:#ffffff;

        }
        .verifyYes{
            background-color:#43CD80;
            color:#ffffff;

        }

        #datatable .btn{
            width: 54px;
        }
        #datatable .btn

    </style>
    <section class="panel">
        <div class="panel-body">
            <table id="datatable" class="table table-bordered table-condensed mb-none">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>姓名</th>
                    <th>真实姓名</th>
                    <th>身份证号</th>
                    <th>身份证正面</th>
                    <th>身份证背面</th>
                    <th>社区</th>
                    <th>地址</th>
                    <th>手机号</th>
                    <th>审核状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr id="UserInfo_<?php echo ($k); ?>">
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["user_name"]); ?></td>
                        <td><?php echo ($vo["user_real_name"]); ?></td>
                        <td><?php echo ($vo["user_id_card"]); ?></td>
                        <td><img id="id_card" height="50px" width="80px" src="<?php echo ($vo["user_id_card_img"]); ?>" class="pimg" alt="未上传" /></td>
                        <td><img id="id_card2" height="50px" width="80px" src="<?php echo ($vo["user_id_card_img2"]); ?>" class="pimg" alt="未上传" /></td>
                        <td><?php echo ($vo["user_community"]); ?></td>
                        <td><?php echo ($vo["user_address"]); ?></td>
                        <td><?php echo ($vo["user_mobile"]); ?></td>
                        <td><?php echo (translateStatus($vo["user_status"])); ?></td>
                        <td>

                            <?php if($vo["user_status"] == 1): ?><a href="javascript:void(0)" id = "verifyYes_<?php echo ($vo['id']); ?>"  data-openid="<?php echo ($vo['user_open_id']); ?>" data-id="<?php echo ($vo['id']); ?>" class="verifyYes btn btn-xs ml-sm mr-sm " ><i class="fa fa-pencil"></i> 通过</a>
                                <a id = "verifyNo_<?php echo ($vo['id']); ?>" href="javascript:void(0)"  data-openid="<?php echo ($vo['user_open_id']); ?>" data-id="<?php echo ($vo['id']); ?>" class="verifyNo btn btn-xs  ml-sm mr-sm " style="margin: 0!important"><i class="fa fa-pencil"></i> 拒绝</a><?php endif; ?>

                            <?php if(in_array(($cEdit), is_array($_SESSION['routes'])?$_SESSION['routes']:explode(',',$_SESSION['routes']))): ?><a href="<?php echo U('/UserInfo/edit/id/'.$vo['id']);?>" class="btn btn-xs btn-primary ml-sm mr-sm"><i class="fa fa-pencil"></i> 编辑</a><?php endif; ?>
                            <?php if(in_array(($cDelete), is_array($_SESSION['routes'])?$_SESSION['routes']:explode(',',$_SESSION['routes']))): ?><a data-target="UserInfo_<?php echo ($k); ?>" data-href="<?php echo U('/UserInfo/delete/id/'.$vo['id']);?>"
                                   data-toggle="confirmation" class="btn btn-xs btn-primary"><i
                                        class="fa fa-trash-o"></i> 删除</a><?php endif; ?>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <?php echo ($page); ?>

        </div>

        <!-- 图片放大后的遮罩层 -->
        <div id="outerdiv" style="position:fixed;top:0;left:0;background:rgba(0,0,0,0.7);z-index:2000;width:100%;height:100%;display:none;">
            <!-- 放大后的图片 -->
            <div id="innerdiv" style="position:absolute;z-index: 2000">
                <img id="bigimg" style="border:5px solid #fff;" src="" />
            </div>
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

    <script>

        $('.verifyYes').click(function () {
            user_id =$(this).data("id");
            user_open_id =$(this).data("openid");

            if(confirm("是否通过用户审核"))

            {
                $.ajax({
                    url: "https://daning-crm.cms.incker.com/api/verify",
                    type: 'post',
                    data: {
                        user_id:user_id,
                        user_open_id:user_open_id,
                        status:2

                    },
                    success: function (res) {

                        console.log(res)
                        if(res.code==200){

                            $("#verifyYes_" + user_id).remove();
                            $("#verifyNo_" + user_id).remove();
                            alert("审核通过");

                        }else {

                        }
                    },
                    error: function (res) {
                        //that.postLock = true;
                    }
                });

            } else

            {
            }
        })

        $('.verifyNo').click(function () {
            user_id =$(this).data("id");
            user_open_id =$(this).data("openid");
            if(confirm("是否拒绝用户审核"))

            {

                $.ajax({
                    url: "https://daning-crm.cms.incker.com/api/verify",
                    type: 'post',
                    data: {
                        user_id:user_id,
                        user_open_id:user_open_id,
                        status:3

                    },
                    success: function (res) {

                        console.log(res)
                        if(res.code==200){
                            $("#verifyYes_" + user_id).remove();
                            $("#verifyNo_" + user_id).remove();
                            alert("审核拒绝");

                        }else {

                        }
                    },
                    error: function (res) {
                        //that.postLock = true;
                    }
                });

            } else

            {
            }
        })


        // 图片点击事件
        $('.pimg').click(function () {
            enlarge(this);
        })

        // 图片放大函数
        function enlarge(obj) {

            var _this = $(obj);
            imgShow("#outerdiv", "#innerdiv", "#bigimg", _this);


            function imgShow(outerdiv, innerdiv, bigimg, _this) {
                var src = _this.attr("src"); //获取当前点击的pimg元素中的src属性
                $(bigimg).attr("src", src); //设置#bigimg元素的src属性

                /*获取当前点击图片的真实大小，并显示弹出层及大图*/
                $("<img/>").attr("src", src).load(function () {
                    var windowW = $(window).width(); //获取当前窗口宽度
                    var windowH = $(window).height(); //获取当前窗口高度
                    var realWidth = this.width; //获取图片真实宽度
                    var realHeight = this.height; //获取图片真实高度
                    var imgWidth, imgHeight;
                    var scale = 0.8; //缩放尺寸，当图片真实宽度和高度大于窗口宽度和高度时进行缩放

                    if (realHeight > windowH * scale) { //判断图片高度
                        imgHeight = windowH * scale; //如大于窗口高度，图片高度进行缩放
                        imgWidth = imgHeight / realHeight * realWidth; //等比例缩放宽度
                        if (imgWidth > windowW * scale) { //如宽度扔大于窗口宽度
                            imgWidth = windowW * scale; //再对宽度进行缩放
                        }
                    } else if (realWidth > windowW * scale) { //如图片高度合适，判断图片宽度
                        imgWidth = windowW * scale; //如大于窗口宽度，图片宽度进行缩放
                        imgHeight = imgWidth / realWidth * realHeight; //等比例缩放高度
                    } else { //如果图片真实高度和宽度都符合要求，高宽不变
                        imgWidth = realWidth;
                        imgHeight = realHeight;
                    }
                    $(bigimg).css("width", imgWidth); //以最终的宽度对图片缩放

                    var w = (windowW - imgWidth) / 2; //计算图片与窗口左边距
                    var h = (windowH - imgHeight) / 2; //计算图片与窗口上边距
                    $(innerdiv).css({
                        "top": h,
                        "left": w
                    }); //设置#innerdiv的top和left属性
                    $(outerdiv).fadeIn("fast"); //淡入显示#outerdiv及.pimg
                });

                $(outerdiv).click(function () { //再次点击淡出消失弹出层
                    $(this).fadeOut("fast");
                });
            }
        }


    </script>



</body>
</html>