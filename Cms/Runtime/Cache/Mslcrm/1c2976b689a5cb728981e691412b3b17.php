<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="fixed">
<head>
    <meta charset="UTF-8">
    <title>
        客户信息 - 列表 | HAPPY-SHARE Admin - Responsive HTML5 CMS
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
</head>
<body>
<section class="body">

    <!-- start: header -->
    <header class="header">
    <div class="logo-container">
        <a href="../" class="logo">
            <!--<img src="/Public/chellon/image/common/logo.jpg" height="35" alt="壳隆官网 | 管理后台" />-->
            明思力客户问卷系统
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
        .mailbtn,.filebtn,.dowload{
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
        .projectList{
            width: 600px;
        }
        .projectList .list{
            height:400px ;
            margin-top: 20px;
            text-align: left;
        }
        .projectList h2,
        .upfile h2{
            font-size: 16px;
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
        .projectList .list{
            overflow-y: auto;
        }
        .dowload{
            left: 145px;
        }
        .dowpop{
            display: none;
            position: fixed;
            background: #fff;
            border-radius: 10px;
            padding: 10px 40px;
            z-index: 999999;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
            left: 50%;
            top: 50%;
            transform: translateX(-50%) translateY(-50%);
        }
        .dowpop h3{
            font-size: 16px;
            margin-bottom: 40px;
        }
        .dowpop ul{
            margin-bottom: 40px;
        }
        .dowpop li{
            display: inline-block;
            vertical-align: middle;
            margin: 0 10px;
            background:#0088cc ;
            color: #fff;
            font-size: 14px;
            border-radius: 6px;
        }
        .dowpop li a{
            color: #fff;
            display: block;
            padding:2px 10px;
        }

    </style>
    <section class="panel">
        <div class="panel-body">
            <div class="screen">
                <div class="item">
                    <div class="lab">客户姓名：</div>
                    <input placeholder="请输入姓名" id="name">
                </div>
                <div class="item">
                    <div class="lab">地区：</div>
                    <select id="locationList">
                        <option>全部</option>
                    </select>
                </div>
                <div class="item">
                    <div class="lab">项目名称：</div>
                    <select id="projectList">
                        <option>全部</option>
                    </select>
                </div>
            </div>
            <div class="mailbtn">
                <span class="btn btn-xs btn-primary ml-sm mr-sm sendmail">发送邮件</span>
            </div>
            <div class="filebtn">
                <label for="file" class="btn btn-xs btn-primary ml-sm mr-sm uploadfile">上传数据</label>
                <input type="file" id="file" name="file" style="display: none">
            </div>
            <div class="dowload">
                <span  class="btn btn-xs btn-primary ml-sm mr-sm">下载模板</span>
            </div>
            <table id="datatable" class="table table-bordered table-condensed mb-none">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>客户姓名</th>
                    <th>地区</th>
                    <th>项目名称</th>
                    <th>邮箱</th>
                    <th>所属公司</th>
                    <th>发送次数</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr id="ClientInfo_<?php echo ($k); ?>">
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["user_name"]); ?></td>
                        <td><?php echo ($vo["user_location"]); ?></td>
                        <td><?php echo ($vo["user_project"]); ?></td>
                        <td><?php echo ($vo["user_email"]); ?></td>
                        <td><?php echo ($vo["user_company"]); ?></td>
                        <td><?php echo ($vo["send_times"]); ?></td>
                        <td><?php echo (translateStatus($vo["user_status"])); ?></td>
                        <td>
                            <?php if(in_array(($cEdit), is_array($_SESSION['routes'])?$_SESSION['routes']:explode(',',$_SESSION['routes']))): ?><a href="<?php echo U('/ClientInfo/edit/id/'.$vo['id']);?>" class="btn btn-xs btn-primary ml-sm mr-sm"><i class="fa fa-pencil"></i> 编辑</a><?php endif; ?>
                            <?php if(in_array(($cDelete), is_array($_SESSION['routes'])?$_SESSION['routes']:explode(',',$_SESSION['routes']))): ?><a data-target="ClientInfo_<?php echo ($k); ?>" data-href="<?php echo U('/ClientInfo/delete/id/'.$vo['id']);?>"
                                   data-toggle="confirmation" class="btn btn-xs btn-primary"><i
                                        class="fa fa-trash-o"></i> 删除</a><?php endif; ?>
                            <?php if($vo["user_status"] == 2): ?><a href="javascript:void(0)" data-id="<?php echo ($vo['id']); ?>"  class="btn btn-xs btn-primary ml-sm mr-sm popshow"><i class="fa fa-pencil"></i> 查看</a><?php endif; ?>

                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <?php echo ($page); ?>

        </div>
        <div class="msl-popbox">
            <div class="user-cont">
               <div class="tables">
                   <table id="table1">
                       <tr>
                           <td class="width1">用户1</td>
                           <td class="width2">公司1</td>
                       </tr>
                   </table>
                   <table id="table2">
                       <thead>
                       <tr>
                           <th style="width: 90px;">问题</th>
                           <th style="width: 90px;">分数</th>
                           <th>评论</th>
                       </tr>
                       </thead>
                       <tbody></tbody>
                   </table>
               </div>
            </div>
            <div class="projectList">
                <h2>选择要发送的项目</h2>
                <div class="list">
                    <ul></ul>
                </div>
            </div>
            <div class="close"></div>
        </div>
        <div class="dowpop">
            <h3>确定要下载模板？</h3>
            <ul>
                <li><a href="http://msl-crm.cms.incker.com/Public/EmailPic/template.xls">确定</a> </li>
                <li><a>取消</a></li>
            </ul>
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
<script src="/Public/vendor/echarts/jquery.table2excel.js"></script>
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
        /***明思力 新增js***/

        var pop=$('.msl-popbox'),
            tab1=$('#table1'),
            td=tab1.find('td'),
            tbody=$('#table2').find('tbody'),
            datatable = $('#datatable tbody');

        var user='用户名',//用户名
            company='公司名称',//公司
            mark=null,//评分
            comment=null;//评论

        var lival = '';
        // var uname = "<?php echo ($user_name); ?>",
        //     uloct ="<?php echo ($user_location); ?>",
        //     upro = "<?php echo ($user_project); ?>";

        // setTimeout(function () {
        //     $('#name').val(uname)
        //     $('#locationList').val(uloct)
        //     $('#projectList').val(upro)
        // },200)

        $.ajax({
            url: "http://msl-crm.cms.incker.com/api/getDropDownInfo",
            type: 'post',
            success: function (res) {
                console.log(res)
                for (var i=0;i<res.locationList.length;i++){
                    $('#locationList').append('<option>'+res.locationList[i]+'</option>')
                }
                for (var i=0;i<res.projectList.length;i++){
                    $('#projectList').append('<option>'+res.projectList[i]+'</option>')
                    $('.projectList ul').append('<li>'+res.projectList[i]+'</li>')
                }
            },
            error: function () {
                //that.postLock = true;
            }
        });



        //打开弹层
        datatable.on('click','.popshow',function () {
            user_id =$(this).data("id");
            td.html('');
            $('.projectList').hide();
            tbody.empty();

             $.ajax({
                 url: "http://msl-crm.cms.incker.com/api/getUserSurveyDetails",
                 type: 'post',
                 data: {"user_id":user_id},
                 success: function (res) {

                    if(res.is_anonymous == 0){
                        $(td[0]).html(res.user_name);
                        $(td[1]).html(res.user_company);
                    }else {
                        $(td[0]).html("匿名");
                        $(td[1]).html("匿名");
                    }


                     for (var i=0;i<18;i++) {
                         mark = res['score_' + (i+1)];
                         comment = res['remark_' + (i+1)];

                         tbody.append('<tr><td>Q'+(i+1)+'</td><td>'+ mark+ '</td><td class="comt">'+comment+'</td></tr>')
                     }
                 },
                 error: function () {
                     //that.postLock = true;
                 }
             });

             $('.user-cont').show();
            pop.fadeIn(200)

        });

        //关闭弹层
        $('.close').click(function () {
            pop.fadeOut(200);
        })

        //显示完整内容
        tbody.on('mouseenter','.comt',function (e) {
            var t=$(this).text();
            var y= e.originalEvent.y || e.originalEvent.layerY || 0;
            if (t!='') {
                $('.user-cont').append('<p class="alltext">'+ t +'</p>')
            }
            $('.alltext').css('top',y-$('.user-cont').offset().top)
        })
        tbody.on('mouseleave','.comt',function () {
            $('.alltext').remove();
        })
        /*****/
        //发送邮件
        $('.projectList').on('click','li',function () {
            lival=$(this).text();
            if (lival!=''){
                $.ajax({
                    url: "http://msl-crm.cms.incker.com/api/sendEmail",
                    type: 'post',
                    data: {
                        user_project:lival
                    },
                    success: function (res) {

                        console.log(res)
                        if(res==200){
                            alert("邮件发送成功");
                            window.location.href="http://msl-crm.cms.incker.com/ClientInfo/list.html";
                        }
                    },
                    error: function (res) {
                        //that.postLock = true;
                    }
                });
            }
            pop.fadeOut(200);
        })

        $('.sendmail').click(function () {
           // var boo = confirm('确认发送邮件吗?')
            //confirm 会返回你选择的选项,然后可以依据选择执行逻辑
            $('.user-cont').hide();
            $('.projectList').show();
            pop.fadeIn(200)
        })

        $('#file').change(function (event) {
            var fileList = event.target.files;
            if (fileList.length > 0) {
                var file = fileList[0];
                var formData = new FormData();
                formData.append('uploadFile', file);
                //你的post接口，formData发送
                //console.log(formData.get('uploadFile'))
                $.ajax({
                    type: "POST", // 数据提交类型
                    url: "http://msl-crm.cms.incker.com/api/getExcelFileInfo", // 发送地址
                    data: formData, //发送数据
                    success:function (res) {
                        if(res==200){
                            alert("文件上传成功");
                            window.location.href="http://msl-crm.cms.incker.com/ClientInfo/list.html";
                        }else {
                            alert("文件格式错误!")
                        }
                    },
                    async: true, // 是否异步
                    processData: false, //processData 默认为false，当设置为true的时候,jquery ajax 提交的时候不会序列化 data，而是直接使用data
                    contentType: false
                });
            }
        })

        // 筛选
        var input = $('.screen input'),
            select1 = $($('.screen select')[0]),
            select2 = $($('.screen select')[1]);

        var page_arr=[];

        function change(val,v1,v2) {
            val.change(function () {
                var that = $(this),
                    v = that.val(),
                    data = {};

                switch (val) {
                    case input :
                        data = {
                            user_name : val.val(),
                            user_location : v1.val(),
                            user_project: v2.val()
                        };
                        break;
                    case select1:
                        data = {
                            user_name: v1.val(),
                            user_location : val.val(),
                            user_project: v2.val()
                        };
                        break;
                    case select2:
                        data = {
                            user_name : v2.val(),
                            user_location : v1.val(),
                            user_project: val.val()
                        }
                }

                $.ajax({
                    url: "http://msl-crm.cms.incker.com/api/getUserInfo",
                    type: 'post',
                    data:data,
                    success: function (res) {
                        console.log(res)
                        datatable.empty();
                        $('#infoPage').empty();
                        var pg = res.list.length,
                            size=10,
                            page = Math.ceil(pg/size),
                            page_index=0,
                            data =[];

                        for (var i=0;i<page;i++){
                            var pur=[];

                            for (var j=0;j<size;j++){

                                let n=page_index*size+j;
                                pur.push(res.list[n]);
                                if(n>=(pg-1)){
                                    break;
                                }
                            }

                            page_index++;
                            data.push(pur);
                            $('#infoPage').append('<span class>'+(i+1)+'</span>')
                        }
                        page_arr=data;

                        console.log(data)
                        for (var i=0;i<data[0].length;i++){

                            var statu='',
                                look = '';
                            switch (data[0][i]['user_status']) {
                                case '0':
                                    statu = '未发送';
                                    break;
                                case '1':
                                    statu = '待填写';
                                    break;
                                case '2':
                                    statu = '已填写';
                                    look = '<a href="javascript:void(0)" data-id="'+data[0][i]['id']+'"  class="btn btn-xs btn-primary ml-sm mr-sm popshow"><i class="fa fa-pencil"></i> 查看</a>'
                                    break;
                                default:
                                    statu = '不在发送';
                            }
                            datatable.append('<tr id="ClientInfo_'+(i+1)+'"><td>'+
                                data[0][i]['id']
                                +'</td><td>'+
                            data[0][i]['user_name']
                            +'</td><td>'+
                                data[0][i]['user_location']
                                +'</td><td>'+
                                data[0][i]['user_project']
                            +'</td> <td>'+
                                data[0][i]['user_email']
                                +'</td><td>'+
                                data[0][i]['user_company']
                                +'</td><td>'+
                                data[0][i]['send_times']
                                +'</td><td>'+
                                statu
                                +'</td><td><a href="/ClientInfo/edit/id/'+
                                data[0][i]['id']
                                +'.html" class="btn btn-xs btn-primary ml-sm mr-sm"><i class="fa fa-pencil"></i> 编辑</a>' +
                                '<a href="/ClientInfo/delete/id/'+ data[0][i]['id']+'.html" data-toggle="confirmation" class="btn btn-xs btn-primary"><i class="fa fa-trash-o"></i> 删除</a>'+
                                look
                                + '</td></tr>')
                        }

                    },
                    error: function () {
                        //that.postLock = true;
                    }
                });
            })
        }

        $('#infoPage').on('click','span',function () {
            var z= $('#infoPage span').index($(this))

            datatable.empty();
            $(this).addClass('current').siblings().removeClass('current');

            for (var i=0;i<page_arr[z].length;i++){

                var statu='',
                    look = '';
                console.log(page_arr[z][i]['user_status'])
                switch (page_arr[z][i]['user_status']) {
                    case '0':
                        statu = '未发送';
                        break;
                    case '1':
                        statu = '待填写';
                        break;
                    case '2':
                        statu = '已填写';
                        look = '<a href="javascript:void(0)" data-id="'+page_arr[z][i]['id']+'"  class="btn btn-xs btn-primary ml-sm mr-sm popshow"><i class="fa fa-pencil"></i> 查看</a>'
                        break;
                    default:
                        statu = '不再发送';
                }
                console.log(statu)
                datatable.append('<tr id="ClientInfo_'+(i+1)+'"><td>'+
                    page_arr[z][i]['id']
                    +'</td><td>'+
                    page_arr[z][i]['user_name']
                    +'</td><td>'+
                    page_arr[z][i]['user_location']
                    +'</td><td>'+
                    page_arr[z][i]['user_project']
                    +'</td> <td>'+
                    page_arr[z][i]['user_email']
                    +'</td><td>'+
                    page_arr[z][i]['user_company']
                    +'</td><td>'+
                    page_arr[z][i]['send_times']
                    +'</td><td>'+
                    statu
                    +'</td><td><a href="/ClientInfo/edit/id/'+
                    page_arr[z][i]['id']
                    +'.html" class="btn btn-xs btn-primary ml-sm mr-sm"><i class="fa fa-pencil"></i> 编辑</a>' +
                    '<a href="/ClientInfo/delete/id/'+ page_arr[z][i]['id']+'.html" data-toggle="confirmation" class="btn btn-xs btn-primary"><i class="fa fa-trash-o"></i> 删除</a>'+
                    look
                    + '</td></tr>')
            }

        })
        function standardPost (url,args)
        {
            var form = $("<form method='post'></form>");
            form.attr({"action":url});
            for (arg in args)
            {
                var input = $("<input type='hidden'>");
                input.attr({"name":arg});
                input.val(args[arg]);
                form.append(input);
            }
            $("html").append(form);
            form.submit();
        }

        change(input,select1,select2);
        change(select1,input,select2);
        change(select2,select1,input);


        $('.dowload').click(function () {
            $('.dowpop').show()

        })
        $('.dowpop').on('click','li',function () {
            $('.dowpop').hide()
        })
    </script>



</body>
</html>