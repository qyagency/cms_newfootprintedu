<?php
/**
 * Created by PhpStorm.
 * User: vtm2k7
 * Date: 16/4/12
 * Time: 上午10:38
 */

/**
 * 状态翻译
 * @param int 01
 * @param string $case
 * @return string HTML片段
 */
function translateSts($sts, $case = '') {
    $case = (empty($case)) ? CONTROLLER_NAME : $case;
    switch ($case) {
        case 'Product':
            $translation = array(
                0 => '-',
                1 => '新品'
            );
            break;
        case 'Region':
            $translation = array(
                0 => '-',
                1 => '热门'
            );
            break;
        case 'Brand':
            $translation = array(
                0 => '-',
                1 => '热门'
            );
            break;
    }
    return $translation[$sts];
}

function translateStatus($sts){
    switch($sts){
        case 0:
            $out = '未提交';
            break;
        case 1:
            $out = '待审核';
            break;
        case 2:
            $out = '审核通过';
            break;
        case 3:
            $out = '审核失败';
            break;
    }
    return $out;
}

function translateArea($sts){
    switch($sts){
        case 0:
            $out = '不需要';
            break;
        case 1:
            $out = '需要';
            break;
    }
    return $out;
}

function translateNewsType($sts){
    switch($sts){
        case 1:
            $out = '社区公告';
            break;
        case 2:
            $out = '最新政策';
            break;
        case 3:
            $out = '党建新闻';
            break;
        case 4:
            $out = '热门回顾';
            break;
        case 5:
            $out = '社区大事件';
            break;
        case 6:
            $out = '社区活动';
            break;
    }
    return $out;
}

function translateWorkguildType($sts){
    $typeList[0]['key'] = 1;
    $typeList[0]['label'] = "残联";
    $typeList[1]['key'] = 2;
    $typeList[1]['label'] = "档案";
    $typeList[2]['key'] = 3;
    $typeList[2]['label'] = "公安";
    $typeList[3]['key'] = 4;
    $typeList[3]['label'] = "经信委";
    $typeList[4]['key'] = 5;
    $typeList[4]['label'] = "粮食";
    $typeList[5]['key'] = 6;
    $typeList[5]['label'] = "民政";
    $typeList[6]['key'] = 7;
    $typeList[6]['label'] = "社保";
    $typeList[7]['key'] = 8;
    $typeList[7]['label'] = "税务";
    $typeList[8]['key'] = 9;
    $typeList[8]['label'] = "卫健";
    $typeList[9]['key'] = 10;
    $typeList[9]['label'] = "医保";
    $typeList[10]['key'] = 11;
    $typeList[10]['label'] = "住建";
    $typeList[11]['key'] = 12;
    $typeList[11]['label'] = "总工会";
    switch($sts){
        case 1:
            $out = '残联';
            break;
        case 2:
            $out = '档案';
            break;
        case 3:
            $out = '公安';
            break;
        case 4:
            $out = '经信委';
            break;
        case 5:
            $out = '粮食';
            break;
        case 6:
            $out = '民政';
            break;
        case 7:
            $out = '社保';
            break;
        case 8:
            $out = '税务';
            break;
        case 9:
            $out = '卫健';
            break;
        case 10:
            $out = '医保';
            break;
        case 11:
            $out = '住建';
            break;
        case 12:
            $out = '总工会';
            break;
    }
    return $out;
}

function translateLocation($sts){
    switch($sts){
        case 1:
            $out = '综合为老服务中心';
            break;
        case 2:
            $out = '社区服务中心';
            break;
        case 3:
            $out = '社区服务中心二分中心';
            break;
    }
    return $out;
}

function translateBannerLocation($sts){
    switch($sts){
        case 1:
            $out = '首页';
            break;
        case 2:
            $out = '资讯';
            break;
    }
    return $out;
}

function translateBannerType($sts){
    switch($sts){
        case 0:
            $out = '无跳转';
            break;
        case 1:
            $out = '内部链接';
            break;
        case 2:
            $out = '外链';
            break;
    }
    return $out;
}

function translateGroup($sts){
    switch($sts){
        case 9:
            $out = '管理员';
            break;
        case 10:
            $out = '推广员工';
            break;
        case 11:
            $out = '课程主管';
            break;
    }
    return $out;
}

function translateDelFlg($sts){
    switch($sts){
        case 0:
            $out = '否';
            break;
        case 1:
            $out = '是';
            break;
    }
    return $out;
}