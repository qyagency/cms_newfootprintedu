<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="fixed">
<head>
    <meta charset="UTF-8">
    <title>
        资讯信息 - 列表 | HAPPY-SHARE Admin - Responsive HTML5 CMS
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

        table{

            table-layout:fixed;
        }
        .add{
            border-bottom: 10px solid #666666;
            /*下面4行是实现超过td文字变省略号,另外还要给table加上table-layout:fixed;*/
            text-overflow:ellipsis;
            -moz-text-overflow:ellipsis;
            overflow:hidden;
            white-space: nowrap;
        }

        #datatable thead th:first-child{
            width: 52px!important;
        }
        #datatable thead th:nth-child(8){
            width: 82px!important;
        }
        .newsLink{
            width: auto;
            margin-right: 0!important;
        }
        .newsLink{
            background-color:#43CD80;
            color:#ffffff;

        }
        .screen{
            position: absolute;
            height: 34px;
            z-index: 1;
        }
        .screen .item{
            float: left;
            height: 100%;
            margin-right: 10px;
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

        #keyword{
            width: 300px;
        }
        #infoPage span{
            color: #0088cc;
            cursor: pointer;
        }
        #infoPage span.no{
            color: #cccccc;
            cursor: no-drop;
        }
    </style>
    <section class="panel">
        <div class="panel-body">
            <div class="screen">
                <div class="item">
                    <div class="lab">资讯类型：</div>
                    <select id="projectList">
                        <option value="0">全部</option>
                        <option value="1">社区公告</option>
                        <option value="2">最新政策</option>
                        <option value="3">党建新闻</option>
                        <option value="4">热门回顾</option>
                        <option value="5">社区大事件</option>
                        <option value="6">社区活动</option>
                    </select>
                </div>
                <div class="item">
                    <!--<div class="lab">：</div>-->
                    <input placeholder="请输入关键字" id="keyword">
                </div>
            </div>
            <table id="datatable" class="table table-bordered table-condensed mb-none">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>资讯类型</th>
                    <th>资讯标题</th>
                    <th>资讯图片</th>
                    <th>资讯详情</th>
                    <th>资讯日期</th>
                    <th>资讯作者</th>
                    <th>资讯排序</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr id="NewsInfo_<?php echo ($k); ?>">
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo (translateNewsType($vo["news_type"])); ?></td>
                        <td class="add"><?php echo ($vo["news_title"]); ?></td>
                        <td><img id="news_img" height="50px" width="80px" src="<?php echo ($vo["news_head_img"]); ?>" class="pimg" alt="资讯图片" /></td>
                        <td class="add"><?php echo ($vo["news_details"]); ?></td>
                        <td><?php echo ($vo["news_date"]); ?></td>
                        <td class="add"><?php echo ($vo["news_auth"]); ?></td>
                        <td><?php echo ($vo["news_sort"]); ?></td>
                        <td>
                            <?php if(in_array(($cEdit), is_array($_SESSION['routes'])?$_SESSION['routes']:explode(',',$_SESSION['routes']))): ?><a href="<?php echo U('/NewsInfo/edit/id/'.$vo['id']);?>" class="btn btn-xs btn-primary ml-sm mr-sm"><i class="fa fa-pencil"></i> 编辑</a><?php endif; ?>
                            <?php if(in_array(($cDelete), is_array($_SESSION['routes'])?$_SESSION['routes']:explode(',',$_SESSION['routes']))): ?><a data-target="NewsInfo_<?php echo ($k); ?>" data-href="<?php echo U('/NewsInfo/delete/id/'.$vo['id']);?>"
                                   data-toggle="confirmation" class="btn btn-xs btn-primary"><i
                                        class="fa fa-trash-o"></i> 删除</a><?php endif; ?>
                            <a href="javascript:void(0)" id = "news_<?php echo ($vo['id']); ?>"  data-id="<?php echo ($vo['id']); ?>" class="newsLink btn btn-xs ml-sm mr-sm ">资讯链接</a>
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

    <script>
        setTimeout(function () {
            $('#datatable_paginate').hide()
        })
        $('.newsLink').click(function () {
            news_id =$(this).data("id");
            alert("pages/news/detail?id="+news_id)
        });


        var tbody = $('#datatable').find('tbody');

        var page_arr=[];

        $('#projectList,#keyword').change(function () {
            var sk = 0,ik = '';

            if ($(this).is('input')){
                ik = $(this).val();
                sk = $('#projectList').val()
            }else {
                sk = $(this).val();
                ik = $('#keyword').val()
            }

           $.ajax({
               url:'https://daning-crm.cms.incker.com/api/getNewsInfo',
               type:'post',
               data:{
                   'search_value':ik,
                   'news_type':sk
               },
               success:function (res) {
                   console.log(res)
                   $('#infoPage').empty()
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
                   append(0,data)
               }
           })
        })

        $('#infoPage').on('click','span',function () {
            var  i =$('#infoPage span').index($(this))
            if (!$(this).hasClass('no')) {
                append(i,page_arr)
            }

        })
        function append(e,data) {
            tbody.empty();

            if (data.length>0){

                for (var i=0;i<data[e].length;i++){

                    var type = '',
                        id = data[e][i].id,
                        title = data[e][i]['news_title'],
                        img = data[e][i]['news_img'],
                        details = data[e][i]['news_details'],
                        date = data[e][i]['news_date'],
                        auth = data[e][i]['news_auth'],
                        sort = data[e][i]['news_sort'];

                    switch (parseInt(data[e][i]['news_type'])) {
                        case 1:
                            type='社区公告'
                            break;
                        case 2:
                            type='最新政策'
                            break;
                        case 3:
                            type='党建新闻'
                            break;
                        case 4:
                            type='热门回顾'
                            break;
                        case 5:
                            type='社区大事件'
                            break;
                        case 6:
                            type='社区活动'
                            break;
                    }

                    tbody.append('<tr id="NewsInfo_'+id +'" role="row" class="even">\n' +
                        '                        <td class="">'+id+'</td>\n' +
                        '                        <td>'+type+'</td>\n' +
                        '                        <td class="add">'+title+'</td>\n' +
                        '                        <td><img id="news_img" height="50px" width="80px" src="'+img+'" class="pimg" alt="资讯图片"></td>\n' +
                        '                        <td class="add">'+ details+'</td>\n' +
                        '                        <td>'+date+'</td>\n' +
                        '                        <td class="add">'+auth+'</td>\n' +
                        '                        <td class="sorting_1">'+sort+'</td>\n' +
                        '                        <td>\n' +
                        '                            <a href="/NewsInfo/edit/id/' + id + '.html" class="btn btn-xs btn-primary ml-sm mr-sm"><i class="fa fa-pencil"></i> 编辑</a>                            <a data-target="NewsInfo_'+ id+'" data-href="/NewsInfo/delete/id/'+id+'.html" data-toggle="confirmation" class="btn btn-xs btn-primary" data-original-title="" title=""><i class="fa fa-trash-o"></i> 删除</a>                            <a href="javascript:void(0)" id="news_72" data-id="72" class="newsLink btn btn-xs ml-sm mr-sm ">资讯链接</a>\n' +
                        '                        </td>\n' +
                        '                    </tr>')

                }

                $('#infoPage span').eq(e).addClass('no').siblings().removeClass('no')

            }


        }

    </script>



</body>
</html>