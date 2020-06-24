<?php

namespace Newfootprintedu\Controller;

use Admin\Controller\BaseController;
use Think\Page;

/**
 * @controller 基础类
 * @no-power
 * Class BaseController
 * @package Newfootprintedu\Controller
 */
class CommController extends BaseController {

    protected $Model;
    protected $map;

    public function _initialize() {
        parent::_initialize();
        $this->Model = CONTROLLER_NAME;
        $this->map['del_flg'] = array('lt', 1);
        $a=1;
    }

    /**
     * R of CURD
     * @action 列表
     */
    public function listAction() {

        $this->fmtParam();

        $p = I('p', 1);
        $Model = M($this->Model);
        $list = $Model->where($this->map)->page($p . ',10')->order('id desc')->select();
        $this->fmtListData($list);
        $this->assign('list', $list);

        $count = $Model->where($this->map)->count();
        $Page = new Page($count, 10);
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
        $Model = M($this->Model);
        if (IS_POST) {
            // 创建时间
            $data['create_time'] = time();
            $data['ip'] = get_client_ip();
            // 公共
            $this->prepareCommonData($data);
            // 增
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
        $Model = M($this->Model);
        $condition['id'] = $id;

        if (IS_POST) {
            // 模型
            $data['update_time'] = time();
            // 公共
            $this->prepareCommonData($data);
            // 改
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

    /**
     * D of CURD
     * @action 删除
     * @power-list ActivityInfo,Group,User,UserInfo,UserAdmin,StoreInfo
     * @param $id
     */
    public function deleteAction($id) {
        $Model = D(CONTROLLER_NAME);
        $condition['id'] = $id;

        $data = $Model->where($condition)->find();
        if ($data && $data['del_flg'] == 0) {
            $Model->where($condition)->setField('del_flg', 1);
            $this->success('删除成功');
        } else {
            $this->error('非法操作');
        }
    }

    // 接口
    protected function fmtParam(&$map) {

    }

    protected function fmtListData(&$data) {
    }

    protected function fmtCommonData(&$data) {
    }

    protected function prepareCommonData(&$data) {
    }
}