<?php
/**
 * Created by PhpStorm.
 * User: vtm2k7
 * Date: 15/2/26
 * Time: 下午2:34
 */

namespace Admin\Controller;

use Think\Controller;

/**
 * @controller 基础类
 * @power-order 1
 * @no-power
 * Class BaseController
 * @package Admin\Controller
 */
class BaseController extends Controller {

    Public function _initialize() {

        if ($this->isLogin()) {

            // 边栏状态控制
            $menus = C('MENU');
            $cns = C('CONTROLLER_NAME');
            $ans = C('ACTION_NAME');

            // 权限验证
            if (CONTROLLER_NAME != 'API')
                $this->checkAuth();

            // 当前位置
            $navTag = $cns[CONTROLLER_NAME];
            if ($ans[ACTION_NAME])
                $navTag .= ' / ' . $ans[ACTION_NAME];
            $this->assign('navTag', $navTag);

            // 当前菜单高亮
            foreach ($menus as $k => $v) {
                if (array_key_exists(CONTROLLER_NAME, $v)) {
                    $currentMenu = $k;
                    break;
                }
            }
            $this->assign('CMENU', $currentMenu);

        } else {
            redirect(U('/sign'));
        }
    }

    /**
     * 权限检测
     * @param string $cName
     * @param string $aName
     * @return bool
     */
    protected function checkAuth($cName = '', $aName = '') {
        if (empty($cName))
            $cName = CONTROLLER_NAME;
        if (empty($aName))
            $aName = ACTION_NAME;

        $route = $cName . '.' . $aName;
        if ($this->isSuper()) {
            // 超级管理员
            $actions = array('cRefresh', 'cInsert', 'cEdit', 'cDelete', 'cView', 'cList');
            foreach ($actions as $action) {
                $this->assign($action, 'super');
            }
        } else if (in_array($route, session('routes'))) {
            // 通用表单权限控制:编辑 + 删除
            $this->assign('cEdit', $cName . '.edit');
            $this->assign('cDelete', $cName . '.delete');
            $this->assign('cView', $cName . '.view');
        } else {
            //
            $this->error('没有权限');
        }
        return true;
    }

    /**
     * 检测是否是超级管理员
     * @return bool
     */
    protected function isSuper() {
        return in_array('super', session('routes'));
    }

    /**
     * 检测是否登录
     * @return mixed
     */
    private function isLogin() {
        return session('?user');
    }

    /**
     * @action 上传
     * @power-list
     * @param $subFolder
     * 表单中的上传文件（图片）
     * 禁止使用变量数组上传图片
     * @return array    返回上传结果的地址数组
     */
    protected function uploadAction($subFolder = '') {
        $time = time();
        $urls = array();
        $cfg = C('UPLOAD_CONFIG');
        $cfg['savePath'] = $subFolder . '/';
        $Upload = new \Think\Upload($cfg);
        $info = $Upload->upload();
        if ($info) {
            foreach ($info as $file) {
                $fn = $file['savepath'] . $file['savename'];
                $urls[$file['key']] = $fn;
                // 更新到数据库文件库（准备数据）
                $dataList[] = array(
                    'name' => $file['savename'],
                    'type' => $file['type'],
                    'size' => $file['size'],
                    'fold' => $subFolder,
                    'create' => $time
                );
                // 更新到OSS中
                if (C('OSS_BUCKET'))
                    upload_file_oss($fn);
            }
        }
        // 更新到数据库文件库
        M('UploadLibrary')->addAll($dataList);
        return $urls;
    }

    /**
     * @action 上传XLS
     * @power-list
     * 表单中的上传文件（XLS）
     * @return array    返回上传结果的地址
     */
    protected function uploadXlsAction() {
        $cfg = C('UPLOAD_XLS');
        $cfg['savePath'] = 'xls/';
        $Upload = new \Think\Upload($cfg);
        $info = $Upload->upload();
        if ($info) {
            foreach ($info as $file) {
                $fn = $file['savepath'] . $file['savename'];
                return $fn;
            }
        }
    }

    /**
     * 批量设置变量到模板
     * @param $urls     文件路径数组
     * @param $fold     子目录名
     * @param $field    变量名
     * @return mixed
     */
    protected function retrieveUploadUrl(&$urls, $fold, $field) {
        $existedPic = I('post.' . $fold . 'Existed' . $field);
        if (!$existedPic) {
            $url = $urls[$fold . $field];
            unset($urls[$fold . $field]);
        } else {
            $url = $existedPic;
        }
        return $url;
    }

    /**
     * 批量设置变量到模板
     * @param $vars
     */
    protected function assigns($vars) {
        foreach ($vars as $k => $v) {
            $this->assign($k, $v);
        };
    }

    /**
     * 发送post请求
     * @param string $url
     * @param string $param
     * @return bool|mixed
     */
    protected function request_post($url = '', $param = '') {
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

    /**
     * 发送get请求
     * @param string $url
     * @return bool|mixed
     */
    protected function request_get($url = '') {
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