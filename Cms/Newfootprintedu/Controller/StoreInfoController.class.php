<?php

namespace Newfootprintedu\Controller;

use Admin\Controller\BaseController;
use Think\Page;

/**
 * @controller 门店信息
 * Class StoreInfoController
 * @package Newfootprintedu\Controller
 */
class StoreInfoController extends CommController {

    protected function prepareCommonData(&$data) {
        // 常规字段
        $fields = ['Area_id','Area_name','Store_name'];
        foreach ($fields as $field) {
            $data[fmtVar($field)] = I('post.' . CONTROLLER_NAME . $field);


        }

    }

    protected function fmtCommonData(&$data) {

        $map['del_flg'] =0;
        $list = M('store_area')->where($map)->select();
        $typeList =array();
        if(!empty($list)){
            foreach ($list as $k=>$v){
                $typeList[$k]['key'] = $v['id'];
                $typeList[$k]['label'] = $v['area_name'];
            }
            $data['AreaList'] = $typeList;
        }
    }

    /**
     * R of CURD
     * @action 列表
     */
    public function listAction() {

        $map['del_flg'] = 0;

        $p = I('p', 1);
        $Model = M('store_info');
        $list = $Model->where($map)->page($p . ',50')->order('id desc')->select();

//        $this->fmtListData($list);
        $this->assign('list', $list);

        $count = $Model->where($map)->count();
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
     * @action 新增
     */
    public function insertAction() {
        $Model = M('store_info');
        if (IS_POST) {
            // 创建时间
            $data['create_time'] = time();
            $data['ip'] = get_client_ip();
            // 公共
            $this->prepareCommonData($data);
            // 增
            //获取渠道名字
            $map['id'] = $data['area_id'];
            $data['area_name'] = M('store_area') ->where($map)->getField('area_name');

            if ($rst = $Model->add($data)) {

                $this->success('添加成功', U('list'));
            } else {
                $this->error('添加失败');
            }
        } else {
            $this->fmtCommonData($data);
            $this->assign('vo', $data);
            $this->display('editor');
        }
    }

    /**
     * U & R of CURD
     * @action 编辑
     * @param $id
     */
    public function editAction($id) {
        $Model = M('store_info');
        $condition['id'] = $id;

        if (IS_POST) {
            // 模型
            $data['update_time'] = time();
            // 公共
            $this->prepareCommonData($data);


            // 改
            //获取渠道名字
            $map['id'] = $data['area_id'];
            $data['area_name'] = M('store_area') ->where($map)->getField('area_name');



            if ($rst = $Model->where($condition)->save($data)) {

                $this->success('更新成功', U('list'));


            } else {
                $this->error('更新失败');
            }
        } else {
            $data = $Model->where($condition)->find();
        }
        if ($data) {
            $this->fmtCommonData($data);
            $this->assign('vo', $data);
            $this->display('editor');
        } else {
            $this->error('非法查询');
        }
    }




    /******************************************************地区**************************************/
    protected function prepareCommonData2(&$data) {
        // 常规字段
        $fields = ['Area_name'];
        foreach ($fields as $field) {
            $data[fmtVar($field)] = I('post.' . CONTROLLER_NAME . $field);


        }

    }

    protected function fmtCommonData2(&$data) {



    }

    /**
     * R of CURD
     * @action 地区列表
     */
    public function list3Action() {

        $map['del_flg'] = 0;

        $p = I('p', 1);
        $Model = M('store_area');
        $list = $Model->where($map)->page($p . ',50')->order('id desc')->select();

//        $this->fmtListData($list);
        $this->assign('list', $list);

        $count = $Model->where($map)->count();
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
     * @action 新增地区
     */
    public function insert3Action() {
        $Model = M('store_area');
        if (IS_POST) {
            // 创建时间
            $data['create_time'] = time();
            $data['ip'] = get_client_ip();
            // 公共
            $this->prepareCommonData2($data);
            // 增
            if ($rst = $Model->add($data)) {

                $this->success('添加成功', U('list3'));
            } else {
                $this->error('添加失败');
            }
        } else {
            $this->fmtCommonData2($data);
            $this->assign('vo', $data);
            $this->display('editor3');
        }
    }

    /**
     * U & R of CURD
     * @action 编辑地区
     * @param $id
     */
    public function edit3Action($id) {
        $Model = M('store_area');
        $condition['id'] = $id;

        if (IS_POST) {
            // 模型
            $data['update_time'] = time();
            // 公共
            $this->prepareCommonData2($data);


            // 改
            if ($rst = $Model->where($condition)->save($data)) {



                $this->success('更新成功', U('list3'));


            } else {
                $this->error('更新失败');
            }
        } else {
            $data = $Model->where($condition)->find();
        }
        if ($data) {
            $this->fmtCommonData2($data);
            $this->assign('vo', $data);
            $this->display('editor3');
        } else {
            $this->error('非法查询');
        }
    }

    /**
     * U & R of CURD
     * @action 删除地区
     * @param $id
     */
    public function delete3Action($id) {
        $Model = D('store_area');
        $condition['id'] = $id;

        $data = $Model->where($condition)->find();
        if ($data && $data['del_flg'] == 0) {
            $Model->where($condition)->setField('del_flg', 1);
            $this->success('删除成功');
        } else {
            $this->error('非法操作');
        }
    }

    /**
     * 发送get请求
     * @param string $url
     * @return bool|mixed
     */
    protected function ReqGet($url = '') {
        if (empty($url)) {
            return false;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}