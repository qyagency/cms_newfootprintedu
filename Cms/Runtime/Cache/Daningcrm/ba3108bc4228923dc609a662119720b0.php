<?php if (!defined('THINK_PATH')) exit();?>
<!-- saved from url=(0075)https://www.17sucai.com/preview/1/2017-05-05/jQueryQuestionnaire/index.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>后台上移下移，编辑，删除效果</title>
    <link rel="stylesheet" type="text/css" href="/Public/Uploads/css/wenjuan_ht.css">
    <script src="/Public/Uploads/css/jquery.min.js"></script>
    <script src="/Public/Uploads/css/index.js?v=11111"></script>
</head>

<body>
<div class=" all_660">
    <div class="html-box">
        <div class="wj_name">
            <span class="lab">问卷标题</span>
            <input type="text" class="input_wenbk">
        </div>
        <div class="wj_title">
            <span class="lab">标题缩写</span>
            <input type="text" class="input_wenbk">
        </div>
        <div class="wj_summary">
            <span class="lab">问卷描述</span>
            <textarea class="input_wenbk btwen_text btwen_text_duox"></textarea>
        </div>
        <div class="wj_sort">
            <span class="lab">问卷排序</span>
            <input type="number" class="input_wenbk">
        </div>
        <div class="wj_type">
            <span class="lab">问卷类型</span>
            <select>
                <option value="1">社区调研</option>
                <!--<option value="2">拥抱健康</option>-->
            </select>
        </div>
        <!--<div class="wj_type">-->
        <!--<span class="lab">问卷类型</span>-->
        <!--<select class="addquerstions" name="">-->
        <!--<option value="0">普通类型</option>-->
        <!--<option value="1">多模块类型</option>-->
        <!--&lt;!&ndash;<option value="3">矩阵</option>&ndash;&gt;-->
        <!--</select>-->
        <!--</div>-->
        <div class="main"></div>
        <!--<div class="yd_box"></div>-->
    </div>

    <div class="but" style="padding-top: 40px;text-align: center">
        <!--<select id="addquerstions" class="addquerstions" name="">-->
        <!--<option value="-1">添加问题</option>-->
        <!--<option value="0">单选</option>-->
        <!--<option value="1">多选</option>-->
        <!--<option value="2">填空</option>-->
        <!--&lt;!&ndash;<option value="3">矩阵</option>&ndash;&gt;-->
        <!--</select>-->
        <div class="add_section">添加大类</div>
        <div class="button">保 存</div>
    </div>
    <!--选项卡区域  模板区域---------------------------------------------------------------------------------------------------------------------------------------->
    <div class="xxk_box">
        <div class="xxk_conn hide">
            <!--单选----------------------------------------------------------------------------------------------------------------------------------------->
            <div class="xxk_xzqh_box dxuan ">
                <textarea name="" cols="" rows="" class="input_wenbk btwen_text btwen_text_dx" placeholder="单选题目"></textarea>
                <div class="title_itram">
                    <div class="kzjxx_iteam">
                        <input name="" type="radio" value="" class="dxk">
                        <input name="" type="text" class="input_wenbk" value="" placeholder="选项">
                        <!--<label>-->
                        <!--<input name="" type="checkbox" value="" class="fxk"> <span>可填空</span>-->
                        <!--</label> -->
                        <a href="javascript:void(0);" class="del_xm">删除</a>
                    </div>
                </div>
                <a href="javascript:void(0)" class="zjxx">增加选项</a>
                <!--完成编辑-->
                <div class="bjqxwc_box">
                    <a href="javascript:void(0);" class="qxbj_but">取消编辑</a>
                    <a href="javascript:void(0);" class="swcbj_but"> 完成编辑</a>
                </div>
            </div>
            <!--多选----------------------------------------------------------------------------------------------------------------------------------------->
            <div class="xxk_xzqh_box duoxuan hide">
                <textarea name="" cols="" rows="" class="input_wenbk btwen_text btwen_text_duox" placeholder="多选题目"></textarea>
                <div class="title_itram">
                    <div class="kzjxx_iteam">
                        <input name="" type="checkbox" value="" class="dxk">
                        <input name="" type="text" class="input_wenbk" value="选项" placeholder="选项">
                        <!--<label>-->
                        <!--<input name="" type="checkbox" value="" class="fxk"> <span>可填空</span>-->
                        <!--</label>-->
                        <a href="javascript:void(0);" class="del_xm">删除</a>
                    </div>
                </div>
                <a href="javascript:void(0)" class="zjxx">增加选项</a>
                <!--完成编辑-->
                <div class="bjqxwc_box">
                    <a href="javascript:void(0);" class="qxbj_but">取消编辑</a>
                    <a href="javascript:void(0);" class="swcbj_but"> 完成编辑</a>
                </div>
            </div>
            <!-- 填空----------------------------------------------------------------------------------------------------------------------------------------->
            <div class="xxk_xzqh_box tktm hide">
                <textarea name="" cols="" rows="" class="input_wenbk btwen_text btwen_text_tk" placeholder="答题区"></textarea>
                <!--完成编辑-->
                <div class="bjqxwc_box">
                    <a href="javascript:void(0);" class="qxbj_but">取消编辑</a>
                    <a href="javascript:void(0);" class="swcbj_but"> 完成编辑</a>
                </div>
            </div>
            <!-- 矩阵----------------------------------------------------------------------------------------------------------------------------------------->
            <div class="xxk_xzqh_box  hide">
                <div class="line_dl"></div>
                <div class="jztm">
                    <textarea name="" cols="" rows="" class="input_wenbk btwen_text" placeholder="题目"></textarea>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr valign="top">
                            <td width="135">
                                <h4 class="ritwenz_xx">左标题</h4>
                                <textarea name="" cols="" rows="" class="leftbtwen_text" placeholder="例子：CCTV1，CCTV2，CCTV3"></textarea>
                            </td>
                            <td>
                                <h4 class="ritwenz_xx  ">
                                    右侧选项文字 <input type="radio" name="xz" value="0" checked="checked" class="xzqk">单选<input type="radio" value="1" name="xz" class="xzqk">多选
                                </h4>
                                <div class="title_itram">
                                    <div class="kzjxx_iteam">
                                        <input name="" type="text" class="input_wenbk jzwent_input" value="选项" onblur="if(!this.value)this.value=&#39;选项&#39;" onclick="if(this.value&amp;&amp;this.value==&#39;选项&#39; )  this.value=&#39;&#39;">
                                        <label>
                                            <input name="" type="checkbox" value="" class="fxk"> <span>可填空</span></label> <a href="javascript:void(0);" class="del_xm">删除</a>
                                    </div>
                                    <div class="kzjxx_iteam">
                                        <input name="" type="text" class="input_wenbk jzwent_input" value="选项" onblur="if(!this.value)this.value=&#39;选项&#39;" onclick="if(this.value&amp;&amp;this.value==&#39;选项&#39; )  this.value=&#39;&#39;">
                                        <label>
                                            <input name="" type="checkbox" value="" class="fxk"> <span>可填空</span></label> <a href="javascript:void(0);" class="del_xm">删除</a>
                                    </div>
                                    <div class="kzjxx_iteam">
                                        <input name="" type="text" class="input_wenbk jzwent_input" value="选项" onblur="if(!this.value)this.value=&#39;选项&#39;" onclick="if(this.value&amp;&amp;this.value==&#39;选项&#39; )  this.value=&#39;&#39;">
                                        <label>
                                            <input name="" type="checkbox" value="" class="fxk"> <span>可填空</span></label> <a href="javascript:void(0);" class="del_xm">删除</a>
                                    </div>
                                </div> <a href="javascript:void(0)" class="zjxx" style="margin-left: 0;">增加选项</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <!--完成编辑-->
                    <div class="bjqxwc_box">
                        <a href="javascript:void(0);" class="qxbj_but">取消编辑</a> <a href="javascript:void(0);" class="swcbj_but"> 完成编辑</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    JJL_VO = [<?php echo ($vo); ?>];
    console.log(JJL_VO);
</script>

</body></html>