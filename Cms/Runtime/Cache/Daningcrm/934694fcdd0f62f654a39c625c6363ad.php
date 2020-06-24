<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="fixed">
<head>
    <meta charset="UTF-8">
    <title>
        场地信息 - 编辑 | HAPPY-SHARE Admin - Responsive HTML5 CMS
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
    <link rel="stylesheet" type="text/css" href="/Public/vendor/uploadimg/css/upload3.css" />

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
            <div class="form-group">   <label class="col-md-2 control-label">场地位置:<span class="required">*</span></label>   <div class="col-md-8">       <select data-plugin-selectTwo class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Area_location" required  >               <option value="">请选择</option>           <?php if(is_array($vo["LocationList"])): $i = 0; $__LIST__ = $vo["LocationList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vos["key"]); ?>" <?php echo ($vos["readonly"]); ?> <?php if(($vos["key"]) == $vo["area_location"]): ?>selected<?php endif; ?>><?php echo ($vos["label"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>       </select>   </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">场地名称:<span class="required">*</span></label>   <div class="col-md-8">       <input  placeholder="场地名称:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Area_name" value="<?php echo ($vo["area_name"]); ?>" required>      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">场地可用时间:<span class="required">*</span></label>   <div class="col-md-8">       <input  placeholder="场地可用时间:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Area_can_use_time" value="<?php echo ($vo["area_can_use_time"]); ?>" required>      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">场地地址:<span class="required">*</span></label>   <div class="col-md-8">       <input  placeholder="场地地址:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Area_address" value="<?php echo ($vo["area_address"]); ?>" required>      </div></div>



