<?php
namespace Newfootprintedu\Controller;

use Admin\Controller\BaseController;
use Org\Util\DocParser;

/**
 * @controller 权限管理
 * Class GroupController
 * @package Newfootprintedu\Controller
 */
class GroupController extends BaseController {

    /**
     * Index方法
     * @action 列表
     */
    public function listAction() {
        $list = M('Group')->where('del_flg = 0')->select();
        foreach ($list as $k => $v) {
            $list[$k]['cnt'] = count(explode(C('SPLIT'), $v['setting']));
        }
        $this->assign('list', $list);
        $this->display();
    }

    /**
     * C of CURD
     * @action 新增
     */
    public function insertAction() {
        if (IS_POST) {
            // 模型
            $Group = M('Group');
            $data['name'] = I('post.GroupName');
            $data['setting'] = implode(C('SPLIT'), I('post.for'));
            $data['create_time'] = time();

            if ($rst = $Group->add($data)) {
                $this->success('添加成功', U('list'));
            } else {
                $this->error('添加失败');
            }
        } else {
            $this->display('editor');
        }
    }

    /**
     * U of CURD
     * @action 编辑
     * @param $id
     */
    public function editAction($id) {
        $Group = M('Group');
        $condition['id'] = $id;
        if (IS_AJAX) {
            // 模型
            $data['name'] = I('post.GroupName');
            $data['setting'] = implode(C('SPLIT'), I('post.for'));
            $data['update_time'] = time();

            if ($rst = $Group->where($condition)->save($data)) {
                $this->success('更新成功', U('list'));
            } else {
                $this->error('更新失败');
            }
        } else {
            $data = $Group->where($condition)->find();
        }
        if ($data) {
            $data['setting'] = explode(C('SPLIT'), $data['setting']);
            $this->assign('vo', $data);
            $this->display('editor');
        } else {
            $this->error('非法查询');
        }

    }

    /**
     * 更新控制器列表
     * @action 刷新
     */
    public function refreshAction() {

        $powers = array();
        $controllers = array();
        $actions = array();
        $files = getfiles(__DIR__);
        // 获取控制器文件
        foreach ($files as $file) {
            $nms = explode('.class.php', $file);
            if (count($nms) == 2) {
                $this->getPowerList($controllers, $actions, $powers, ($nms[0]));
            }
        }

        // 写入动态文件
        $info = "<?php\nreturn array(\n";
        $info .= "'CONTROLLER_NAME'=>" . array_define($controllers) . ",\n";
        $info .= "'ACTION_NAME'=>" . array_define($actions) . ",\n";
        $info .= "'POWER'=>" . array_define($powers) . ",\n";
        $info .= ");";
        file_put_contents(__DIR__ . './../Conf/power.php', $info);
        $this->success('刷新成功', U('list'));
    }

    /**
     * D of CURD
     * @action 删除
     * @power-list ActivityInfo,AreaInfo,ActivitySessionInfo,BannerInfo,SurveyInfo,NoticeInfo,NewsInfo,UserInfo,Group,User
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

    /**
     * 获取方法列表
     * @param $powers
     * @param $controllerClassName
     * @return bool
     */
    private function getPowerList(&$controllers, &$actions, &$powers, $controllerClassName) {
        $dp = new DocParser();

        $class = new \ReflectionClass(MODULE_NAME . "\\Controller\\" . $controllerClassName);

//        $data['status'] = 1;
//        $data['test'] = MODULE_NAME . "\\Controller\\" . $controllerClassName;
//        $this->ajaxReturn($data);

        $cDoc = $dp->parse($class->getDocComment());
        $controller = str_replace('Controller', '', $controllerClassName);
        $controllers[$controller] = $cDoc['controller'];
        if (isset($cDoc['no-power']))
            return false;


        //获取类中的方法，设置获取public,protected类型方法
        $methods = $class->getMethods(\ReflectionMethod::IS_PUBLIC + \ReflectionMethod::IS_PROTECTED);
        //遍历所有的方法
        foreach ($methods as $method) {
            $an = $method->getName();
            $isAction = (substr($an, -6) == C('ACTION_SUFFIX'));
            if (!$isAction)
                continue;
            //解析注释
            $dp = new DocParser();
            $aDoc = $dp->parse($method->getDocComment());
            if (isset($aDoc['no-power']))
                continue;
            if (isset($aDoc['power-list'])) {
                $whiteList = explode(',', $aDoc['power-list']);
                if (!in_array($controller, $whiteList))
                    continue;
            }
            $action = str_replace('Action', '', $an);
            $actions[$action] = $powers[$controller][$action] = $aDoc['action'];
        }
    }
}