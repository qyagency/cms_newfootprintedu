<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="fixed">
<head>
    <meta charset="UTF-8">
    <title>
        资讯信息 - 编辑 | HAPPY-SHARE Admin - Responsive HTML5 CMS
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
    
    <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
    <link rel="stylesheet" type="text/css" href="/Public/vendor/select2/css/select2.css" />
    <link rel="stylesheet" type="text/css" href="/Public/vendor/select2-bootstrap-theme/select2-bootstrap.css" />

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
            
    <form class="ajaxForm form-horizontal form-bordered" enctype="multipart/form-data" method="post" novalidate="novalidate">
    <section class="panel">
        <div class="panel-body">
            <div class="form-group">   <label class="col-md-2 control-label">资讯类型:<span class="required">*</span></label>   <div class="col-md-8">       <select data-plugin-selectTwo class="form-control" name="<?php echo (CONTROLLER_NAME); ?>News_type" required  >               <option value="">请选择</option>           <?php if(is_array($vo["StatusList"])): $i = 0; $__LIST__ = $vo["StatusList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vos["key"]); ?>" <?php echo ($vos["readonly"]); ?> <?php if(($vos["key"]) == $vo["news_type"]): ?>selected<?php endif; ?>><?php echo ($vos["label"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>       </select>   </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">资讯标题:<span class="required">*</span></label>   <div class="col-md-8">       <input  placeholder="资讯标题:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>News_title" value="<?php echo ($vo["news_title"]); ?>" required>      </div></div>
<!--            <div class="form-group">   <label class="col-md-2 control-label">资讯图片:<span class="required">*</span></label>   <div class="col-md-8">       <input  placeholder="资讯图片:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>News_img" value="<?php echo ($vo["news_img"]); ?>" required>      </div></div>-->
            <input type="hidden" name = "NewsInfoNews_img" id = "news_img" value="<?php echo ($vo["news_img"]); ?>" />
            <input type="hidden" name = "NewsInfoNews_details_img" id = "news_img2" value="<?php echo ($vo["news_details_img"]); ?>" />

<!--            <label class="col-md-2 control-label" for="textareaDefault">资讯图片:</label>-->
<!--            <img id="img-change" height="240px" width="320px" src="<?php echo ($vo["news_img"]); ?>" id="img-change" class="news_img" alt="资讯图片" />-->
<!--            <form id="form1" action="" method="post" enctype="multipart/form-data">-->
<!--                <input type="file" name="upfile" id="upfile"  style="display:none;" onchange="filechange(event)" value="" />-->
<!--&lt;!&ndash;                <input type="button" class="btn btn-primary" value="上传" id="btn"/>&ndash;&gt;-->
<!--            </form>-->

            <label class="col-md-2 control-label" for="textareaDefault">资讯图片:</label>
            <a><img  height="120px" width="160px" src="<?php echo ($vo["news_img1"]); ?>" id="img-change" class="news_img" alt="资讯图片" /></a>
            <a><img  height="120px" width="160px" src="<?php echo ($vo["news_img2"]); ?>" id="img-change2" class="news_img" alt="资讯图片" /></a>
            <a><img  height="120px" width="160px" src="<?php echo ($vo["news_img3"]); ?>" id="img-change3" class="news_img" alt="资讯图片" /></a>
            <form id="form1" action="" method="post" enctype="multipart/form-data" style="margin-top: 15px">
                <input type="file" name="upfile" id="upfile"  style="display:none;" onchange="filechange(event)" value="" />
                <input type="file" name="upfile" id="upfile2"  style="display:none;" onchange="filechange2(event)" value="" />
                <input type="file" name="upfile" id="upfile3"  style="display:none;" onchange="filechange3(event)" value="" />

            </form>
        </br>
            <div style="margin-top: 15px"></div>
            <div class="form-group">   <label class="col-md-2 control-label">详情类型:<span class="required">*</span></label>   <div class="col-md-8">       <select data-plugin-selectTwo class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Is_use_text" required  >               <option value="">请选择</option>           <?php if(is_array($vo["TypeList"])): $i = 0; $__LIST__ = $vo["TypeList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vos["key"]); ?>" <?php echo ($vos["readonly"]); ?> <?php if(($vos["key"]) == $vo["is_use_text"]): ?>selected<?php endif; ?>><?php echo ($vos["label"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>       </select>   </div></div>

            <?php if($vo["is_use_text"] == 1): ?><div class="form-group">    <label class="col-md-2 control-label" for="textareaDefault">资讯详情:<span class="required">*</span></label>    <div class="col-md-8">        <textarea id="" rows="5" name="<?php echo (CONTROLLER_NAME); ?>News_details" class="form-control" required ><?php echo ($vo["news_details"]); ?></textarea>    </div></div><?php endif; ?>

            <?php if($vo["is_use_text"] == 0): ?><div class="form-group">
                    <label class="col-md-2 control-label" for="textareaDefault">资讯详情图片:</label>
                    <a><img  height="120px" width="160px" src="<?php echo ($vo["news_details_img"]); ?>" id="img-change4" class="news_img" alt="资讯详情图片" /></a>
                    <form id="form2" action="" method="post" enctype="multipart/form-data">
                        <input type="file" name="upfile" id="upfile4"  style="display:none;" onchange="filechange4(event)" value="" />
                    </form>
                </div><?php endif; ?>
            <div class="form-group">    <label class="col-md-2 control-label">资讯日期:<span class="required">*</span></label>    <div class="col-md-8">        <div class="input-group">            <span class="input-group-addon">                <i class="fa fa-calendar"></i>            </span>            <input name="<?php echo (CONTROLLER_NAME); ?>News_date" type="text" value="<?php echo ($vo["news_date"]); ?>" required data-plugin-datepicker class="form-control">        </div>    </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">资讯作者:<span class="required">*</span></label>   <div class="col-md-8">       <input  placeholder="资讯作者:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>News_auth" value="<?php echo ($vo["news_auth"]); ?>" required>      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">资讯排序:<span class="required">*</span></label>   <div class="col-md-8">       <input  placeholder="资讯排序:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>News_sort" value="<?php echo ($vo["news_sort"]); ?>" required>      </div></div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-9 col-lg-3">
                    <button class="btn btn-primary">保存</button>
                    <button class="btn btn-primary btn-back">取消</button>
                </div>
            </div>
        </footer>
    </section>
</form>
    <script type="text/javascript" src="/Public/vendor/uploadimg/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/vendor/uploadimg/js/upload.js"></script>
    <script>

        $("#img-change").click(function () {
            $("#upfile").click();
        })

        $("#img-change2").click(function () {
            $("#upfile2").click();
        })

        $("#img-change3").click(function () {
            $("#upfile3").click();
        })

        $('body').on('click',"#img-change4",function () {

            $("#upfile4").click();
        })

        var fhml='';
        if ($("select[name='NewsInfoIs_use_text']").val()==0){
            fhml = '<label class="col-md-2 control-label" for="textareaDefault">资讯详情:<span class="required">*</span></label>' +
                '<div class="col-md-8">' +
                ' <textarea id="" rows="5" name="NewsInfoNews_details" class="form-control" required=""></textarea>' +
                '</div>'
        }else {
            fhml =  $($('.form-group')[3]).html()
        }

        $("select[name='NewsInfoIs_use_text']").change(function () {

          var v = $(this).val(),
              h='';

            if (v==0){
                h='<label class="col-md-2 control-label" for="textareaDefault">资讯详情图片:</label>\n' +
                    '                <a><img  height="120px" width="160px" src="<?php echo ($vo["news_details_img"]); ?>" id="img-change4" class="news_img" alt="资讯详情图片" /></a>\n' +
                    '                <form id="form2" action="" method="post" enctype="multipart/form-data">\n' +
                    '                    <input type="file" name="upfile" id="upfile4"  style="display:none;" onchange="filechange4(event)" value="" />\n' +
                    '                </form>'

            }else {
                h=fhml
            }
            $($('.form-group')[3]).html(h)
        })

        /*$("#file").change(function (event) {*/
        var filechange4=function(event){
            var files = event.target.files, file;
            if (files && files.length > 0) {
                // 获取目前上传的文件
                file = files[0];// 文件大小校验的动作
                if(file.size > 1024 * 1024 * 5) {
                    alert('图片大小不能超过 5MB!');
                    return false;
                }
                // 获取 window 的 URL 工具
                var URL = window.URL || window.webkitURL;
                // 通过 file 生成目标 url
                var imgURL = URL.createObjectURL(file);
                //用attr将img的src属性改成获得的url
                $("#img-change4").attr("src",imgURL);
                // 使用下面这句可以在内存中释放对此 url 的伺服，跑了之后那个 URL 就无效了
                // URL.revokeObjectURL(imgURL);

                var formData = new FormData();
                formData.append("file",document.getElementById("upfile4").files[0]);
                $.ajax({
                    type: "POST", // 数据提交类型
                    url: "https://daning-crm.cms.incker.com/api/up",
                    data: formData, //发送数据
                    success:function (res) {
                        console.log(res);
                        if(res.code == 200){
                            $("input[name='NewsInfoNews_details_img']").val(res.url);
                      //      alert(res.url);
                        }

                    },

                    async: true, // 是否异步
                    processData: false, //processData 默认为false，当设置为true的时候,jquery ajax 提交的时候不会序列化 data，而是直接使用data
                    contentType: false //

                });
            }
        };


        var filechange=function(event){
            var files = event.target.files, file;
            if (files && files.length > 0) {
                // 获取目前上传的文件
                file = files[0];// 文件大小校验的动作
                if(file.size > 1024 * 1024 * 2) {
                    alert('图片大小不能超过 2MB!');
                    return false;
                }
                // 获取 window 的 URL 工具
                var URL = window.URL || window.webkitURL;
                // 通过 file 生成目标 url
                var imgURL = URL.createObjectURL(file);
                //用attr将img的src属性改成获得的url
                $("#img-change").attr("src",imgURL);
                // 使用下面这句可以在内存中释放对此 url 的伺服，跑了之后那个 URL 就无效了
                // URL.revokeObjectURL(imgURL);

                var formData = new FormData();
                formData.append("file",document.getElementById("upfile").files[0]);
                $.ajax({
                    type: "POST", // 数据提交类型
                    url: "https://daning-crm.cms.incker.com/api/up",
                    data: formData, //发送数据
                    success:function (res) {
                        console.log(res);
                        if(res.code == 200){
                            imgList = $("input[name='NewsInfoNews_img']").val().split(",");
                            // imgList = $("input[name='NewsInfoNews_img']").val().split(",");

                            imgList[0] = res.url;

                            $("input[name='NewsInfoNews_img']").val(imgList.join(","));
                        }

                    },

                    async: true, // 是否异步
                    processData: false, //processData 默认为false，当设置为true的时候,jquery ajax 提交的时候不会序列化 data，而是直接使用data
                    contentType: false //

                });
            }
        };


        var filechange2=function(event){
            var files = event.target.files, file;
            if (files && files.length > 0) {
                // 获取目前上传的文件
                file = files[0];// 文件大小校验的动作
                if(file.size > 1024 * 1024 * 2) {
                    alert('图片大小不能超过 2MB!');
                    return false;
                }
                // 获取 window 的 URL 工具
                var URL = window.URL || window.webkitURL;
                // 通过 file 生成目标 url
                var imgURL = URL.createObjectURL(file);

                imgList = $("input[name='NewsInfoNews_img']").val().split(",");

                if(imgList[0] !=""){
                    //用attr将img的src属性改成获得的url
                    $("#img-change2").attr("src",imgURL);
                }else{
                    //用attr将img的src属性改成获得的url
                    $("#img-change").attr("src",imgURL);
                }

                // 使用下面这句可以在内存中释放对此 url 的伺服，跑了之后那个 URL 就无效了
                // URL.revokeObjectURL(imgURL);

                var formData = new FormData();
                formData.append("file",document.getElementById("upfile2").files[0]);
                $.ajax({
                    type: "POST", // 数据提交类型
                    url: "https://daning-crm.cms.incker.com/api/up",
                    data: formData, //发送数据
                    success:function (res) {
                        console.log(res);
                        if(res.code == 200){
                            imgList = $("input[name='NewsInfoNews_img']").val().split(",");

                            if(imgList[0] !=""){
                                imgList[1] = res.url;
                            }else{
                                imgList[0] = res.url;
                            }
                            $("input[name='NewsInfoNews_img']").val(imgList.join(","));
                        }

                    },

                    async: true, // 是否异步
                    processData: false, //processData 默认为false，当设置为true的时候,jquery ajax 提交的时候不会序列化 data，而是直接使用data
                    contentType: false //

                });
            }
        };

        var filechange3=function(event){
            var files = event.target.files, file;
            if (files && files.length > 0) {
                // 获取目前上传的文件
                file = files[0];// 文件大小校验的动作
                if(file.size > 1024 * 1024 * 2) {
                    alert('图片大小不能超过 2MB!');
                    return false;
                }
                // 获取 window 的 URL 工具
                var URL = window.URL || window.webkitURL;
                // 通过 file 生成目标 url
                var imgURL = URL.createObjectURL(file);

                imgList = $("input[name='NewsInfoNews_img']").val().split(",");

                if(typeof(imgList[0]) == "undefined" || imgList[0] ==""){
                    $("#img-change").attr("src",imgURL);
                    //用attr将img的src属性改成获得的url
                }else if(typeof(imgList[1]) == "undefined" || imgList[1] ==""){
                    //用attr将img的src属性改成获得的url
                    $("#img-change2").attr("src",imgURL);
                }else{
                    //用attr将img的src属性改成获得的url
                    $("#img-change3").attr("src",imgURL);
                }

                // 使用下面这句可以在内存中释放对此 url 的伺服，跑了之后那个 URL 就无效了
                // URL.revokeObjectURL(imgURL);

                var formData = new FormData();
                formData.append("file",document.getElementById("upfile3").files[0]);
                $.ajax({
                    type: "POST", // 数据提交类型
                    url: "https://daning-crm.cms.incker.com/api/up",
                    data: formData, //发送数据
                    success:function (res) {
                        console.log(res);
                        if(res.code == 200){
                            imgList = $("input[name='NewsInfoNews_img']").val().split(",");

                            if(typeof(imgList[0]) == "undefined" || imgList[0] ==""){
                                imgList[0] = res.url;
                            }else if(typeof(imgList[1]) == "undefined" || imgList[1] ==""){
                                imgList[1] = res.url;
                            }else{
                                imgList[2] = res.url;
                            }



                            $("input[name='NewsInfoNews_img']").val(imgList.join(","));
                            //       alert($("input[name='AreaInfoArea_img']").val());
                        }

                    },

                    async: true, // 是否异步
                    processData: false, //processData 默认为false，当设置为true的时候,jquery ajax 提交的时候不会序列化 data，而是直接使用data
                    contentType: false //

                });
            }
        };

        // $("#btn").click(function(){
        //
        //     var formData = new FormData();
        //     formData.append("pic",document.getElementById("upfile").files[0]);
        //     $.ajax({
        //         type: "POST", // 数据提交类型
        //         url: "https://daning-crm.cms.incker.com/api/up",
        //         data: formData, //发送数据
        //         success:function (res) {
        //             console.log(res);
        //             if(res.code == 200){
        //                 $("input[name='NewsInfoNews_img']").val(res.url);
        //                 alert(res.url);
        //             }
        //
        //         },
        //
        //         async: true, // 是否异步
        //         processData: false, //processData 默认为false，当设置为true的时候,jquery ajax 提交的时候不会序列化 data，而是直接使用data
        //         contentType: false //
        //
        //     });
        // });



    </script>

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