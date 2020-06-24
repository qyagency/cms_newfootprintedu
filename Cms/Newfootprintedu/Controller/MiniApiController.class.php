<?php

namespace Newfootprintedu\Controller;

use Think\Controller;
use PHPExcel_IOFactory;
use PHPExcel;

/**
 * @controller 默认页
 * Class ApiController
 * @package Newfootprintedu\Controller
 */
class MiniApiController extends Controller {

    public function testAction(){
        echo "success";
        echo"3";
    }

    public function _initialize() {
        $this->fmtPost();
    }

    /*
     *  用code换取小程序openid
     *  参数：code
     * */
    public function getOpenidAction() {

        $code = $this->params['code'];

        if (empty($code)){
            $rst['code'] = 201; //code为空
            $this->ajaxReturn($rst);
        }else{
            $keyUrl = $this->urlPrepare(C('JS_CODE_2_SESSION'), array('CODE' => $code));
            $keyRst = $this -> ReqGet($keyUrl);
      //      dump($keyUrl);
            $keyRst = json_decode($keyRst);
            $openid = $keyRst->openid;
            $unionid = $keyRst->unionid;
            $session_key = $keyRst->session_key;

            $map2['user_open_id'] = $openid;
            $find = M('user_session_key') -> where($map2) ->find();
            if(empty($find)){
                $add['user_open_id'] = $openid;
                $add['user_session_key'] = $session_key;
                $add['create_time'] = time();
                $add['update_time'] = time();
                $add['del_flg'] = 0;
                M('user_session_key') -> add($add);
            }else{
                $save['user_session_key'] = $session_key;
                $save['update_time'] = time();
                M('user_session_key') ->where($map2)-> save($save);
            }

            $map['del_flg'] = 0;
            $map['user_mini_open_id'] = $openid;
            $find = M('user_info')->where($map)->find();
            if(!empty($find)){
                $rst['code'] = 300;//原有用户
                $rst['user_mini_open_id'] = $openid;
                $rst['user_union_id'] = $unionid;
                $this->ajaxReturn($rst);
            }else{
                $rst['code'] = 200;//新用户
                $rst['user_mini_open_id'] = $openid;
                $rst['user_union_id'] = $unionid;

                //插入用户数据
                $add['user_mini_open_id'] = $openid;
                $add['user_union_id'] = $unionid;
                $add['create_time'] = time();
                $add['update_time'] = time();
                $add['del_flg'] = 0;
                M('user_info')->where($map)->add($add);

                $this->ajaxReturn($rst);
            }

        }
    }

    /*
         * 获取用户手机的信息
         * */
    public function getMobileAction() {

        Vendor('OpenWx.wxBizDataCrypt');
        $openid = $this->params['user_open_id'];
        if (empty($openid) || !$openid) {
            die();
        }

        $rst['code'] = 300;
        $encryptedData = $this->params['ed'];
        $iv = $this->params['iv'];

        $map['user_open_id'] = $openid;
        $find = M('user_session_key') -> where($map) ->find();
        $sessionKey =$find['user_session_key'];

        $pc = new \WXBizDataCrypt(C('APP_ID'), $sessionKey);
        //   $data ="";
        $errCode = $pc->decryptData($encryptedData, $iv, $data);
        if ($errCode == 0) {
            $userinfo = json_decode($data, true);
       //     dump($userinfo);
            $rst['user_mini_mobile'] = $userinfo['phoneNumber'];
            $map['user_mini_open_id'] = $openid;
            $map['del_flg'] = 0;
            $db = M('user_info');

            $find = $db->where($map)->find();
            if(!empty($find)){
                //插入用户数据
                $map2['user_mini_open_id'] = $openid;
                $save['user_mini_mobile'] = $userinfo['phoneNumber'];
                $save['update_time'] = time();
                $db->where($map2)->save($save);
            }else{
                //插入用户数据
                $add['user_mini_open_id'] = $openid;
                $add['user_mini_mobile'] = $userinfo['phoneNumber'];
                $add['create_time'] = time();
                $add['update_time'] = time();
                $add['del_flg'] = 0;
                $db->where($map)->add($add);
            }
            $rst['code'] = 200;
        }
        $this->ajaxReturn($rst);

    }

