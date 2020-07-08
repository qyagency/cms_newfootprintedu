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

            $rst['code'] = 200;//获取成功
            $rst['user_openid'] = $openid;
            $rst['user_unionid'] = $unionid;
            $this->ajaxReturn($rst);

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
        $errCode = $pc->decryptData($encryptedData, $iv, $data);
        if ($errCode == 0) {
            $userinfo = json_decode($data, true);
            $rst['code'] = 200;
            $rst['user_mobile'] = $userinfo['user_mobile'];
        }
        $this->ajaxReturn($rst);
    }


    /*
     * 注册成为正式用户
     * */
    public function submitUserInfoAction() {

        $map2['user_openid'] = $this->params['user_openid'];
        $map2['del_flg'] = 0;
        $find = M('fact_user_info')->where($map2)->find();
        if(!empty($find)){
            $rst['code'] = 201;//已经注册过
            $this->ajaxReturn($rst);
        }else{
            $add['user_openid'] = $this->params['user_openid'];
            $add['user_unionid'] = $this->params['user_unionid'];
            $add['user_nickname'] = $this->params['user_nickname'];
            $add['user_avatar'] = $this->params['user_avatar'];
            $add['user_mobile'] = $this->params['user_mobile'];
            $add['user_name'] = $this->params['user_name'];
            $add['user_province'] = $this->params['user_province'];
            $add['user_city'] = $this->params['user_city'];
            $add['user_address'] = $this->params['user_address'];
            $add['is_student'] = $this->params['is_student'];
            $add['user_grade'] = $this->params['user_grade'];
            $add['user_school'] = $this->params['user_school'];
            $add['user_interest'] = $this->params['user_interest'];
            $add['create_time'] = time();
            $add['update_time'] = time();
            $add['del_flg'] = 0;
            M('fact_user_info')->add($add);

            $rst['code'] = 200;
            $this->ajaxReturn($rst);
        }
    }

    /*
     * 提交教师认证信息
     * */
    public function submitTeacherInfoAction() {

        $map2['teacher_openid'] = $this->params['user_openid'];
        $map2['del_flg'] = 0;
        $find = M('fact_teacher_info')->where($map2)->find();
        if(!empty($find)){
            $save['teacher_name'] = $this->params['teacher_name'];
            $save['teacher_avatar'] = $this->params['teacher_avatar'];
            $save['teacher_mobile'] = $this->params['teacher_mobile'];
            $save['teacher_license'] = $this->params['teacher_license'];
            $save['teacher_province'] = $this->params['teacher_province'];
            $save['teacher_city'] = $this->params['teacher_city'];
            $save['teacher_address'] = $this->params['teacher_address'];
            $save['teacher_school'] = $this->params['teacher_school'];
            $save['teacher_subject'] = $this->params['teacher_subject'];
            $save['teacher_material'] = $this->params['teacher_material'];
            $save['teacher_subject'] = $this->params['teacher_subject'];
            $save['update_time'] = time();
            M('fact_teacher_info')->where($map2)->save($save);
        }else{
            $add['teacher_openid'] = $this->params['user_openid'];
            $add['teacher_name'] = $this->params['teacher_name'];
            $add['teacher_avatar'] = $this->params['teacher_avatar'];
            $add['teacher_mobile'] = $this->params['teacher_mobile'];
            $add['teacher_license'] = $this->params['teacher_license'];
            $add['teacher_province'] = $this->params['teacher_province'];
            $add['teacher_city'] = $this->params['teacher_city'];
            $add['teacher_address'] = $this->params['teacher_address'];
            $add['teacher_school'] = $this->params['teacher_school'];
            $add['teacher_subject'] = $this->params['teacher_subject'];
            $add['teacher_material'] = $this->params['teacher_material'];
            $add['teacher_subject'] = $this->params['teacher_subject'];
            $add['create_time'] = time();
            $add['update_time'] = time();
            $add['del_flg'] = 0;
            M('fact_teacher_info')->add($add);
        }

        $rst['code'] = 200;
        $this->ajaxReturn($rst);
    }

    /*
     * 提交视频信息
     * */
    public function submitVideoInfoAction() {

        $map2['id'] = $this->params['video_id'];
        $map2['del_flg'] = 0;
        $find = M('fact_video_info')->where($map2)->find();
        if(!empty($find)){
            $save['video_title'] = $this->params['video_title'];
            $save['video_describe'] = $this->params['video_describe'];
            $save['video_label'] = $this->params['video_label'];
            $save['video_url'] = $this->params['video_url'];
            $save['video_head_img'] = $this->params['video_head_img'];
            $save['upload_openid'] = $this->params['upload_openid'];
            $save['video_grade_id'] = $this->params['video_grade_id'];
            $save['video_subject_id'] = $this->params['video_subject_id'];
            $save['update_time'] = time();
            M('fact_teacher_info')->where($map2)->save($save);
        }else{
            $add['video_title'] = $this->params['video_title'];
            $add['video_describe'] = $this->params['video_describe'];
            $add['video_label'] = $this->params['video_label'];
            $add['video_url'] = $this->params['video_url'];
            $add['video_head_img'] = $this->params['video_head_img'];
            $add['upload_openid'] = $this->params['upload_openid'];
            $add['video_grade_id'] = $this->params['video_grade_id'];
            $add['video_subject_id'] = $this->params['video_subject_id'];
            $add['create_time'] = time();
            $add['update_time'] = time();
            $add['del_flg'] = 0;
            M('fact_user_info')->add($add);
        }

        $rst['code'] = 200;
        $this->ajaxReturn($rst);
    }

    /*
     * 获取首页信息
     * */
    public function getHomeInfoAction() {

        //首页视频信息
        $map['is_top'] = 1;
        $map['del_flg'] = 0;
        $rst['video_info'] = M('fact_video_info')->where($map)->order('playing_count desc,favorite_count desc')->limit(10)->select();

        //获取登录用户信息
        $map2['user_openid'] = $this->params['user_openid'];
        $map2['del_flg'] = 0;
        $find = M('fact_user_info') ->where($map2)->find();
        if(empty($find)){
            $rst['user_info']['id'] = 0; //没有注册
        }else{
            $rst['user_info'] = $find;
        }

        //获取年级
        $map3['del_flg'] = 0;
        $rst['grade_info'] = M('dim_grade')->where($map3)->select();
        //获取教材
        $rst['material_info'] = M('dim_material')->where($map3)->select();
        //获取学科
        $rst['subject_info'] = M('dim_subject')->where($map3)->select();

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