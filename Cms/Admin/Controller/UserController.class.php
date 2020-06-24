<?php
namespace Admin\Controller;

/**
 * @controller 用户管理
 * Class UserController
 * @package Admin\Controller
 */
class UserController extends BaseController {

    // 上传子目录
    const UPLOAD_SUB_FOLDER = './User/';

    // 禁用空操作
    public function _empty() {
        die();
    }

    /**
     * U of CURD
     * @action 编辑信息
     */
    public function infoAction() {

        $User = M('User');
        $Condition['id'] = User()['id'];
        $data = $User->where($Condition)->find();

        if (IS_AJAX) {
            // 更新时间
            $data['update_time'] = time();
            // 公共
            $this->prepareCommonData($data);
            // 权限控制
            unset($data['group_id']);
            unset($data['status']);

            $User->save($data);
            $this->success('更新成功', U('/adminIndex'));
        }

        $this->assign('vo', $data);
        $this->display();
    }

    /**
     * U of CURD
     * @action 列表
     */
    public function listAction() {
        $User = M('User');
        $list = $User->where('group_id>1 and del_flg < 1')->select();
        $this->assign('list', $list);

        $Group = M('Group');
        $groupList = $Group->where('id> 1 and del_flg < 1')->getField('id,name');
        $this->assign('groupList', $groupList);

        $this->display();
    }

    /**
     * C of CURD
     * @action 新增
     */
    public function insertAction() {
        if (IS_POST) {
            // 模型
            $User = D('User');
            // 创建时间
            $data['create_time'] = time();
            // 公共
            $this->prepareCommonData($data);

            if ($rst = $User->add($data)) {
                $this->success('添加成功', U('list'));
            } else {
                $this->error('添加失败');
            }
        }
        $this->fmtCommonData($data);
        $this->assign('vo', $data);
        // 权限组
        $Group = M('Group');
        $this->assign('groupList', $Group->where('id>1 and del_flg < 1')->select());
        $this->display('editor');
    }

    /**
     * U of CURD
     * @action 编辑
     */
    public function editAction($id) {
        $User = M('User');
        $Condition['id'] = $id;
        $data = $User->where($Condition)->find();

        if (IS_AJAX) {

            // 模型
            $User = D('User');
            // 更新时间
            $data['update_time'] = time();
            // 公共
            $this->prepareCommonData($data);

            $User->save($data);
            $this->success('更新成功', U('list'));
        }


        // 权限组
        $Group = M('Group');
        $this->assign('groupList', $Group->where('id>1 and del_flg < 1')->select());

        if ($data) {
            $this->fmtCommonData($data);
            $this->assign('vo', $data);
            $this->display('editor');
        } else {
            $this->error('非法查询');
        }

    }

    protected function fmtCommonData(&$data) {


    }

    protected function prepareCommonData(&$data) {

        $data['username'] = I('post.UserName');
        $data['nickname'] = I('post.NickName');
        $data['email'] = I('post.Email');

        $pw = I('post.PassWord');
        if (!empty($pw))
            $data['password'] = sha1(md5(I('post.PassWord')));
        $data['group_id'] = I('post.Group');
        $data['status'] = (I('post.Status') == 'on') ? 1 : 0;
    }
}