<!--            <div class="form-group">   <label class="col-md-2 control-label">场地图片:<span class="required">*</span></label>   <div class="col-md-8">       <input  placeholder="场地图片:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Area_img" value="<?php echo ($vo["area_img"]); ?>" required>      </div></div>-->
            <input type="hidden" name = "AreaInfoArea_img" id = "area_img" value="<?php echo ($vo["area_img"]); ?>" />

            <label class="col-md-2 control-label" for="textareaDefault">场地图片:</label>
            <a><img  height="120px" width="160px" src="<?php echo ($vo["area_img1"]); ?>" id="img-change" class="area_img" alt="资讯图片" /></a>
            <a><img  height="120px" width="160px" src="<?php echo ($vo["area_img2"]); ?>" id="img-change2" class="area_img" alt="资讯图片" /></a>
            <a><img  height="120px" width="160px" src="<?php echo ($vo["area_img3"]); ?>" id="img-change3" class="area_img" alt="资讯图片" /></a>
            <form id="form1" action="" method="post" enctype="multipart/form-data">
                <input type="file" name="upfile" id="upfile"  style="display:none;" onchange="filechange(event)" value="" />
                <input type="file" name="upfile" id="upfile2"  style="display:none;" onchange="filechange2(event)" value="" />
                <input type="file" name="upfile" id="upfile3"  style="display:none;" onchange="filechange3(event)" value="" />

            </form>




            <div class="form-group">   <label class="col-md-2 control-label">场地排序:<span class="required">*</span></label>   <div class="col-md-8">       <input  placeholder="场地排序:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Area_sort" value="<?php echo ($vo["area_sort"]); ?>" required>      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">是否需要实名:<span class="required">*</span></label>   <div class="col-md-8">       <select data-plugin-selectTwo class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Is_verify" required  >               <option value="">请选择</option>           <?php if(is_array($vo["StatusList"])): $i = 0; $__LIST__ = $vo["StatusList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vos["key"]); ?>" <?php echo ($vos["readonly"]); ?> <?php if(($vos["key"]) == $vo["is_verify"]): ?>selected<?php endif; ?>><?php echo ($vos["label"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>       </select>   </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">是否需要管理员确认:<span class="required">*</span></label>   <div class="col-md-8">       <select data-plugin-selectTwo class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Is_confirm" required  >               <option value="">请选择</option>           <?php if(is_array($vo["StatusList"])): $i = 0; $__LIST__ = $vo["StatusList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vos["key"]); ?>" <?php echo ($vos["readonly"]); ?> <?php if(($vos["key"]) == $vo["is_confirm"]): ?>selected<?php endif; ?>><?php echo ($vos["label"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>       </select>   </div></div>
            <div class="form-group">    <label class="col-md-2 control-label" for="textareaDefault">场地简介:<span class="required">*</span></label>    <div class="col-md-8">        <textarea id="" rows="5" name="<?php echo (CONTROLLER_NAME); ?>Area_details" class="form-control" required ><?php echo ($vo["area_details"]); ?></textarea>    </div></div>
            <div class="form-group">    <label class="col-md-2 control-label" for="textareaDefault">场次描述:<span class="required">*</span></label>    <div class="col-md-8">        <textarea id="" rows="5" name="<?php echo (CONTROLLER_NAME); ?>Session_details" class="form-control" required ><?php echo ($vo["session_details"]); ?></textarea>    </div></div>
            <input type="hidden" name = "AreaInfoSession_template" id = "session_template" value="<?php echo ($vo["session_template"]); ?>" />

            <h5  class="cx">周一：</h5>
            &nbsp;&nbsp;<input type="checkbox" name="Mon1" value="1" /> 第一场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Mon2" value="1" /> 第二场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Mon3" value="1" /> 第三场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Mon4" value="1" /> 第四场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Mon5" value="1" /> 第五场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Mon6" value="1" /> 第六场 &nbsp;&nbsp;
            <br>

            <h5>周二：</h5>
            &nbsp;&nbsp;<input type="checkbox" name="Tues1" value="1" /> 第一场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Tues2" value="1" /> 第二场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Tues3" value="1" /> 第三场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Tues4" value="1" /> 第四场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Tues5" value="1" /> 第五场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Tues6" value="1" /> 第六场 &nbsp;&nbsp;
            <br>

            <h5>周三：</h5>
            &nbsp;&nbsp;<input type="checkbox" name="Wed1" value="1" /> 第一场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Wed2" value="1" /> 第二场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Wed3" value="1" /> 第三场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Wed4" value="1" /> 第四场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Wed5" value="1" /> 第五场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Wed6" value="1" /> 第六场 &nbsp;&nbsp;
            <br>

            <h5>周四：</h5>
            &nbsp;&nbsp;<input type="checkbox" name="Thur1" value="1" /> 第一场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Thur2" value="1" /> 第二场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Thur3" value="1" /> 第三场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Thur4" value="1" /> 第四场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Thur5" value="1" /> 第五场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Thur6" value="1" /> 第六场 &nbsp;&nbsp;
            <br>

            <h5>周五：</h5>
            &nbsp;&nbsp;<input type="checkbox" name="Fri1" value="1" /> 第一场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Fri2" value="1" /> 第二场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Fri3" value="1" /> 第三场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Fri4" value="1" /> 第四场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Fri5" value="1" /> 第五场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Fri6" value="1" /> 第六场 &nbsp;&nbsp;
            <br>

            <h5>周六：</h5>
            &nbsp;&nbsp;<input type="checkbox" name="Sat1" value="1" /> 第一场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Sat2" value="1" /> 第二场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Sat3" value="1" /> 第三场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Sat4" value="1" /> 第四场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Sat5" value="1" /> 第五场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Sat6" value="1" /> 第六场 &nbsp;&nbsp;
            <br>

            <h5>周日：</h5>
            &nbsp;&nbsp;<input type="checkbox" name="Sun1" value="1" /> 第一场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Sun2" value="1" /> 第二场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Sun3" value="1" /> 第三场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Sun4" value="1" /> 第四场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Sun5" value="1" /> 第五场 &nbsp;&nbsp;
            &nbsp;&nbsp;<input type="checkbox" name="Sun6" value="1" /> 第六场 &nbsp;&nbsp;
            <br>

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
        $(function () {
            var templateList = "<?php echo ($vo["session_template"]); ?>".split(",");
            var nowTemplate =  $("#session_template").val().split(",");
            console.log(templateList);

            $("input[type='checkbox']").each(function(i,cx){
                for(var i=0;i<templateList.length;i++){
                    if($(cx).attr('name')== templateList[i])
                        cx.checked = true;
                }
            });

            $("input[type='checkbox']").on("change", function () {
                var change = $(this).is(':checked'); //checkbox选中判断
                if (change) {
                    if($("#session_template").val() ==""){
                        $("#session_template").val($(this).attr('name')) ;
                    }else{
                        nowTemplate = $("#session_template").val().split(",");
                        nowTemplate.push($(this).attr('name'));
                        $("#session_template").val(nowTemplate.join(",")) ;
                    }

                }else{

                    nowTemplate = $("#session_template").val().split(",");
                    for(var i=0;i<nowTemplate.length;i++){
                        console.log(templateList);
                        if($(this).attr('name')== nowTemplate[i]){
                            nowTemplate.splice(i, 1);
                            $("#session_template").val(nowTemplate.join(",")) ;
                        }

                    }

                }
            })
        })




/*
$("input[type='checkbox']").click(function () {
    a = $("input[type='checkbox']",this).name();
    alert(a);
    $("#session_template").val($("input[name='AreaInfoArea_img']").val()) ;
  //  alert($("#session_template").val());
})*/



        $("#img-change").click(function () {
            $("#upfile").click();
        })

        $("#img-change2").click(function () {
            $("#upfile2").click();
        })

        $("#img-change3").click(function () {
            $("#upfile3").click();
        })
        /*$("#file").change(function (event) {*/
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
                    url: "https://daning-crm.cms.incker.com/api/upArea",
                    data: formData, //发送数据
                    success:function (res) {
                        console.log(res);
                        if(res.code == 200){
                            imgList = $("input[name='AreaInfoArea_img']").val().split(",");

                            imgList[0] = res.url;

                            $("input[name='AreaInfoArea_img']").val(imgList.join(","));
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

                imgList = $("input[name='AreaInfoArea_img']").val().split(",");

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
                    url: "https://daning-crm.cms.incker.com/api/upArea",
                    data: formData, //发送数据
                    success:function (res) {
                        console.log(res);
                        if(res.code == 200){
                            imgList = $("input[name='AreaInfoArea_img']").val().split(",");

                            if(imgList[0] !=""){
                                imgList[1] = res.url;
                            }else{
                                imgList[0] = res.url;
                            }
                            $("input[name='AreaInfoArea_img']").val(imgList.join(","));
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

                imgList = $("input[name='AreaInfoArea_img']").val().split(",");

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
                    url: "https://daning-crm.cms.incker.com/api/upArea",
                    data: formData, //发送数据
                    success:function (res) {
                        console.log(res);
                        if(res.code == 200){
                            imgList = $("input[name='AreaInfoArea_img']").val().split(",");

                            if(typeof(imgList[0]) == "undefined" || imgList[0] ==""){
                                imgList[0] = res.url;
                            }else if(typeof(imgList[1]) == "undefined" || imgList[1] ==""){
                                imgList[1] = res.url;
                            }else{
                                imgList[2] = res.url;
                            }



                            $("input[name='AreaInfoArea_img']").val(imgList.join(","));
                     //       alert($("input[name='AreaInfoArea_img']").val());
                        }

                    },

                    async: true, // 是否异步
                    processData: false, //processData 默认为false，当设置为true的时候,jquery ajax 提交的时候不会序列化 data，而是直接使用data
                    contentType: false //

                });
            }
        };


/*        $("#btn").click(function(){

            var formData = new FormData();
            formData.append("pic",document.getElementById("upfile").files[0]);
            $.ajax({
                type: "POST", // 数据提交类型
                url: "http://daning-crm.cms.incker.com/api/up",
                data: formData, //发送数据
                success:function (res) {
                    console.log(res);
                    if(res.code == 200){
                        $("input[name='AreaInfoArea_img']").val(res.url);
                        alert(res.url);
                    }

                },

                async: true, // 是否异步
                processData: false, //processData 默认为false，当设置为true的时候,jquery ajax 提交的时候不会序列化 data，而是直接使用data
                contentType: false //

            });
        });*/



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