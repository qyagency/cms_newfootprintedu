<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="fixed">
<head>
    <meta charset="UTF-8">
    <title>
        客户满意度统计 - 列表 | HAPPY-SHARE Admin - Responsive HTML5 CMS
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
            

    <script type="text/javascript" src="/Public/vendor/echarts/echarts.js"></script>
    <style type="text/css">
        table{
            table-layout: fixed;
        }
        .sendmail {
            margin-bottom: 10px;
            margin-left: 0px;
        }

        .screen{
            height: 40px;
            margin-bottom: 20px;
        }
        .screen .item{
            float: left;
            width: 260px;
        }
        .screen .lab{
            float: left;
            line-height: 38px;
            font-size: 18px;
            font-weight: bold;
        }
        .screen select,
        .screen input{
            width: 160px;
            height: 36px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: #fff;
            padding: 0 14px;
        }
        #infoPage span{
            color: #0088cc
        }
        #infoPage .current{
            color:#777
        }
        th,td{
            overflow: hidden;
        }
        td{
            cursor: pointer;
        }
        .sat_order{
            position: relative;
            cursor: pointer;
        }
        .sat_order:after,
        .sat_order:before{
            display: block;
            position: absolute;
            font-family: FontAwesome;
            font-size: 16px;
            font-weight: bold;
            color: #777;
            right: 6px;
        }
        .sat_order:after{
            content: "\f107";
            bottom: -2px;
        }
        .sat_order:before{
            content: '\f106';
            top: -2px;
        }
        .export{
            padding: 0 10px;
            background: #0088cc;
            color: #fff;
            display: inline-block;
            line-height: 28px;
            border-radius: 4px;
            margin-bottom: 10px;
            cursor: pointer;
        }
        #export tbody td:nth-child(7){
            color: #0088cc;
        }
    </style>

    <div class="screen">
        <div class="item">
            <div class="lab">地区：</div>
            <select id="locationList">
                <option value ="全部">全部</option>
            </select>
        </div>
        <div class="item">
            <div class="lab">项目名称：</div>
            <select id="projectList">
                <option value ="全部">全部</option>
            </select>
        </div>
    </div>

    <!-- 为ECharts准备一个具备大小（宽高）的DOM -->
    <div id="main" style="width: 100%; height: 400px;"  ></div>

    <section class="panel">
        <div class="panel-body">
            <div class="export" id="excelOut">导出表格</div>
            <table  class="table table-bordered table-condensed mb-none" id="export">
                <!--<span class="btn btn-xs btn-primary  mr-sm sendmail" onclick="changeStatus(0)">填写日期降序</span>-->
                <!--<span class="btn btn-xs btn-primary  mr-sm sendmail" onclick="changeStatus(1)">填写日期升序</span>-->

                <thead>
                <tr>
                    <th style="width: 40px">序号</th>
                    <th style="width: 70px">客户姓名</th>
                    <th style="width: 70px">地区</th>
                    <th style="width: 100px">项目名称</th>
                    <th style="width: 130px">邮箱</th>
                    <th >所属公司</th>
                    <th style="width: 90px" class="sat_order">满意度(%)</th>
                    <th style="width: 130px">填写日期</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr id="booking_<?php echo ($k); ?>">
                        <td title=<?php echo ($vo["id"]); ?>><?php echo ($vo["id"]); ?></td>
                        <td title=<?php echo ($vo["user_name"]); ?>><?php echo ($vo["user_name"]); ?></td>
                        <td title=<?php echo ($vo["user_location"]); ?>><?php echo ($vo["user_location"]); ?></td>
                        <td title=<?php echo ($vo["user_project"]); ?>><?php echo ($vo["user_project"]); ?></td>
                        <td title=<?php echo ($vo["user_email"]); ?>><?php echo ($vo["user_email"]); ?></td>
                        <td title=<?php echo ($vo["user_company"]); ?>><?php echo ($vo["user_company"]); ?></td>
                        <td title=<?php echo ($vo["user_sat"]); ?> data-id=<?php echo ($vo["user_id"]); ?>><?php echo ($vo["user_sat"]); ?></td>
                        <td title=<?php echo ($vo["fdate"]); ?>><?php echo ($vo["fdate"]); ?></td>
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
        <div style="display: none">
            <table  class="table table-bordered table-condensed mb-none" id="export2">
                <!--<span class="btn btn-xs btn-primary  mr-sm sendmail" onclick="changeStatus(0)">填写日期降序</span>-->
                <!--<span class="btn btn-xs btn-primary  mr-sm sendmail" onclick="changeStatus(1)">填写日期升序</span>-->

                <thead>
                <tr>
                    <th style="width: 40px">序号</th>
                    <th style="width: 70px">客户姓名</th>
                    <th style="width: 70px">地区</th>
                    <th style="width: 100px">项目名称</th>
                    <th style="width: 130px">邮箱</th>
                    <th >所属公司</th>
                    <th style="width: 90px" class="sat_order">满意度(%)</th>
                    <th style="width: 130px">填写日期</th>
                    <th>score_1</th>
                    <th>score_2</th>
                    <th>score_3</th>
                    <th>score_4</th>
                    <th>score_5</th>
                    <th>score_6</th>
                    <th>score_7</th>
                    <th>score_8</th>
                    <th>score_9</th>
                    <th>score_10</th>
                    <th>score_11</th>
                    <th>score_12</th>
                    <th>score_13</th>
                    <th>score_14</th>
                    <th>score_15</th>
                    <th>score_16</th>
                    <th>score_17</th>
                    <th>score_18</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr id="booking_<?php echo ($k); ?>+1">
                        <td title=<?php echo ($vo["id"]); ?>><?php echo ($vo["id"]); ?></td>
                        <td title=<?php echo ($vo["user_name"]); ?>><?php echo ($vo["user_name"]); ?></td>
                        <td title=<?php echo ($vo["user_location"]); ?>><?php echo ($vo["user_location"]); ?></td>
                        <td title=<?php echo ($vo["user_project"]); ?>><?php echo ($vo["user_project"]); ?></td>
                        <td title=<?php echo ($vo["user_email"]); ?>><?php echo ($vo["user_email"]); ?></td>
                        <td title=<?php echo ($vo["user_company"]); ?>><?php echo ($vo["user_company"]); ?></td>
                        <td title=<?php echo ($vo["user_sat"]); ?> data-id=<?php echo ($vo["user_id"]); ?>><?php echo ($vo["user_sat"]); ?></td>
                        <td title=<?php echo ($vo["fdate"]); ?>><?php echo ($vo["fdate"]); ?></td>
                        <td title=<?php echo ($vo["score_1"]); ?>><?php echo ($vo["score_1"]); ?></td>
                        <td title=<?php echo ($vo["score_2"]); ?>><?php echo ($vo["score_2"]); ?></td>
                        <td title=<?php echo ($vo["score_3"]); ?>><?php echo ($vo["score_3"]); ?></td>
                        <td title=<?php echo ($vo["score_4"]); ?>><?php echo ($vo["score_4"]); ?></td>
                        <td title=<?php echo ($vo["score_5"]); ?>><?php echo ($vo["score_5"]); ?></td>
                        <td title=<?php echo ($vo["score_6"]); ?>><?php echo ($vo["score_6"]); ?></td>
                        <td title=<?php echo ($vo["score_7"]); ?>><?php echo ($vo["score_7"]); ?></td>
                        <td title=<?php echo ($vo["score_8"]); ?>><?php echo ($vo["score_8"]); ?></td>
                        <td title=<?php echo ($vo["score_9"]); ?>><?php echo ($vo["score_9"]); ?></td>
                        <td title=<?php echo ($vo["score_10"]); ?>><?php echo ($vo["score_10"]); ?></td>
                        <td title=<?php echo ($vo["score_11"]); ?>><?php echo ($vo["score_11"]); ?></td>
                        <td title=<?php echo ($vo["score_12"]); ?>><?php echo ($vo["score_12"]); ?></td>
                        <td title=<?php echo ($vo["score_13"]); ?>><?php echo ($vo["score_13"]); ?></td>
                        <td title=<?php echo ($vo["score_14"]); ?>><?php echo ($vo["score_14"]); ?></td>
                        <td title=<?php echo ($vo["score_15"]); ?>><?php echo ($vo["score_15"]); ?></td>
                        <td title=<?php echo ($vo["score_16"]); ?>><?php echo ($vo["score_16"]); ?></td>
                        <td title=<?php echo ($vo["score_17"]); ?>><?php echo ($vo["score_17"]); ?></td>
                        <td title=<?php echo ($vo["score_18"]); ?>><?php echo ($vo["score_18"]); ?></td>

                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>

            </table>
        </div>
    </section>
    <script type="text/javascript">


        $(function a() {

            var list =[<?php echo ($pieList); ?>];
            var namelist = [];
            //  var satlist = [];
            for (var i=0;i<list[0].length;i++) {
                 namelist.push(list[0][i]["name"]);
            }
            console.log(list,namelist)
           // console.log(satlist);
            /*基于准备好的dom，初始化echarts实例*/
            var myChart = echarts.init(document.getElementById('main'));

            // option = {
            //     title: {
            //         text: '客户满意度统计',
            //         subtext: '邮件问卷调查'
            //     },
            //     tooltip: {
            //         trigger: 'axis',
            //         axisPointer: {
            //             type: 'shadow'
            //         }
            //     },
            //     legend: {
            //         name:'客户满意度',
            //         data: ['客户满意度']
            //     },
            //     grid: {
            //         left: '3%',
            //         right: '4%',
            //         bottom: '3%',
            //         containLabel: true
            //     },
            //     xAxis: {
            //         //name:'总体平均分值',
            //         type: 'category',
            //         data: namelist
            //
            //     },
            //     yAxis: {
            //         type: 'value',
            //         max:100
            //
            //     },
            //     series: [
            //         {
            //             name: '客户满意度',
            //             type: 'bar',
            //             color:'#38a9ae',
            //             data: satlist
            //         }
            //     ]
            // };

            option = {
                title : {
                    text: '客户满意度统计',
                    subtext: '邮件问卷调查',
                    x:'center'
                },
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient: 'vertical',
                    left: 'left',
                    data: namelist
                },
                series : [
                    {
                        name: '客户满意度',
                        type: 'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        data:list[0],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };


            /*     $.ajax({
                     url: "http://msl-crm.cms.incker.com/api/getSurveyAve",
                     type: 'post',
                     success: function (res) {
                       //  var data = $.parseJSON(res);
                         // 填入数据
                         myChart.setOption({
                             series: [{
                                 data: res
                             }]
                         });
                     },
                     error: function () {
                         //that.postLock = true;
                     }
                 });

     */
            // 使用刚指定的配置项和数据显示图表
            myChart.setOption(option);

            var location = $('#locationList'),
                project = $('#projectList'),
                datatable = $('.panel-body tbody'),
                page_arr=[];

            $.ajax({
                url: "http://msl-crm.cms.incker.com/api/getDropDownInfo2",
                type: 'post',
                success: function (res) {
                    console.log(res)
                    for (var i=0;i<res.locationList.length;i++){
                        location.append('<option>'+res.locationList[i]+'</option>')
                    }
                    for (var i=0;i<res.projectList.length;i++){
                        project.append('<option>'+res.projectList[i]+'</option>')
                    }

                },
                error: function () {
                    //that.postLock = true;
                }
            });

            function changeStatus(data) {
                window.location.href="http://msl-crm.cms.incker.com/ClientSurvey/list?order="+data;
            }

            function change(s1,s2) {
                s1.change(function () {
                    var that = $(this),
                        v = that.val(),
                        data = {};

                    namelist=[];
                    satlist=[];
                    switch (s1) {
                        case location:
                            data = {
                                user_location : s1.val(),
                                user_project: s2.val()
                            };
                            break;
                        case project:
                            data = {
                                user_location : s2.val(),
                                user_project: s1.val()
                            }
                    }


                    $.ajax({
                        url: "http://msl-crm.cms.incker.com/api/getSurveyInfo",
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
                            data=res.list;
                            page_arr=data;

                            console.log(data)
                            for (var i=0;i<res.pieList.length;i++) {
                                namelist.push(res.pieList[i]["name"]);
                            }
                            if (data) {
                                for (var i=0;i<data.length;i++){

                                    var name = data[i]['user_name']==null?'未匹配':data[i]['user_name'],
                                        location=data[i]['user_location']==null?'未匹配':data[i]['user_location'],
                                        project=data[i]['user_project']==null?'未匹配':data[i]['user_project'],
                                        email=data[i]['user_email']==null?'未匹配':data[i]['user_email'],
                                        company=data[i]['user_company']==null?'未匹配':data[i]['user_company'];

                                    datatable.append('<tr id="booking_'+(i+1)+'"><td>'+
                                        data[i]['id']
                                        +'</td><td title='+name+'>'+
                                        name
                                        +'</td><td title='+location+'>'+
                                        location
                                        +'</td><td title='+project+'>'+
                                        project
                                        +'</td><td title='+email+'>'+
                                        email
                                        +'</td><td title='+company+'>'+
                                        company
                                        +'</td><td title="'+data[i]["user_sat"]+'" data-id="'+data[i]["user_id"] +'">'+
                                        data[i]['user_sat']
                                        +'</td><td title='+data[i]["fdate"]+'>'+
                                        data[i]['fdate']
                                        +'</td></tr>')
                                }
                            }

                            // 更新图表
                            var myChart = echarts.init(document.getElementById('main'));
                            myChart.setOption({
                                legend:[{
                                    data: namelist
                                }],
                                series: [{
                                    data: res.pieList
                                }]
                            });

                        },
                        error: function () {
                            //that.postLock = true;
                        }
                    });
                })
            }
            change(location,project);
            change(project,location);

            // $('#infoPage').on('click','span',function () {
            //     var z= $('#infoPage span').index($(this))
            //
            //     namelist=[];
            //     satlist=[];
            //     datatable.empty();
            //     $(this).addClass('current').siblings().removeClass('current');
            //
            //     for (var i=0;i<page_arr[z].length;i++){
            //         namelist.push(page_arr[z][i]["user_name"]);
            //         satlist.push(page_arr[z][i]["user_sat"]);
            //
            //         var name =  page_arr[z][i]['user_name']==null?'未匹配': page_arr[z][i]['user_name'],
            //             location= page_arr[z][i]['user_location']==null?'未匹配': page_arr[z][i]['user_location'],
            //             project= page_arr[z][i]['user_project']==null?'未匹配': page_arr[z][i]['user_project'],
            //             email= page_arr[z][i]['user_email']==null?'未匹配': page_arr[z][i]['user_email'],
            //             company= page_arr[z][i]['user_company']==null?'未匹配': page_arr[z][i]['user_company'];
            //
            //         datatable.append('<tr id="booking_'+(i+1)+'"><td>'+
            //             page_arr[z][i]['id']
            //             +'</td><td title="'+name+'">'+
            //             name
            //             +'</td><td title="'+location+'">'+
            //             location
            //             +'</td><td title="'+project+'">'+
            //             project
            //             +'</td><td title="'+email+'">'+
            //             email
            //             +'</td><td title="'+company+'">'+
            //             company
            //             +'</td><td title="'+page_arr[z][i]['user_sat']+'">'+
            //             page_arr[z][i]['user_sat']
            //             +'</td><td title="'+page_arr[z][i]['fdate']+'">'+
            //             page_arr[z][i]['fdate']
            //             +'</td></tr>')
            //     }
            //
            //     // 更新图表
            //     var myChart = echarts.init(document.getElementById('main'));
            //     myChart.setOption({
            //         xAxis:[{
            //             data: namelist
            //         }],
            //         series: [{
            //             data: satlist
            //         }]
            //     });
            // })

            $('.sat_order').click(function () {
                var  sat_order='',
                    location = $('#locationList').val(),
                    project =$('#projectList').val();

                // namelist=[];
                // satlist=[];
                datatable.empty();

                if ($(this).hasClass('desc')){
                    sat_order = 'desc'
                    $(this).removeClass('desc')
                    $(this).addClass('asc')
                }else {
                    sat_order = 'asc'
                    $(this).removeClass('asc')
                    $(this).addClass('desc')
                }

                console.log(sat_order)

                $.ajax({
                    url: "http://msl-crm.cms.incker.com/api/getSurveyInfo",
                    type: 'post',
                    data:{
                        user_location :location,
                        user_project:  project,
                        sat_order: sat_order
                    },
                    success: function (res) {
                        console.log('cccc',res)
                        datatable.empty();
                       // $('#infoPage').empty();

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
                          //  $('#infoPage').append('<span class>'+(i+1)+'</span>')
                        }
                        data=res.list;
                        page_arr=data;

                        console.log(data)
                        for (var i=0;i<data.length;i++){

                            // namelist.push(data[0][i]["user_name"]);
                            // satlist.push(data[0][i]["user_sat"]);
                            var name = data[i]['user_name']==null?'未匹配':data[i]['user_name'],
                                location=data[i]['user_location']==null?'未匹配':data[i]['user_location'],
                                project=data[i]['user_project']==null?'未匹配':data[i]['user_project'],
                                email=data[i]['user_email']==null?'未匹配':data[i]['user_email'],
                                company=data[i]['user_company']==null?'未匹配':data[i]['user_company'];

                            datatable.append('<tr id="booking_'+(i+1)+'"><td>'+
                                data[i]['id']
                                +'</td><td title='+name+'>'+
                                name
                                +'</td><td title='+location+'>'+
                                location
                                +'</td><td title='+project+'>'+
                                project
                                +'</td><td title='+email+'>'+
                                email
                                +'</td><td title='+company+'>'+
                                company
                                +'</td><td title="'+data[i]["user_sat"]+'" data-id="'+data[i]["user_id"] +'">'+
                                data[i]['user_sat']
                                +'</td><td title='+data[i]["fdate"]+'>'+
                                data[i]['fdate']
                                +'</td></tr>')
                        }

                        // 更新图表
                        // var myChart = echarts.init(document.getElementById('main'));
                        // myChart.setOption({
                        //     xAxis:[{
                        //         data: namelist
                        //     }],
                        //     series: [{
                        //         data: satlist
                        //     }]
                        // });

                    },
                    error: function () {
                        //that.postLock = true;
                    }
                });
            })

            var pop=$('.msl-popbox'),
                tab1=$('#table1'),
                td=tab1.find('td'),
                tbody=$('#table2').find('tbody'),
                datatable = $('.panel-body tbody');

            //打开弹层
            datatable.on('click','td',function () {
                var user_id = $(this).attr("data-id")
                if (user_id) {
                    td.html('');
                    $('.projectList').hide();
                    tbody.empty();

                    console.log(user_id)
                    $.ajax({
                        url: "http://msl-crm.cms.incker.com/api/getUserSurveyDetails",
                        type: 'post',
                        data: {"user_id":user_id},
                        success: function (res) {
                            console.log(res)
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

                                tbody.append('<tr><td>Q'+(i+1)+'</td><td title="'+mark+'">'+ mark+ '</td><td class="comt" title="'+comment+'">'+comment+'</td></tr>')
                            }
                        },
                        error: function () {
                            //that.postLock = true;
                        }
                    });

                    $('.user-cont').show();
                    pop.fadeIn(200)
                }
            });

            //关闭弹层
            $('.close').click(function () {
                pop.fadeOut(200);
            })

        })

        $('#excelOut').click(function () {
            $("#export2").table2excel({            //exceltable为存放数据的table
                // 不被导出的表格行的CSS class类
                exclude: ".noExl",
                // 导出的Excel文档的名称
                name: "表格-" + new Date().getTime(),
                // Excel文件的名称
                filename: "表格-" + new Date().getTime(),
                bootstrap: false
            })
        })

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





</body>
</html>