    /*
         * 获取用户unionid的信息
         * */
    public function getUnionIdAction() {

        Vendor('OpenWx.wxBizDataCrypt');
        $openid = $this->params['user_open_id'];
        if (empty($openid) || !$openid) {
            die();
        }

        $rst['code'] = 300;
        $encryptedData = $this->params['ed'];
        $iv = $this->params['iv'];

        $map['user_open_id'] = $openid;
        $find = M('user_session_key') -> where($map) ->find();
        $sessionKey =$find['user_session_key'];

        $pc = new \WXBizDataCrypt(C('APP_ID'), $sessionKey);
        //   $data ="";
        $errCode = $pc->decryptData($encryptedData, $iv, $data);
        if ($errCode == 0) {
            $userinfo = json_decode($data, true);
            //     dump($userinfo);
            $rst['user_union_id'] = $userinfo['unionId'];
            $map['user_mini_open_id'] = $openid;
            $map['del_flg'] = 0;
            $db = M('user_info');

            $find = $db->where($map)->find();
            if(!empty($find)){
                //插入用户数据
                $map2['user_mini_open_id'] = $openid;
                $save['user_union_id'] = $userinfo['unionId'];
                $save['update_time'] = time();
                $db->where($map2)->save($save);
            }else{
                //插入用户数据
                $add['user_mini_open_id'] = $openid;
                $add['user_union_id'] = $userinfo['unionId'];
                $add['create_time'] = time();
                $add['update_time'] = time();
                $add['del_flg'] = 0;
                $db->where($map)->add($add);
            }
            $rst['code'] = 200;
        }
        $this->ajaxReturn($rst);

    }

    /*
     * 提交学员信息
     * */
    public function submitUserInfoAction() {

        $map2['user_mini_open_id'] = $this->params['user_open_id'];
        $save['user_mobile'] =  $this->params['user_mobile'];
        $save['form_id'] =  "MINI001";
        $save['user_name'] =  $this->params['user_name'];
        $save['user_relation'] =  $this->params['user_relation'];
        $save['user_gender'] =  $this->params['user_gender'];
        $save['user_grade'] =  $this->params['user_grade'];
        $save['user_school'] =  $this->params['user_school'];
        $save['is_submit'] = 1;
        $save['submit_time'] = time();
        $save['create_time'] = time();
        $save['update_time'] = time();
        $save['del_flg'] = 0;
        M('user_info')->where($map2)->save($save);

        if(!empty($this->params['booking_date'])){
            $add['user_mini_open_id'] = $this->params['user_open_id'];
            $add['booking_date'] = $this->params['booking_date'];
            $add['booking_time'] = $this->params['booking_time'];
            $add['create_time'] = time();
            $add['update_time'] = time();
            $add['del_flg'] = 0;
            M('evaluation_booking')->add($add);
        }

        $rst['code'] = 200;
        $this->ajaxReturn($rst);
    }



    /**
     * 接受小程序post过来的数据
     * @return mixed
     */
    private function fmtPost() {

        $data = $_POST;

        if ($data) {
            $this->params = $data;
        } else {
            $this->params = [];
        }
    }

    /**
     * 发送post请求
     * @param string $url
     * @param string $param
     * @return bool|mixed
     */
    protected function ReqPost($url = '', $param = '') {
        if (empty($url) || empty($param)) {
            return false;
        }
        $postUrl = $url;
        $curlPost = $param;
        $ch = curl_init(); //初始化curl
        curl_setopt($ch, CURLOPT_URL, $postUrl); //抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0); //设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1); //post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch); //运行curl
        curl_close($ch);
        return $data;
    }

    private function post_check($post) {

        $pattern = "/(&amp;|&quot;|&lt;|&gt;|=|<|>|')+/";

        $is_match = preg_match($pattern, $post);

        if($is_match){
            // 输入的内容中含有非法字符
            $rst["code"] = 501;
            $this->ajaxReturn($rst);
            die();
        }else{
            return $post;
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

    /**
     * 格式化API URL（替换变量）
     * @param $url
     * @param null $params
     * @return mixed
     */
    protected function urlPrepare($url, $params = null) {
        // 替换APP_ID和APP_SECRET
        $url = str_replace('{{APP_ID}}', C('APP_ID'), $url);
        $url = str_replace('{{APP_SECRET}}', C('APP_SECRET'), $url);
        // 替换参数
        if ($params)
            foreach ($params as $k => $v) {
                $url = str_replace('{{' . $k . '}}', $v, $url);
            }
        return $url;
    }
}