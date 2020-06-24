<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="fixed">
<head>
    <meta charset="UTF-8">
    <title>
        问卷结果统计 - 列表 | HAPPY-SHARE Admin - Responsive HTML5 CMS
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
        .list_pop{
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            top: 0;
            left: 0;
            z-index: 9999;
            display: none;
        }
        .list_pop .table,.user-cont{
            position: relative;
            margin: 0 auto;
            width: 870px;
            top: 50%;
            transform: translateY(-50%);
            background: #fff;
            border: 1px solid #ddd;
            z-index: 1;
        }
        .list_pop tr{
            height: 34px;
        }
        .list_pop th{
            text-align: center;

        }
        .list_pop th:nth-child(1){
            width: 60px;
        }
        .list_pop th:nth-child(2){
            width: 90px;
        }
        .list_pop th:nth-child(3),
        .list_pop th:nth-child(4){
            width: 120px;
        }

        .list_pop th:nth-child(5){
            padding: 0 10px;
            width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .list_pop th:nth-child(6){
            width: 90px;
            cursor: pointer;
        }
        .list_pop th:nth-child(7){
            width: 90px;
            color: #225ab5;
            cursor: pointer;
        }
        thead{
            background: #edebeb;
            border-bottom: 1px solid #ddd;
        }
        .box{
            height: 600px;
            overflow: hidden;
            overflow-y: auto;
        }
        .box th{
            font-weight: 400;
            cursor: default;
        }
        /*.box th:nth-child(5){*/
            /*color: #225ab5;*/
            /*cursor: pointer;*/
        /*}*/
        .box tr:nth-child(2n){
            background: #edebeb;
        }
        .box tr:nth-child(2n+1){
            background: #fff;
        }
        .close{
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        #point_data {
            color: #225ab5;
        }
        #point_data td{
            position: relative;
            text-align: center;
            cursor: pointer;
        }
        #point_data td:after{
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
        #point_data td:hover:after{
            display: block;
        }
        #point_data td:last-child:hover:after{
            display: none;
        }
        #main{
            margin-top: 60px;
        }
        .screen{
            position: absolute;
            padding: 0 4px;
            height: 34px;
            z-index: 1;
        }
        .screen .item{
            float: left;
            height: 100%;
            margin-right: 20px;
        }
        .screen .item .lab{
            font-size: 18px;
            font-weight: bold;
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
        .user-cont{
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
        .user-cont .tables{
            border: 1px solid #0088cc;
        }
        .user-cont table{
            width: 100%;
            text-align: center;
            color: #fff;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .user-cont tr,
        .user-cont td,
        .user-cont th{
            text-align: center;
            height: 34px;
            border: 1px solid #fff;
        }
        .user-cont #table1{
            background: #0088cc;
        }
        .user-cont thead{
            background: #606266;
        }
        .user-cont .width1{
            width: 180px;
        }
        .user-cont #table2 tbody{
            color: #4a4a4a;
        }
        .user-cont #table2 tbody tr:nth-child(2n+1){
            background: #ddebf7;
        }
        .user-cont #table2 tbody tr:nth-child(2n){
            background: #bdd7ee;
        }
        .user-cont #table2 tbody tr td{
            padding: 0 10px;
        }
        .user-cont #table2 tr th:nth-child(3){
            width: auto;
        }
        .user-cont #table2 tbody tr td:last-child{
            text-align: left;
            overflow:hidden;
            text-overflow:ellipsis;
            white-space:nowrap
        }
    </style>
    <script type="text/javascript" src="/Public/vendor/echarts/echarts.js"></script>

    <!--<label><input name="DataRange" type="radio"  value="all" checked = "true" onchange="changeStatus(this.value)"/>全部数据 &nbsp&nbsp&nbsp&nbsp</label>-->
    <!--<label><input name="DataRange" type="radio" value="part" onchange="changeStatus(this.value)"/>区间数据 &nbsp&nbsp&nbsp&nbsp</label>-->
    <!--<select name="DateStart" id="DateStart" class="DateSelect"  >-->
        <!--<option value="2019-08-01">2019-08 &nbsp&nbsp&nbsp&nbsp </option>-->
        <!--<option value="2019-09-01">2019-09  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2019-10-01">2019-10  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2019-11-01">2019-11  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2019-12-01">2019-12  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2020-01-01">2020-01  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2020-02-01">2020-02  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2020-03-01">2020-03  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2020-04-01">2020-04  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2020-05-01">2020-05  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2020-06-01">2020-06  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2020-07-01">2020-07  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2020-08-01">2020-08  &nbsp&nbsp&nbsp&nbsp</option>-->
    <!--</select>-->
    <!--<label id = "DateText" class="DateSelect" > &nbsp&nbsp至&nbsp&nbsp</label>-->
    <!--<select name= "DateEnd" id="DateEnd" class="DateSelect">-->
        <!--<option value="2019-09">2019-08 &nbsp&nbsp&nbsp&nbsp </option>-->
        <!--<option value="2019-10">2019-09  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2019-11">2019-10  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2019-12">2019-11  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2020-01">2019-12  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2020-02">2020-01  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2020-03">2020-02  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2020-04">2020-03  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2020-05">2020-04  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2020-06">2020-05  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2020-07">2020-06  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2020-08">2020-07  &nbsp&nbsp&nbsp&nbsp</option>-->
        <!--<option value="2020-09">2020-08  &nbsp&nbsp&nbsp&nbsp</option>-->
    <!--</select>-->
    <!--<button id="btnSubmit" type = "submit " onclick="submit()" class="DateSelect">确定</button>-->

    <div class="screen">
        <div class="item">
            <div class="lab">项目名称：</div>
            <select>
                <option>全部</option>
            </select>
        </div>
        <div class="item">
            <div class="lab">地区：</div>
            <select>
                <option>全部</option>
            </select>
        </div>
    </div>
    <!-- 为ECharts准备一个具备大小（宽高）的DOM -->
    <div id="main" style="width: 100%; height: 500px;"  ></div>
    <section class="panel">
        <div class="panel-body">
            <table  class="table table-bordered table-condensed mb-none">
                <thead>
                <tr>
                    <th>Q1</th>
                    <th>Q2</th>
                    <th>Q3</th>
                    <th>Q4</th>
                    <th>Q5</th>
                    <th>Q6</th>
                    <th>Q7</th>
                    <th>Q8</th>
                    <th>Q9</th>
                    <th>Q10</th>
                    <th>Q11</th>
                    <th>Q12</th>
                    <th>Q13</th>
                    <th>Q14</th>
                    <th>Q15</th>
                    <th>Q16</th>
                    <th>Q17</th>
                    <th>Q18</th>
                    <th>总分</th>
                </tr>
                </thead>
                <tbody>
                    <tr id="point_data">
                        <td id = point_data1><?php echo ($list["s1"]); ?></td>
                        <td id = point_data2><?php echo ($list["s2"]); ?></td>
                        <td id = point_data3><?php echo ($list["s3"]); ?></td>
                        <td id = point_data4><?php echo ($list["s4"]); ?></td>
                        <td id = point_data5><?php echo ($list["s5"]); ?></td>
                        <td id = point_data6><?php echo ($list["s6"]); ?></td>
                        <td id = point_data7><?php echo ($list["s7"]); ?></td>
                        <td id = point_data8><?php echo ($list["s8"]); ?></td>
                        <td id = point_data9><?php echo ($list["s9"]); ?></td>
                        <td id = point_data10><?php echo ($list["s10"]); ?></td>
                        <td id = point_data11><?php echo ($list["s11"]); ?></td>
                        <td id = point_data12><?php echo ($list["s12"]); ?></td>
                        <td id = point_data13><?php echo ($list["s13"]); ?></td>
                        <td id = point_data14><?php echo ($list["s14"]); ?></td>
                        <td id = point_data15><?php echo ($list["s15"]); ?></td>
                        <td id = point_data16><?php echo ($list["s16"]); ?></td>
                        <td id = point_data17><?php echo ($list["s17"]); ?></td>
                        <td id = point_data18><?php echo ($list["s18"]); ?></td>
                        <td id = point_datall></td>
                    </tr>
                </tbody>

            </table>
        </div>
    </section>
    <div class="list_pop">
        <div class="table">
           <table class="table1">
               <thead>
               <tr>
                   <th>序号</th>
                   <th>客户姓名</th>
                   <th>项目名称</th>
                   <th>邮箱</th>
                   <th>所属公司</th>
                   <th>分数</th>
                   <th>操作</th>
               </tr>
               </thead>
           </table>
           <div class="box">
               <table class="table2">
                   <tbody></tbody>
               </table>
           </div>
       </div>
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
        <div class="close"></div>
    </div>


    <script type="text/javascript">
        $(function () {
            /*基于准备好的dom，初始化echarts实例*/
            var myChart = echarts.init(document.getElementById('main'));

            option = {
                title: {
                    text: '问卷结果统计',
                    subtext: '邮件问卷调查'
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },
                legend: {
                    name:'平均分值',
                    data: ['平均分值']
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: {
                    //name:'总体平均分值',
                    type: 'value',
                    max:5

                },
                yAxis: {
                    type: 'category',
                    data: ['Q1','Q2','Q3','Q4','Q5','Q6','Q7','Q8','Q9','Q10','Q11','Q12','Q13','Q14','Q15','Q16','Q17','Q18']
                },
                series: [
                    {
                        name: '平均分值',
                        type: 'bar',
                        color:'#38a9ae',
                        data:[5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5]
                    }
                ]
            };

            $.ajax({
                url: "http://msl-crm.cms.incker.com/api/getSurveyAve",
                type: 'post',
                success: function (res) {
                    console.log(res)
                    var sum = 0;
                    for (var i=0;i<res.length;i++){
                        sum +=res[i]
                    }

                    document.getElementById("point_datall").innerText = (sum/18).toFixed(1);
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
            $.ajax({
                url: "http://msl-crm.cms.incker.com/api/getDropDownInfo2",
                type: 'post',
                success: function (res) {
                    console.log(res)
                    for(var i=0;i<res.projectList.length;i++){
                        $($('.screen select')[0]).append('<option>'+ res.projectList[i] +'</option>')
                    }
                    for(var i=0;i<res.locationList.length;i++){
                        $($('.screen select')[1]).append('<option>'+ res.locationList[i] +'</option>')
                    }
                },
                error: function () {
                    //that.postLock = true;
                }
            });


            // 使用刚指定的配置项和数据显示图表
            myChart.setOption(option);
        })

        function changeStatus(data) {
            // alert("a");
            if (data == "part") {
                document.getElementById("DateStart").style.display = "inline";
                document.getElementById("DateText").className = "DateSelect2";
                document.getElementById("DateEnd").style.display = "inline";
                document.getElementById("btnSubmit").className = "DateSelect2";
                //     console.log(document.getElementById("btnSubmit"));
            }else{
                document.getElementById("DateStart").style.display = "none";
                document.getElementById("DateText").className = "DateSelect";
                document.getElementById("DateEnd").style.display = "none";
                document.getElementById("btnSubmit").className = "DateSelect";

                $.ajax({
                    url: "http://msl-crm.cms.incker.com/api/getSurveyAve",
                    type: 'post',
                    success: function (res) {

                        //更新表格
                        document.getElementById("point_data1").innerText = res[0];
                        document.getElementById("point_data2").innerText = res[1];
                        document.getElementById("point_data3").innerText = res[2];
                        document.getElementById("point_data4").innerText = res[3];
                        document.getElementById("point_data5").innerText = res[4];
                        document.getElementById("point_data6").innerText = res[5];
                        document.getElementById("point_data7").innerText = res[6];
                        document.getElementById("point_data8").innerText = res[7];
                        document.getElementById("point_data9").innerText = res[8];
                        document.getElementById("point_data10").innerText = res[9];
                        document.getElementById("point_data11").innerText = res[10];
                        document.getElementById("point_data12").innerText = res[11];
                        document.getElementById("point_data13").innerText = res[12];
                        document.getElementById("point_data14").innerText = res[13];
                        document.getElementById("point_data15").innerText = res[14];
                        document.getElementById("point_data16").innerText = res[15];
                        document.getElementById("point_data17").innerText = res[16];
                        document.getElementById("point_data18").innerText = res[17];

                        // 更新图表
                        var myChart = echarts.init(document.getElementById('main'));
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


            }
        }

        function submit() {
            var DateStart = document.getElementById("DateStart").value;
            var DateEnd = document.getElementById("DateEnd").value;
            $.ajax({
                url: "http://msl-crm.cms.incker.com/api/getSurveyAveByDate",
                type: 'post',
                data:{"DateStart":DateStart,"DateEnd":DateEnd},
                success: function (res) {

                    //更新表格
                    document.getElementById("point_data1").innerText = res[0];
                    document.getElementById("point_data2").innerText = res[1];
                    document.getElementById("point_data3").innerText = res[2];
                    document.getElementById("point_data4").innerText = res[3];
                    document.getElementById("point_data5").innerText = res[4];
                    document.getElementById("point_data6").innerText = res[5];
                    document.getElementById("point_data7").innerText = res[6];
                    document.getElementById("point_data8").innerText = res[7];
                    document.getElementById("point_data9").innerText = res[8];
                    document.getElementById("point_data10").innerText = res[9];
                    document.getElementById("point_data11").innerText = res[10];
                    document.getElementById("point_data12").innerText = res[11];
                    document.getElementById("point_data13").innerText = res[12];
                    document.getElementById("point_data14").innerText = res[13];
                    document.getElementById("point_data15").innerText = res[14];
                    document.getElementById("point_data16").innerText = res[15];
                    document.getElementById("point_data17").innerText = res[16];
                    document.getElementById("point_data18").innerText = res[17];

                    // 更新图表
                    var myChart = echarts.init(document.getElementById('main'));
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
        }

        var userproject,userlocation;
        function showpop() {
            var td = $('#point_data td'),
                pop=$('.list_pop'),
                table =$('.table2 tbody'),
                usertab = $('.user-cont'),
                lookup = $(table).find('tr'),
                looktbody = $('#table2 tbody'),
                tab1=$('#table1'),
                looktd=tab1.find('td'),
                data='';


            td.click(function () {
                var n=$(this).text(),
                    i = td.index($(this));

                console.log(userproject)
                $('.close').addClass('close1')

                if (i<18){
                    console.log(n)
                    pop.fadeIn(300)
                    $.ajax({
                        url: "http://msl-crm.cms.incker.com/api/getUserSurveyDetailsUnderThree",
                        type: 'post',
                        data: {
                            score_number:i,
                            user_project: userproject,
                            user_location:userlocation
                        },
                        success: function (res) {
                            var list = res.list;
                            data = list;
                            console.log(res)
                            if (res.code==200){
                                var number = i +1;
                                for (var j=0;j<list.length;j++) {
                                    table.append('<tr><th>'+
                                        (j+1)
                                        +'</th><th>'+
                                        list[j]['user_name']
                                        +'</th><th>'+
                                            list[j]['user_project']
                                        +'</th><th>'+
                                        list[j]['user_email']
                                        +'</th><th>'+
                                        list[j]['user_company']
                                        +'</th><th>'+
                                        list[j]['score_'+number]
                                        +'</th><th class="look">查看</th>'
                                    )
                                }
                            }

                            console.log(lookup.length)
                        }
                    })
                }

            });

            pop.on('click','.look',function () {
                var i = $(this).parent().index()
                console.log(data)

                for (var j=0;j<18;j++) {

                    var mark = 'remark_'+(j+1),
                        score = 'score_'+(j+1);

                    $(looktd[0]).html(data[i]['user_name']);
                    $(looktd[1]).html(data[i]['user_company']);

                    looktbody .append('<tr><td>Q'+(j+1)+'</td><td>'+data[i][score] + '</td><td class="comt">'+data[i][mark]+'</td></tr>')
                }

                $('.list_pop .table').fadeOut(0)
                usertab.fadeIn(0)
                $('.close').removeClass('close1').addClass('close2')
            })

            pop.on('click','.close1',function () {
                pop.fadeOut(0)
                table.empty()
                $(this).removeClass('close1');
            })
            pop.on('click','.close2',function () {
                $('.list_pop .table').fadeIn(0)
                usertab.fadeOut(0)
                $('.close').addClass('close1')
                looktbody .empty()
            })

        }showpop();

        // 筛选
        function select() {
            var select = $('.screen select');

            select.change(function (){
                var that = $(this),
                    sum=0,
                    datarray = [];

                userproject = $(select[0]).val();
                userlocation = $(select[1]).val()

                $.ajax({
                    url: " http://msl-crm.cms.incker.com/clientPoint/list",
                    type: 'post',
                    dataType:'json',
                    data: {
                        user_project:$(select[0]).val(),
                        user_location:$(select[1]).val()
                    },
                    success: function (res) {
                        //更新表格
                        console.log(res)
                        for (var i=0;i<18;i++){
                            datarray.push(res['s'+(i+1)]);
                            sum += datarray[i]
                            document.getElementById("point_data"+(i+1)).innerText = res['s'+(i+1)];
                        }
                        document.getElementById("point_datall").innerText = (sum/18).toFixed(1);
                        // document.getElementById("point_data1").innerText = res[0];
                        // document.getElementById("point_data2").innerText = res[1];
                        // document.getElementById("point_data3").innerText = res[2];
                        // document.getElementById("point_data4").innerText = res[3];
                        // document.getElementById("point_data5").innerText = res[4];
                        // document.getElementById("point_data6").innerText = res[5];
                        // document.getElementById("point_data7").innerText = res[6];
                        // document.getElementById("point_data8").innerText = res[7];
                        // document.getElementById("point_data9").innerText = res[8];
                        // document.getElementById("point_data10").innerText = res[9];
                        // document.getElementById("point_data11").innerText = res[10];
                        // document.getElementById("point_data12").innerText = res[11];
                        // document.getElementById("point_data13").innerText = res[12];
                        // document.getElementById("point_data14").innerText = res[13];
                        // document.getElementById("point_data15").innerText = res[14];
                        // document.getElementById("point_data16").innerText = res[15];
                        // document.getElementById("point_data17").innerText = res[16];
                        // document.getElementById("point_data18").innerText = res[17];

                        // 更新图表
                        var myChart = echarts.init(document.getElementById('main'));
                        myChart.setOption({
                            series: [{
                                data: datarray
                            }]
                        });
                    },
                    error: function () {
                        //that.postLock = true;
                    }
                })
            })
        }select();

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