<?php
/**
 * Created by PhpStorm.
 * User: vtm2k7
 * Date: 15/2/26
 * Time: 下午2:41
 */

namespace Admin\Controller;

use Think\Controller;

/**
 * @controller 登录
 * @no-power
 * Class IndexController
 * @package Admin\Controller
 */
class SignController extends Controller {

    private $token;
    private $user;
    private $rememberMe;


    public function indexAction() {
        ob_clean();
        if ($this->checkLogin()) {
            $this->doLogin();
        } else {
            $this->display();
        }
    }

    public function inAction() {
        if (IS_POST) {
            $code = I('post.passcode');
            if (!$this->checkCode($code)) {
                $this->error('验证码错误:(', U('/sign'));
            } else {
                $this->rememberMe = I('post.rememberme');
                // 检验登录
                if ($this->checkLogin()) {
                    // 登录成功
                    $this->doLogin();
                } else {
                    $this->error('用户名或密码错误:(');
                }
            }
        }
        redirect('/adminIndex');
    }

    public function outAction() {
        session(null);
        cookie('LT', null);
        $this->success('退出成功', U('/sign'));
    }

    public function codeAction() {
        ob_clean();
        $config = array(
            'fontSize' => 30,
            'useCurve' => false,
            'useNoise' => false,
            'imageW' => 374,
            'imageH' => 64,
        );
        $v = new \Think\Verify($config);
        return $v->entry();
    }


    /**
     * @return mixed
     */
    public function getToken() {
        $lt = cookie('LP');
        $this->token = ($lt) ? $lt : false;
        return $this->token;
    }

    private function checkLogin() {
        if (IS_POST) {
            // 登录验证,验证权限
            $passport = I('post.passport');
            $password = sha1(md5(I('post.password')));
            $map['username'] = $passport;
            $map['password'] = $password;
            $map['del_flg'] = array('lt',1);
            $user = M("v_user")->where($map)->find();
            if (!empty($user)) {
                $this->user = $user;
                return true;
            }
        } else if ($this->getToken()) {
            // 记住密码,验证Token
            $salt = APP_PATH;
            $passport = cookie('LP');
            $token = md5($salt . md5($passport . $salt));
            if ($token == cookie('LT')) {
                $map['username'] = $passport;
                $map['del_flg'] = array('lt',1);
                $user = M("v_user")->where($map)->find();
                if (!empty($user)) {
                    $this->user = $user;
                    return true;
                }
            }
        }
        return false;
    }

    private function doLogin() {
        // 保存用户信息
        $user = $this->user;
        if ($this->rememberMe == 'yes') {
            $salt = APP_PATH;
            $token = md5($salt . md5($user['username'] . $salt));
            cookie('LP', $user['username']);
            cookie('LT', $token);
        }
        // 更新登录信息
        $user['last_login_ip'] = get_client_ip();
        $user['last_login_time'] = time();

        // Session配置
        session('user', $user);
        session('groupName', $user['name']);
        /*session('uid', $user['id']);
        session('nickname', $user['nickname']);
        session('groupname', $user['Group']['name']);*/
        session('lastlogintime', ($user['last_login_time'] == '') ? '-' : date('Y-m-d H:i', $user['last_login_time']));

        $user['Group']['id'] = $user['group_id'];
        $user['Group']['setting'] = $user['setting'];

        $this->setRoute($user['Group']);

        M("User")->save($user);

        $this->success('登录成功:)', U('/adminIndex'));
    }


    private function checkCode($code, $id = '') {
        $v = new \Think\Verify();
        return $v->check($code, $id);
    }

    public function refreshAction() {
        $Group = M('Group');
        $this->group = $Group->where(array('id' => User()['group_id']))->find();
        $this->setRoute($this->group);
        $this->success('刷新成功', U('/'));
    }

    private function setRoute($Group) {
        if ($Group['id'] == 1) {
            // 超级管理员
            session('routes', array('super'));
            session('menu', C('MENU'));
        } else {
            session('routes', explode(C('SPLIT'), $Group['setting'] . "|AdminIndex.index"));
            session('menu', route_menu($Group['setting']));
        }
    }

}