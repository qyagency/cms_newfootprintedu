<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="fixed">
<head>
    <meta charset="UTF-8">
    <title>
        比赛信息 - 编辑 | HAPPY-SHARE Admin - Responsive HTML5 CMS
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
</head>
<body>
<section class="body">

    <!-- start: header -->
    <header class="header">
    <div class="logo-container">
        <a href="../" class="logo">
            <!--<img src="/Public/chellon/image/common/logo.jpg" height="35" alt="壳隆官网 | 管理后台" />-->
            Nike男篮竞猜后台系统
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
            
    <form class="ajaxForm form-horizontal form-bordered" method="post" novalidate="novalidate">
    <section class="panel">
        <div class="panel-body">
            <div class="form-group">   <label class="col-md-2 control-label">竞猜id:<span class="required">*</span></label>   <div class="col-md-8">       <select data-plugin-selectTwo class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Question_id" required  >               <option value="">请选择</option>           <?php if(is_array($vo["QuestionIdList"])): $i = 0; $__LIST__ = $vo["QuestionIdList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vos["key"]); ?>" <?php echo ($vos["readonly"]); ?> <?php if(($vos["key"]) == $vo["question_id"]): ?>selected<?php endif; ?>><?php echo ($vos["label"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>       </select>   </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">比赛标题:<span class="required">*</span></label>   <div class="col-md-8">       <input  placeholder="比赛标题:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Match_title" value="<?php echo ($vo["match_title"]); ?>" required>      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">比赛日期:<span class="required">*</span></label>   <div class="col-md-8">       <input  placeholder="比赛日期:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Match_date" value="<?php echo ($vo["match_date"]); ?>" required>      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">比赛时间:<span class="required">*</span></label>   <div class="col-md-8">       <input  placeholder="比赛时间:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Match_time" value="<?php echo ($vo["match_time"]); ?>" required>      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">比赛队伍A:<span class="required">*</span></label>   <div class="col-md-8">       <select data-plugin-selectTwo class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Match_team_a" required  >               <option value="">请选择</option>           <?php if(is_array($vo["TeamList"])): $i = 0; $__LIST__ = $vo["TeamList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vos["key"]); ?>" <?php echo ($vos["readonly"]); ?> <?php if(($vos["key"]) == $vo["match_team_a"]): ?>selected<?php endif; ?>><?php echo ($vos["label"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>       </select>   </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">比赛队伍B:<span class="required">*</span></label>   <div class="col-md-8">       <select data-plugin-selectTwo class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Match_team_b" required  >               <option value="">请选择</option>           <?php if(is_array($vo["TeamList"])): $i = 0; $__LIST__ = $vo["TeamList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vos["key"]); ?>" <?php echo ($vos["readonly"]); ?> <?php if(($vos["key"]) == $vo["match_team_b"]): ?>selected<?php endif; ?>><?php echo ($vos["label"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>       </select>   </div></div>

            <div class="form-group">   <label class="col-md-2 control-label">问题一:<span class="required">*</span></label>   <div class="col-md-8">       <input  placeholder="问题一:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q1_title" value="<?php echo ($vo["q1_title"]); ?>" required>      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题一答案:</label>   <div class="col-md-8">       <input  placeholder="问题一答案:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q1_answer" value="<?php echo ($vo["q1_answer"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题一选项A:<span class="required">*</span></label>   <div class="col-md-8">       <input  placeholder="问题一选项A:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q1_A" value="<?php echo ($vo["q1_a"]); ?>" required>      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题一选项B:<span class="required">*</span></label>   <div class="col-md-8">       <input  placeholder="问题一选项B:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q1_B" value="<?php echo ($vo["q1_b"]); ?>" required>      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题一选项C:</label>   <div class="col-md-8">       <input  placeholder="问题一选项C:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q1_C" value="<?php echo ($vo["q1_c"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题一选项D:</label>   <div class="col-md-8">       <input  placeholder="问题一选项D:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q1_D" value="<?php echo ($vo["q1_d"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题一选项E:</label>   <div class="col-md-8">       <input  placeholder="问题一选项E:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q1_E" value="<?php echo ($vo["q1_e"]); ?>" >      </div></div>
            <br />

            <div class="form-group">   <label class="col-md-2 control-label">问题二:</label>   <div class="col-md-8">       <input  placeholder="问题二:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q2_title" value="<?php echo ($vo["q2_title"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题二答案:</label>   <div class="col-md-8">       <input  placeholder="问题二答案:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q2_answer" value="<?php echo ($vo["q2_answer"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题二选项A:</label>   <div class="col-md-8">       <input  placeholder="问题二选项A:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q2_A" value="<?php echo ($vo["q2_a"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题二选项B:</label>   <div class="col-md-8">       <input  placeholder="问题二选项B:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q2_B" value="<?php echo ($vo["q2_b"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题二选项C:</label>   <div class="col-md-8">       <input  placeholder="问题二选项C:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q2_C" value="<?php echo ($vo["q2_c"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题二选项D:</label>   <div class="col-md-8">       <input  placeholder="问题二选项D:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q2_D" value="<?php echo ($vo["q2_d"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题二选项E:</label>   <div class="col-md-8">       <input  placeholder="问题二选项E:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q2_E" value="<?php echo ($vo["q2_e"]); ?>" >      </div></div>
            <br />

            <div class="form-group">   <label class="col-md-2 control-label">问题三:</label>   <div class="col-md-8">       <input  placeholder="问题三:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q3_title" value="<?php echo ($vo["q3_title"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题三答案:</label>   <div class="col-md-8">       <input  placeholder="问题三答案:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q3_answer" value="<?php echo ($vo["q3_answer"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题三选项A:</label>   <div class="col-md-8">       <input  placeholder="问题三选项A:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q3_A" value="<?php echo ($vo["q3_a"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题三选项B:</label>   <div class="col-md-8">       <input  placeholder="问题三选项B:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q3_B" value="<?php echo ($vo["q3_b"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题三选项C:</label>   <div class="col-md-8">       <input  placeholder="问题三选项C:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q3_C" value="<?php echo ($vo["q3_c"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题三选项D:</label>   <div class="col-md-8">       <input  placeholder="问题三选项D:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q3_D" value="<?php echo ($vo["q3_d"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题三选项E:</label>   <div class="col-md-8">       <input  placeholder="问题三选项E:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q3_E" value="<?php echo ($vo["q3_e"]); ?>" >      </div></div>
            <br />

            <div class="form-group">   <label class="col-md-2 control-label">问题四:</label>   <div class="col-md-8">       <input  placeholder="问题四:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q4_title" value="<?php echo ($vo["q4_title"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题四答案:</label>   <div class="col-md-8">       <input  placeholder="问题四答案:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q4_answer" value="<?php echo ($vo["q4_answer"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题四选项A:</label>   <div class="col-md-8">       <input  placeholder="问题四选项A:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q4_A" value="<?php echo ($vo["q4_a"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题四选项B:</label>   <div class="col-md-8">       <input  placeholder="问题四选项B:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q4_B" value="<?php echo ($vo["q4_b"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题四选项C:</label>   <div class="col-md-8">       <input  placeholder="问题四选项C:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q4_C" value="<?php echo ($vo["q4_c"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题四选项D:</label>   <div class="col-md-8">       <input  placeholder="问题四选项D:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q4_D" value="<?php echo ($vo["q4_d"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题四选项E:</label>   <div class="col-md-8">       <input  placeholder="问题四选项E:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q4_E" value="<?php echo ($vo["q4_e"]); ?>" >      </div></div>
            <br />

            <div class="form-group">   <label class="col-md-2 control-label">问题五:</label>   <div class="col-md-8">       <input  placeholder="问题五:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q5_title" value="<?php echo ($vo["q5_title"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题五答案:</label>   <div class="col-md-8">       <input  placeholder="问题五答案:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q5_answer" value="<?php echo ($vo["q5_answer"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题五选项A:</label>   <div class="col-md-8">       <input  placeholder="问题五选项A:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q5_A" value="<?php echo ($vo["q5_a"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题五选项B:</label>   <div class="col-md-8">       <input  placeholder="问题五选项B:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q5_B" value="<?php echo ($vo["q5_b"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题五选项C:</label>   <div class="col-md-8">       <input  placeholder="问题五选项C:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q5_C" value="<?php echo ($vo["q5_c"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题五选项D:</label>   <div class="col-md-8">       <input  placeholder="问题五选项D:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q5_D" value="<?php echo ($vo["q5_d"]); ?>" >      </div></div>
            <div class="form-group">   <label class="col-md-2 control-label">问题五选项E:</label>   <div class="col-md-8">       <input  placeholder="问题五选项E:" type="text" class="form-control" name="<?php echo (CONTROLLER_NAME); ?>Q5_E" value="<?php echo ($vo["q5_e"]); ?>" >      </div></div>
            <br />


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