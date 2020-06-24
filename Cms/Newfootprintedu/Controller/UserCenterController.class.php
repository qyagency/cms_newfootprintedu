<?php

namespace Newfootprintedu\Controller;

use Admin\Controller\BaseController;
use Think\Page;

/**
 * @controller 员工中心
 * Class UserCenterController
 * @package Newfootprintedu\Controller
 */
class UserCenterController extends CommController {

    protected function prepareCommonData(&$data) {



    }

    protected function fmtCommonData(&$data) {

        $map['del_flg'] =0;
        $list = M('activity_info')->where($map)->select();
        $typeList =array();
        if(!empty($list)){
            foreach ($list as $k=>$v){
                $typeList[$k]['key'] = $v['id'];
                $typeList[$k]['label'] = $v['channel_name']." ".$v['activity_name'];
            }
            $data['ActivityList'] = $typeList;
        }

    }

    /**
     * R of CURD
     * @action 列表
     */
    public function listAction() {

        $qr = I('get.qr');

        $map['id'] =$_SESSION['user']['id'];

        $Model = M('v_user');
        $list = $Model->where($map)->order('id desc')->find();

//        if($qr != 1){
//            $list['qr_url'] = 'https://www.curioo.com.cn/Public/upload/qrcode/blank.jpg';
//        }
        $this->fmtCommonData($data);
        $this->assign('activity', $data);
        $this->assign('list', $list);
        $this->display();
    }



}