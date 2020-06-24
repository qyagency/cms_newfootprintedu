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
        table {}

        .add {
            border-bottom: 10px solid #666666;
            /*下面4行是实现超过td文字变省略号,另外还要给table加上table-layout:fixed;*/
            text-overflow: ellipsis;
            -moz-text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        #atable {
            width: 1492px;
        }

        #atable thead th:first-child {
            width: 52px !important;
        }

        .activityLink {
            width: auto;
            margin-right: 0 !important;
        }

        .activityLink {
            background-color: #43CD80;
            color: #ffffff;

        }

        .screen {
            position: absolute;
            height: 34px;
            z-index: 1;
        }

        .screen .item {
            float: left;
            height: 100%;
            margin-right: 10px;
        }

        .screen .item .lab {
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

        input[type="date"] {
            display: inline-block;
            width: 110px;
        }

        #keyword {
            width: 300px;
        }

        #infoPage span {
            color: #0088cc;
            cursor: pointer;
        }

        #infoPage span.no {
            color: #cccccc;
            cursor: no-drop;
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

        select {
            height: 30px;
            border-radius: 0px;
            width: 100px;
            background: #fff;
            padding: 0px;
        }

        .ktx-mu-box {
            position: relative;
            height: 27px;
            border-radius: 3px;
            width: 118px;
            background: #fff;
            float: left;
            line-height: 27px;
            text-indent: 5px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding-right: 30px;
        }

        .ktx-mu-box::after {
            position: absolute;
            display: block;
            content: '';
            right: 10px;
            top: 12px;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid #777;
        }

        .ktx-form-box {
            float: left;
            margin-right: 20px;
            margin-bottom: 5px;
        }

        .ktx-form-line {
            overflow: hidden;
            padding: 5px 0px;
        }

        .ktx-form-btn {
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

        .ktx-form-btn-t {
            display: block;
            text-align: center;
            width: 100px;
            height: 30px;
            line-height: 30px;
            border-radius: 5px;
            background: #444;
            color: #fff;
            margin: 10px 0px 20px 0px;
        }

        .cover-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0);
            z-index: 666;
            top: 0;
            left: 0;
            display: none;
        }

        .ktx-pj {
            position: absolute;
            width: 300px;
            height: 170px;
            background: #fff;
            z-index: 666;
            top: 50%;
            left: 50%;
            margin-left: -150px;
            margin-top: -100px;
            box-shadow: #999 0px 0px 10px;
            border-radius: 5px;
            padding: 40px;
        }

        .ktx-form-btn-sure {
            text-align: center;
            width: 100px;
            height: 30px;
            line-height: 30px;
            border-radius: 5px;
            background: #444;
            color: #fff;
            margin: 20px 0px 0px 0px;
            margin-right: 10px;
            float: left;
        }

        .select-ll {
            width: 200px;
        }

        .ktx-pj-scroll {
            height: 250px;
        }


        .ktx-scroll {
            height: 130px;
        }

        .ktx-scroll-y {
            overflow-y: scroll;
        }

        .ktx-table {
            float: left;
            margin-top: 4px;
        }

        .kt-val-msg {
            float: left;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .js-tk-checked {
            overflow: hidden;
        }

        input {
            border: none;
        }

        .table-bordered>thead>tr>th,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>tbody>tr>td,
        .table-bordered>tfoot>tr>td {
            line-height: 35px;
        }

        .ktx-form-btn-reset {
            float: left;
            margin-left: 20px;
        }

        .ktx-form-btn-f {
            float: left;
        }

        .ktx-form-btn:hover {
            cursor: pointer;
        }
    </style>
    <div class="cover-bg js-ktx-pj">
        <!--评级修改-->
        <div class="ktx-pj">
            <div>
                <select class="select-ll" id="sel-pj">
                    <option value="高">高</option>
                    <option value="中">中</option>
                    <option value="低">低</option>
                </select>
            </div>
            <div class="ktx-form-btn-sure js-ktx-pj-sure">确定</div>
            <div class="ktx-form-btn-sure js-ktx-pj-cancel">取消</div>
        </div>
        <!--评级修改-->
    </div>

    <div class="cover-bg js-ktx-mk">
        <!--评级修改-->
        <div class="ktx-pj">
            <div>
                <input class="select-ll" placeholder="请输入" id="ktx-mk-input" />
            </div>
            <div class="ktx-form-btn-sure js-ktx-mk-sure">确定</div>
            <div class="ktx-form-btn-sure js-ktx-mk-cancel">取消</div>
        </div>
        <!--评级修改-->
    </div>

    <div class="cover-bg js-ktx-options">
        <!--评级修改-->
        <div class="ktx-pj ktx-pj-scroll">
            <div class="ktx-scroll"></div>
            <div class="ktx-form-btn-sure js-ktx-options-sure">确定</div>
            <div class="ktx-form-btn-sure js-ktx-options-cancel">取消</div>
        </div>
        <!--评级修改-->
    </div>

    <section class="panel">
        <!--表单-->
        <div>
            <!--第一行-->
            <div class="ktx-form-line">
                <div class="ktx-form-box">
                    注册时间：
                    <input type="date" id="re_start_date" />
                    -
                    <input type="date" id="re_end_date" />
                </div>
                <div class="ktx-form-box">
                    预约时间：
                    <input type="date" id="book_start_date" />
                    -
                    <input type="date" id="book_end_date" />
                </div>
                <div class="ktx-form-box">
                    <div class="ktx-table">活动渠道：</div>
                    <div class="ktx-mu-box" id="ktx-ch">全部</div>
                </div>
            </div>
            <!--第一行-->
            <!--第二行-->
            <div class="ktx-form-line">
                <div class="ktx-form-box">
                    <div class="ktx-table">活动名称：</div>
                    <div class="ktx-mu-box" id="ktx-aname">全部</div>
                </div>
                <div class="ktx-form-box">
                    <div class="ktx-table">表单编号：</div>
                    <div class="ktx-mu-box" id="ktx-tnum">全部</div>
                </div>
                <div class="ktx-form-box">
                    学员名称：
                    <input placeholder="请输入学员名称" id="l_name">
                </div>
                <div class="ktx-form-box">
                    <div class="ktx-table">学员性别：</div>
                    <select id="ktx-gd">
                        <option selected="selected">全部</option>
                        <option>男</option>
                        <option>女</option>
                    </select>
                </div>
            </div class="ktx-form-line">
            <!--第二行-->
            <!--第三行-->
            <div class="ktx-form-line">
                <div class="ktx-form-box">
                    <div class="ktx-table">学员年龄：</div>
                    <div class="ktx-mu-box" id="ktx-gl">全部</div>
                </div>
                <div class="ktx-form-box">
                    <div class="ktx-table">学员学校：</div>
                    <div class="ktx-mu-box" id="ktx-sch">全部</div>
                </div>
                <div class="ktx-form-box">
                    <div class="ktx-table">学长手机：</div>
                    <input placeholder="请输入学员名称" id="l_mobile">
                </div>
                <div class="ktx-form-box">
                    <div class="ktx-table">所属关系：</div>
                    <div class="ktx-mu-box" id="ktx-rl">全部</div>
                </div>
            </div>
            <!--第三行-->
            <div style="overflow: hidden;">
                <div class="ktx-form-btn ktx-form-btn-f" id="select-btn">
                    搜索
                </div>

                <div class="ktx-form-btn ktx-form-btn-reset" id="reset-btn">
                    重置选项
                </div>
            </div>
        </div>
        <!--表单-->
        <div class="panel-body" style="overflow:scroll;">
            <table class="table table-bordered table-condensed mb-none">
                <thead>
                    <tr>
                        <th width="50px">序号</th>
                        <th width="50px">是否重复</th>
                        <th>表单编号</th>
                        <th>活动渠道</th>
                        <th>活动名称</th>
                        <th>openid</th>
                        <th>家长手机</th>
                        <th>预约时间</th>
                        <th>学员姓名</th>
                        <th>学员性别</th>
                        <th>学员年级</th>
                        <th>学员学校</th>
                        <th>所属关系</th>
                        <th>评级</th>
                        <th>备注</th>
                        <th>员工姓名</th>
                        <th>所在地区</th>
                        <th>所属门店</th>
                    </tr>
                </thead>
                <tbody id="ktx-table">
                    <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr id="UserInfo_<?php echo ($k); ?>">
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><?php echo ($vo["is_repeat"]); ?></td>
                            <td><?php echo ($vo["form_id"]); ?></td>
                            <td><?php echo ($vo["channel_name"]); ?></td>
                            <td><?php echo ($vo["activity_name"]); ?></td>
                            <td class="add"><?php echo ($vo["user_union_id"]); ?></td>
                            <td><?php echo ($vo["user_mobile"]); ?></td>
                            <td><?php echo ($vo["booking_time"]); ?></td>
                            <td class="add"><?php echo ($vo["user_name"]); ?></td>
                            <td class="add"><?php echo ($vo["user_gender"]); ?></td>
                            <td class="add"><?php echo ($vo["user_grade"]); ?></td>
                            <td class="add"><?php echo ($vo["user_school"]); ?></td>
                            <td class="add"><?php echo ($vo["user_relation"]); ?></td>
                            <td class="add">
                                <lo class="js-rate"><?php echo ($vo["user_rate"]); ?></lo><i class="fa fa-pencil fa-pencil-a"></i>
                            </td>
                            <td class="add">
                                <lo class="js-remark"><?php echo ($vo["remark"]); ?></lo><i class="fa fa-pencil fa-pencil-b"></i>
                            </td>
                            <td class="add"><?php echo ($vo["sales_name"]); ?></td>
                            <td class="add"><?php echo ($vo["area_name"]); ?></td>
                            <td class="add"><?php echo ($vo["store_name"]); ?></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <?php echo ($page); ?>
        </div>
        <a class="ktx-form-btn-t" href="https://curiookids.incker.com/api/exportExcelForUserInfo">
            导出
        </a>
    </section>
    <script>
        $(function () {
            let options_arr = [];

            let edit_id = '';
            let edit_index = -1;

            $('.js-ktx-pj-sure').click(function () {
                setRate();
            })

            $('.js-ktx-mk-sure').click(function () {
                setMark();
            })

            $('.js-ktx-pj-cancel').click(function () {
                $('.js-ktx-pj').hide();
            })

            $('.js-ktx-mk-cancel').click(function () {
                $('.js-ktx-mk').hide();
            })

            $('.js-ktx-options-cancel').click(function () {
                $('.js-ktx-options').hide();
            });

            let edit_str = '';
            let ch_str = '';

            //活动渠道选择
            $('#ktx-ch').click(function () {
                edit_str = 'ktx-ch';
                ch_str = '';
                showOptionsChoice(options_arr.channelList);
            })

            $('#ktx-aname').click(function () {
                edit_str = 'ktx-aname';
                ch_str = '';
                showOptionsChoice(options_arr.activityList);
            })

            $('#ktx-tnum').click(function () {
                edit_str = 'ktx-tnum';
                ch_str = '';
                showOptionsChoice(options_arr.formList);
            })

            $('#ktx-gl').click(function () {
                edit_str = 'ktx-gl';
                ch_str = '';
                showOptionsChoice(options_arr.gradeList);
            })

            $('#ktx-sch').click(function () {
                edit_str = 'ktx-sch';
                ch_str = '';
                showOptionsChoice(options_arr.schoolList);
            })

            $('#ktx-rl').click(function () {
                edit_str = 'ktx-rl';
                ch_str = '';
                showOptionsChoice(options_arr.relationList);
            })

            $('.js-ktx-options-sure').click(function () {
                let str = '';
                $('.js-tk-checked').find('input').each(function () {
                    let is_ch = $(this).prop('checked');
                    let index = $('.js-tk-checked').find('input').index($(this));
                    if (is_ch) {
                        str += $('.kt-val-msg').eq(index).text() + ',';
                    }
                })
                if (str == '') {
                    str = '全部';
                } else {
                    str = str.substring(0, str.length - 1)
                }
                $('#' + edit_str).text(str);
                console.log(str);
                $('.js-ktx-options').hide();
            });

            function showOptionsChoice(options_arr) {
                let i = 0;
                let value = $('#' + edit_str).text();
                if (value == '全部') {
                    options_arr.forEach(element => {
                        ch_str +=
                            '<div class="js-tk-checked"><input style="margin-right:5px;float:left" type="checkbox" /><div class="kt-val-msg">' +
                            element + '</div></div>';
                    });
                } else {
                    let arr_val = value.split(',');
                    options_arr.forEach(element => {
                        let has = false;
                        arr_val.forEach(el => {
                            if (element == el) {
                                has = true;
                            }
                        });

                        if (has) {
                            ch_str +=
                                '<div class="js-tk-checked"><input style="margin-right:5px;float:left" type="checkbox" checked /><div class="kt-val-msg">' +
                                element + '</div></div>';
                        } else {
                            ch_str +=
                                '<div class="js-tk-checked"><input style="margin-right:5px;float:left" type="checkbox" /><div class="kt-val-msg">' +
                                element + '</div></div>';
                        }

                    });
                }
                if (value == '全部') {
                    ch_str =
                        '<div class="js-tk-checked"><input style="margin-right:5px;float:left" type="checkbox" checked/><div class="kt-val-msg">全部</div></div>' +
                        ch_str;
                } else {
                    ch_str =
                        '<div class="js-tk-checked"><input style="margin-right:5px;float:left" type="checkbox" /><div class="kt-val-msg">全部</div></div>' +
                        ch_str;
                }
                $('.ktx-scroll').html(ch_str);
                if (options_arr.length >= 7) {
                    $('.ktx-scroll').addClass('ktx-scroll-y');
                } else {
                    $('.ktx-scroll').removeClass('ktx-scroll-y');
                }
                $('.js-ktx-options').show();

                $('.kt-val-msg').on('click', function () {
                    let index = $('.kt-val-msg').index($(this));
                    let is_checked = $('.js-tk-checked').eq(index).find('input').prop('checked');
                    console.log(is_checked);
                    if (!is_checked) {
                        $('.js-tk-checked').eq(index).find('input').prop('checked', true);
                    } else {
                        $('.js-tk-checked').eq(index).find('input').prop('checked', false);
                    }

                    if (index != 0) {
                        if ($('.js-tk-checked').eq(0).find('input').prop('checked')) {
                            $('.js-tk-checked').eq(0).find('input').prop('checked', false);
                        }
                    } else {
                        if ($('.js-tk-checked').eq(0).find('input').prop('checked')) {
                            $('.js-tk-checked').find('input').each(function () {
                                let i_index = $('.js-tk-checked').find('input').index($(this));
                                if (i_index != 0) {
                                    $(this).prop('checked', false);
                                }
                            })
                        }
                    }
                });

                $('.js-tk-checked input').on('click', function () {
                    let index = $('.js-tk-checked input').index($(this));
                    if (index != 0) {
                        if ($('.js-tk-checked').eq(0).find('input').prop('checked')) {
                            $('.js-tk-checked').eq(0).find('input').prop('checked', false);
                        }
                    } else {
                        if ($('.js-tk-checked').eq(0).find('input').prop('checked')) {
                            $('.js-tk-checked').find('input').each(function () {
                                let i_index = $('.js-tk-checked').find('input').index($(this));
                                if (i_index != 0) {
                                    $(this).prop('checked', false);
                                }
                            })
                        }
                    }
                });
            }

            //设置评级
            function setRate() {
                $.ajax({
                    url: "https://curiookids.incker.com/api/updateUserRate",
                    type: 'post',
                    data: {
                        id: edit_id,
                        user_rate: $('#sel-pj').val()
                    },
                    success: function (res) {
                        $('.js-ktx-pj').hide();
                        $('.js-rate').eq(edit_index).html($('#sel-pj').val());
                    },
                    error: function (res) {
                        //that.postLock = true;
                    }
                });
            }

            //设置备注
            function setMark() {
                $.ajax({
                    url: "https://curiookids.incker.com/api/updateUserRemark",
                    type: 'post',
                    data: {
                        id: edit_id,
                        remark: $('#ktx-mk-input').val()
                    },
                    success: function (res) {
                        console.log(res);
                        $('.js-ktx-mk').hide();
                        $('.js-remark').eq(edit_index).html($('#ktx-mk-input').val());
                    },
                    error: function (res) {
                        //that.postLock = true;
                    }
                });
            }


            $.ajax({
                url: "https://curiookids.incker.com/api/getDropDownInfo",
                type: 'post',
                // data: {
                //     user_project: lival
                // },
                success: function (res) {
                    console.log(res)
                    options_arr = res;
                    //初始化渠道
                    // let ch_str = '<option>全部</option>';
                    // res.channelList.forEach(element => {
                    //     ch_str += '<option>' + element + '</option>';
                    // });
                    // $('#ktx-ch').html(ch_str) //渠道

                    // let ch_aname = '<option>全部</option>';
                    // res.activityList.forEach(element => {
                    //     ch_aname += '<option>' + element + '</option>';
                    // });
                    // $('#ktx-aname').html(ch_aname) //活动名称

                    // let tnum_str = '<option>全部</option>';
                    // res.formList.forEach(element => {
                    //     tnum_str += '<option>' + element + '</option>';
                    // });
                    // $('#ktx-tnum').html(tnum_str) //表单编号

                    // let gl_str = '<option>全部</option>';
                    // res.gradeList.forEach(element => {
                    //     gl_str += '<option>' + element + '</option>';
                    // });
                    // $('#ktx-gl').html(gl_str) //学员年龄


                    // let sch_str = '<option>全部</option>';
                    // res.schoolList.forEach(element => {
                    //     sch_str += '<option>' + element + '</option>';
                    // });
                    // $('#ktx-sch').html(sch_str) //学员学校


                    // let rl_str = '<option>全部</option>';
                    // res.relationList.forEach(element => {
                    //     rl_str += '<option>' + element + '</option>';
                    // });
                    // $('#ktx-rl').html(rl_str) //学员学校
                },
                error: function (res) {
                    //that.postLock = true;
                }
            });

            $('#reset-btn').click(function () {
                $('#re_start_date').val('');
                $('#re_end_date').val('');
                $('#book_start_date').val('');
                $('#book_end_date').val('');
                $('#l_mobile').val('');
                $('#l_name').val('');

                $('#ktx-ch').text('全部') //渠道
                $('#ktx-aname').text('全部') //活动名称
                $('#ktx-tnum').text('全部') //表单编号
                $('#ktx-gl').text('全部') //学员年龄
                $('#ktx-sch').text('全部') //学员学校
                $('#ktx-rl').text('全部') //学员学校

                $('#ktx-gd').val('全部') //学员性别
            })

            function getDataList() {
                let re_start_date = $('#re_start_date').val();
                let re_end_date = $('#re_end_date').val();
                let book_start_date = $('#book_start_date').val();
                let book_end_date = $('#book_end_date').val();
                let l_mobile = $('#l_mobile').val();
                let l_name = $('#l_name').val();

                let ktx_ch = $('#ktx-ch').text() //渠道
                let ktx_aname = $('#ktx-aname').text() //活动名称
                let ktx_tnum = $('#ktx-tnum').text() //表单编号
                let ktx_gl = $('#ktx-gl').text() //学员年龄
                let ktx_sch = $('#ktx-sch').text() //学员学校
                let ktx_rl = $('#ktx-rl').text() //学员学校

                let ktx_gd = $('#ktx-gd').val() //学员性别

                console.log(re_start_date);
                console.log(book_start_date);
                console.log(book_end_date);
                console.log(ktx_ch);
                let p_data = {};
                if (re_start_date) {
                    p_data['reg_start_time'] = re_start_date;
                }
                if (re_end_date) {
                    p_data['reg_end_time'] = re_end_date;
                }
                if (book_start_date) {
                    p_data['book_start_time'] = book_start_date;
                }
                if (book_end_date) {
                    p_data['book_end_time'] = book_end_date;
                }
                if (l_mobile) {
                    p_data['user_mobile'] = l_mobile;
                }
                if (l_name) {
                    p_data['user_name'] = l_name;
                }
                if (ktx_ch != '' && ktx_ch != '全部') {
                    p_data['channel_name'] = ktx_ch
                }
                if (ktx_aname != '' && ktx_aname != '全部') {
                    p_data['activity_name'] = ktx_aname
                }
                if (ktx_tnum != '' && ktx_tnum != '全部') {
                    p_data['form_id'] = ktx_tnum
                }
                if (ktx_gd != '' && ktx_gd != '全部') {
                    p_data['user_gender'] = ktx_gd
                }
                if (ktx_gl != '' && ktx_gl != '全部') {
                    p_data['user_grade'] = ktx_gl
                }
                if (ktx_sch != '' && ktx_sch != '全部') {
                    p_data['user_school'] = ktx_sch
                }

                if (ktx_rl != '' && ktx_rl != '全部') {
                    p_data['user_relation'] = ktx_rl
                }

                $.ajax({
                    url: "https://curiookids.incker.com/api/getUserInfoByFilt",
                    type: 'post',
                    data: p_data,
                    success: function (res) {
                        console.log(res);
                        let t_str = '';
                        $('#ktx-table').html('');
                        let i = 1;
                        res.user_info.forEach(element => {
                            let user_rate = element.user_rate ? element.user_rate : '';
                            let remark = element.remark ? element.remark : '';

                            t_str += `<tr id="UserInfo_` + i + `">
                                <td>` + element.id + `</td>
                                <td>` + element.is_repeat + `</td>
                                <td>` + element.form_id + `</td>
                                <td>` + element.channel_name + `</td>
                                <td>` + element.activity_name + `</td>
                                <td class="add">` + element.user_union_id + `</td>
                                <td>` + element.user_mobile + `</td>
                                <td>` + element.booking_time + `</td>
                                <td class="add">` + element.user_name + `</td>
                                <td class="add">` + element.user_gender + `</td>
                                <td class="add">` + element.user_grade + `</td>
                                <td class="add">` + element.user_school + `</td>
                                <td class="add">` + element.user_relation + `</td>
                                <td class="add"><lo class="js-rate">` + user_rate +
                                `</lo><i class="fa fa-pencil fa-pencil-a" id="` + element
                                .id + `" data-val="` + user_rate + `"></i></td>
                                <td class="add"><lo class="js-remark">` + remark +
                                `</lo><i class="fa fa-pencil fa-pencil-b" id="` + element
                                .id +
                                `" data-val="` + remark + `"></i></td>
                                <td class="add">` + element.sales_name + `</td>
                                <td class="add">` + element.area_name + `</td>
                                <td class="add">` + element.store_name + `</td>
                            </tr>`;

                            i++;
                        });
                        $('#ktx-table').html(t_str);

                        $('.fa-pencil-a').on('click', function () {
                            edit_id = $(this).attr('id');
                            edit_index = $('.fa-pencil-a').index($(this));
                            let edit_value = $(this).attr('data-val');
                            if (edit_value) {
                                $('#sel-pj').val(edit_value)
                            } else {
                                $('#sel-pj').val('高')
                            }
                            //设置评级
                            // setRate(id, value);
                            $('.js-ktx-pj').show();

                        })
                        $('.fa-pencil-b').on('click', function () {
                            edit_id = $(this).attr('id');
                            edit_index = $('.fa-pencil-b').index($(this));
                            let edit_value = $(this).attr('data-val');
                            if (edit_value) {
                                $('#ktx-mk-input').val(edit_value)
                            } else {
                                $('#ktx-mk-input').val('')
                            }
                            $('.js-ktx-mk').show();
                            //设置备注
                            // setMark(id, value);
                        })
                    },
                    error: function () {
                        //that.postLock = true;
                    }
                });
            }


            $('#select-btn').click(function () {
                getDataList();
            });

            getDataList();
        });
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