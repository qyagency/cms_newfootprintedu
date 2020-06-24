<?php

namespace Newfootprintedu\Controller;

use Admin\Controller\BaseController;
use Think\Page;

/**
 * @controller 地推管理
 * Class UserAdminController
 * @package Newfootprintedu\Controller
 */
class UserAdminController extends CommController {

    protected function prepareCommonData(&$data) {
        // 常规字段
        $fields = ['Group_id','Nickname','Username','Password','Store_id'];
        foreach ($fields as $field) {
            $data[fmtVar($field)] = I('post.' . CONTROLLER_NAME . $field);


        }


    }
    protected function prepareCommonData2(&$data) {
        // 常规字段
        $fields = ['Group_id','Nickname','Username','Store_id'];
        foreach ($fields as $field) {
            $data[fmtVar($field)] = I('post.' . CONTROLLER_NAME . $field);


        }


    }

    protected function fmtCommonData(&$data) {


        $map['del_flg'] =0;
        $map['id'] = array('gt',1);
        $list = M('group')->where($map)->select();
        $typeList =array();
        if(!empty($list)){
            foreach ($list as $k=>$v){
                $typeList[$k]['key'] = $v['id'];
                $typeList[$k]['label'] = $v['name'];
            }
            $data['GroupList'] = $typeList;
        }

        $map2['del_flg'] =0;
        $list = M('store_area')->where($map2)->select();
        $typeList =array();
        if(!empty($list)){
            foreach ($list as $k=>$v){
                $typeList[$k]['key'] = $v['id'];
                $typeList[$k]['label'] = $v['area_name'];
            }
            $data['AreaList'] = $typeList;
        }

        $list = M('store_info')->where($map2)->select();
        $typeList =array();
        if(!empty($list)){
            foreach ($list as $k=>$v){
                $typeList[$k]['key'] = $v['id'];
                $typeList[$k]['label'] = $v['store_name'];
            }
            $data['StoreList'] = $typeList;
        }
    }

    /**
     * R of CURD
     * @action 员工管理
     */
    public function list5Action() {

    //    $map['del_flg'] = 0;

        $p = I('p', 1);
        $Model = M('v_user');
        $list = $Model->where('1=1')->page($p . ',50')->order('id desc')->select();

//        $this->fmtListData($list);
        $this->assign('list', $list);

        $count = $Model->where('1=1')->count();
        $Page = new Page($count, 50);
        foreach ($_GET as $key => $val) {
            $Page->parameter[$key] = urlencode($val);
        }
        $show = $Page->show();

        $this->assign('page', $show);
        $this->display();
    }

    /**
     * C of CURD
     * @action 账户新增
     */
    public function insertAction() {
        try {
            $Model = M('user');
            if (IS_POST) {
                // 创建时间
                $data['create_time'] = time();
                $data['ip'] = get_client_ip();
                // 公共
                $this->prepareCommonData($data);
                // 增
                if (!empty($data['password']))
                    $data['password'] = sha1(md5($data['password']));
                if ($rst = $Model->add($data)) {

                    $this->success('添加成功', U('list5'));
                } else {
                    $this->error('添加失败');
                }
            } else {
                $this->fmtCommonData($data);
                $this->assign('vo', $data);
                $this->display('editor');
            }
        } catch (\Exception $e) {
            //用户名已存在
            $this->error('用户名已存在');
        }
    }

    /**
     * U & R of CURD
     * @action 账户编辑
     * @param $id
     */
    public function editAction($id) {
        try {
            $Model = M('user');
            $condition['id'] = $id;

            if (IS_POST) {
                // 模型
                $data['update_time'] = time();
                // 公共
                $this->prepareCommonData2($data);

                if ($rst = $Model->where($condition)->save($data)) {



                    $this->success('更新成功', U('list5'));


                } else {
                    $this->error('更新失败');
                }
            } else {
                $data = $Model->where($condition)->find();
            }
            if ($data) {
                $this->fmtCommonData($data);
                $this->assign('vo', $data);
                $this->display('editor2');
            } else {
                $this->error('非法查询');
            }
        } catch (\Exception $e) {
            //用户名已存在
            $this->error('用户名已存在');
        }
    }

    /**
     * U & R of CURD
     * @action 重置密码
     * @param $id
     */
    public function edit2Action($id) {
        $Model = M('user');
        $condition['id'] = $id;


        $data2['password'] = sha1(md5("123456"));
        $rst = $Model->where($condition)->save($data2);
        $this->success('重置成功', U('list5'));

    }

    /**
     * D of CURD
     * @action 账户删除
     * @power-list UserAdmin
     * @param $id
     */
    public function deleteAction($id) {
        $Model = D('user');
        $condition['id'] = $id;

        $data = $Model->where($condition)->find();
        if ($data && $data['del_flg'] == 0) {
            $Model->where($condition)->setField('del_flg', 1);
            $this->success('删除成功');
        } else {
            $this->error('非法操作');
        }
    }














    protected function fmtCommonData3(&$data) {

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
     * @action 员工中心
     */
    public function list6Action() {

        $qr = I('get.qr');

        $map['id'] =$_SESSION['user']['id'];

        $Model = M('v_user');
        $list = $Model->where($map)->order('id desc')->find();

//        if($qr != 1){
//            $list['qr_url'] = 'https://www.curioo.com.cn/Public/upload/qrcode/blank.jpg';
//        }
        $this->fmtCommonData3($data);
        $this->assign('activity', $data);
        $this->assign('list', $list);
        $this->display();
    }

}