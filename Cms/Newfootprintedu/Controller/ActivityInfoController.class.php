<?php

namespace Newfootprintedu\Controller;

use Admin\Controller\BaseController;
use Think\Page;

/**
 * @controller 点位信息
 * Class ActivityInfoController
 * @package Newfootprintedu\Controller
 */
class ActivityInfoController extends CommController {

    protected function prepareCommonData(&$data) {
        // 常规字段
        $fields = ['Channel_id','Channel_name','Activity_name','Qr_url'];
        foreach ($fields as $field) {
            $data[fmtVar($field)] = I('post.' . CONTROLLER_NAME . $field);


        }

    }

    protected function fmtCommonData(&$data) {

        $map['del_flg'] =0;
        $list = M('channel_info')->where($map)->select();
        $typeList =array();
        if(!empty($list)){
            foreach ($list as $k=>$v){
                $typeList[$k]['key'] = $v['id'];
                $typeList[$k]['label'] = $v['channel_name'];
            }
            $data['ChannelList'] = $typeList;
        }
    }

    /**
     * R of CURD
     * @action 活动列表
     */
    public function list4Action() {

        $map['del_flg'] = 0;

        $p = I('p', 1);
        $Model = M('activity_info');
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
     * @action 活动新增
     */
    public function insertAction() {
        $Model = M('activity_info');
        if (IS_POST) {
            // 创建时间
            $data['create_time'] = time();
            $data['ip'] = get_client_ip();
            // 公共
            $this->prepareCommonData($data);
            // 增
            //获取渠道名字
            $map['id'] = $data['channel_id'];
            $data['channel_name'] = M('channel_info') ->where($map)->getField('channel_name');

            $map2['activity_name'] = $data['activity_name'];
            $map2['del_flg'] = 0;
            $find = M('activity_info')->where($map2)->find();
            if(empty($find)){
                if ($rst = $Model->add($data)) {

                    //生成二维码
                    $id = M('activity_info')->where($data)->getField('id');
                    $this->ReqGet("https://www.curioo.com.cn/api/getQrCode/activity_id/$id");

                    $this->success('添加成功', U('list4'));
                } else {
                    $this->error('添加失败');
                }
            }else{
                $this->error('活动名称重复');
            }

        } else {
            $this->fmtCommonData($data);
            $this->assign('vo', $data);
            $this->display('editor');
        }
    }

    /**
     * U & R of CURD
     * @action 活动编辑
     * @param $id
     */
    public function editAction($id) {
        $Model = M('activity_info');
        $condition['id'] = $id;

        if (IS_POST) {
            // 模型
            $data['update_time'] = time();
            // 公共
            $this->prepareCommonData($data);


            // 改
            //获取渠道名字
            $map['id'] = $data['channel_id'];
            $data['channel_name'] = M('channel_info') ->where($map)->getField('channel_name');

            $map2['activity_name'] = $data['activity_name'];
            $map2['del_flg'] = 0;
            $map2['id'] = array('neq',$id);
            $find = M('activity_info')->where($map2)->find();
            if(empty($find)){
                if ($rst = $Model->where($condition)->save($data)) {
                    //生成二维码
                    $this->ReqGet("https://www.curioo.com.cn/api/getQrCode/activity_id/$id");


                    $this->success('更新成功', U('list4'));


                } else {
                    $this->error('更新失败');
                }
            }else{
                $this->error('活动名称重复');
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




    /******************************************************渠道***************************************/
    protected function prepareCommonData2(&$data) {
        // 常规字段
        $fields = ['Channel_name'];
        foreach ($fields as $field) {
            $data[fmtVar($field)] = I('post.' . CONTROLLER_NAME . $field);


        }

    }

    protected function fmtCommonData2(&$data) {



    }

    /**
     * R of CURD
     * @action 渠道列表
     */
    public function list2Action() {

        $map['del_flg'] = 0;

        $p = I('p', 1);
        $Model = M('channel_info');
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
     * @action 新增渠道
     */
    public function insert2Action() {
        $Model = M('channel_info');
        if (IS_POST) {
            // 创建时间
            $data['create_time'] = time();
            $data['ip'] = get_client_ip();
            // 公共
            $this->prepareCommonData2($data);
            // 增
            $map2['channel_name'] = $data['channel_name'];
            $map2['del_flg'] = 0;
            $find = M('channel_info')->where($map2)->find();
            if(empty($find)){
                if ($rst = $Model->add($data)) {

                    $this->success('添加成功', U('list2'));
                } else {
                    $this->error('添加失败');
                }
            }else{
                $this->error('渠道名称重复');
            }

        } else {
            $this->fmtCommonData2($data);
            $this->assign('vo', $data);
            $this->display('editor2');
        }
    }

    /**
     * U & R of CURD
     * @action 编辑渠道
     * @param $id
     */
    public function edit2Action($id) {
        $Model = M('channel_info');
        $condition['id'] = $id;

        if (IS_POST) {
            // 模型
            $data['update_time'] = time();
            // 公共
            $this->prepareCommonData2($data);


            // 改
            $map2['channel_name'] = $data['channel_name'];
            $map2['del_flg'] = 0;
            $map2['id'] = array('neq',$id);
            $find = M('channel_info')->where($map2)->find();
            if(empty($find)){
                if ($rst = $Model->where($condition)->save($data)) {



                    $this->success('更新成功', U('list2'));


                } else {
                    $this->error('更新失败');
                }
            }else{
                $this->error('渠道名称重复');
            }

        } else {
            $data = $Model->where($condition)->find();
        }
        if ($data) {
            $this->fmtCommonData2($data);
            $this->assign('vo', $data);
            $this->display('editor2');
        } else {
            $this->error('非法查询');
        }
    }

    /**
     * U & R of CURD
     * @action 删除渠道
     * @param $id
     */
    public function delete2Action($id) {
        $Model = D('channel_info');
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