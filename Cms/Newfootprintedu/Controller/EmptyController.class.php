<?php
namespace Newfootprintedu\Controller;

use Admin\Controller\BaseController;

/**
 * @controller 接口管理
 * Class ApiController
 * @package Newfootprintedu\Controller
 */
class EmptyController extends BaseController {

    public function _empty() {
        redirect(U('/sign'));
    }

}