<?php
/**
 * Created by PhpStorm.
 * User: vtm2k7
 * Date: 16/1/28
 * Time: 下午4:33
 */

namespace Admin\Controller;

use Think\Controller;


class ApiController extends BaseController {


    public function modelAction($target) {
        $list = M($target)->select();
        $this->assign('list', $list);
        $this->display();
    }

}