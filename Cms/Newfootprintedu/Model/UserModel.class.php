<?php
namespace Newfootprintedu\Model;

use Think\Model\RelationModel;

class UserModel extends RelationModel {

    protected $_link = array(
        'Group' => self::BELONGS_TO,
    );

}