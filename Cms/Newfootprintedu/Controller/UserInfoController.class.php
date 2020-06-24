<?php

namespace Newfootprintedu\Controller;

use Admin\Controller\BaseController;
use mysql_xdevapi\Session;
use Think\Page;

/**
 * @controller 客户信息
 * Class UserInfoController
 * @package Newfootprintedu\Controller
 */
class UserInfoController extends CommController {

    protected function prepareCommonData(&$data) {
//        // 常规字段
//        $fields = ['Channel_id','Channel_name','Activity_name','Qr_url'];
//        foreach ($fields as $field) {
//            $data[fmtVar($field)] = I('post.' . CONTROLLER_NAME . $field);
//
//
//        }

    }

    protected function fmtCommonData(&$data) {

//        $map['del_flg'] =0;
//        $list = M('channel_info')->where($map)->select();
//        $typeList =array();
//        if(!empty($list)){
//            foreach ($list as $k=>$v){
//                $typeList[$k]['key'] = $v['id'];
//                $typeList[$k]['label'] = $v['channel_name'];
//            }
//            $data['ChannelList'] = $typeList;
//        }
    }

    /**
     * R of CURD
     * @action 客户列表
     */
    public function listAction() {

        //删除标志为0
        $map['del_flg'] = 0;
        $map['is_submit'] = 1;

        //  推广员工只能看到自己的数据
        if($_SESSION['groupName'] == "推广员工"){
            $clientMap['from_sales_id'] = $_SESSION['user']['id'];
            $clientMap['del_flg'] = 0;
            $clientList = M('user_subscribe')->where($clientMap)->getField('user_union_id',true);
            if(!empty($clientList)){
                $map['user_union_id'] = array('in',$clientList);
            }else{
                $map['user_union_id'] = "xx";
            }

        }

        $p = I('p', 1);
        $Model = M('user_info');
        $list = $Model->where($map)->page($p . ',50')->order('id desc')->select();
        foreach ($list as $k=>$v){
            //获取是否重复、预约时间
            $map2['user_mini_open_id'] = $v['user_mini_open_id'];
            $map2['del_flg'] = 0;
            $find2 = M('evaluation_booking') -> where($map2)->order('id desc') ->select();
            if(count($find2) == 0){
                $list[$k]['booking_time'] = "-";
                $list[$k]['is_repeat'] = '否';
            }else if(count($find2) > 1){
                $list[$k]['booking_time'] = $find2[0]['booking_date']." ".$find2[0]['booking_time'];
                $list[$k]['is_repeat'] = '是';
            }else{
                $list[$k]['booking_time'] = $find2[0]['booking_date']." ".$find2[0]['booking_time'];
                $list[$k]['is_repeat'] = '否';
            }
            $list[$k]['submit_date'] = date('Y-m-d',$v['submit_time']);
            //获取其它信息
            $map3['user_union_id'] =  $v['user_union_id'];
            $map3['del_flg'] = 0;
            $find3 = M('v_subscribe_info')->where($map3)->find();
            $list[$k]['channel_name'] = $find3['channel_name'];
            $list[$k]['activity_name'] = $find3['activity_name'];
            $list[$k]['sales_name'] = $find3['nickname'];
            $list[$k]['area_name'] = $find3['area_name'];
            $list[$k]['store_name'] = $find3['store_name'];
        }

        foreach ($list as $key=>$value){
            if(empty($value['sales_name']))
                $list[$key]['sales_name'] = "-";
            if(empty($value['area_name']))
                $list[$key]['area_name'] = "-";
            if(empty($value['store_name']))
                $list[$key]['store_name'] = "-";
            if(empty($value['channel_name']))
                $list[$key]['channel_name'] = "-";
            if(empty($value['activity_name']))
                $list[$key]['activity_name'] = "-";
        }
//        $this->fmtListData($list);
        $this->assign('list', $list);
        if($_SESSION['groupName'] == "推广员工"){
            $this->assign('groupName',0);
        }else{
            $this->assign('groupName',1);
        }

        // report sessiondata
        // Session配置
        session('excelData', $list);
        $count = $Model->where($map)->count();
        $Page = new Page($count, 50);
        foreach ($_GET as $key => $val) {
            $Page->parameter[$key] = urlencode($val);
        }
        $show = $Page->show();

        $this->assign('page', $show);
        $this->display();
    }





}