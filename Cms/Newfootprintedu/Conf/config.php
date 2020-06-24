<?php
/*------------------------------- 壳隆CMS配置 -------------------------------*/
return array(


    // 更改默认的/Public 替换规则
    'TMPL_PARSE_STRING' => array(
        '__IMG__' => '/Public/admin/img',
        '__UPLOAD__' => '/Public/Uploads',
    ),

    /*------------------------------- 文件上传配置 -------------------------------*/
    'UPLOAD_CONFIG' => array(
        'maxSize' => 314572800,
        'rootPath' => './Public/Uploads/',
        'saveName' => array('uniqid', ''),
        'exts' => array('jpg', 'gif', 'png', 'jpeg', 'pdf', 'zip', 'doc', 'docx', 'ppt', 'pptx','xls'),
        'autoSub' => false,
        'subName' => array('date', 'Ymd'),
    ),

    'COMPANY' => 'Curiookids管理后台',
    // 菜单
    'MENU_NAME' => array(
        'DATA' => '用户操作',
        'SYSTEM' => '系统配置'
    ),
    'MENU' => array(
        'DATA' => array(

            'ActivityInfo' => array('list2','list4'),
            'UserInfo' => array('list'),
          //  'UserCenter' => array('list'),
            'UserAdmin' => array('list5','list6'),
            'StoreInfo' => array('list3','list')

        ),
        'SYSTEM' => array(
            'Group' => array('list', 'insert'),
            'User' => array('list', 'insert')
        )
    ),
    'DEFAULT_UPLOAD_IMG' => 'https://daning-crm.cms.incker.com/Public/Uploads/Area/template.jpeg',

    /*-------------- 小程序用 --------------*/
    // code 换取 session_key
    'JS_CODE_2_SESSION' => 'https://api.weixin.qq.com/sns/jscode2session?appid={{APP_ID}}&secret={{APP_SECRET}}&js_code={{CODE}}&grant_type=authorization_code',

    // 小程序 - ID
    'APP_ID' => 'wx383f7822c4bc1067',
    'APP_SECRET' => '82cf58097e34a9dcf79839b05fc2f7f9',

    // 微信公众号 - ID
    'WX_APP_ID' => 'wxf8ebeb39ddc5fa92',
    'WX_APP_SECRET' => 'ced37088611a963dbd0ce33531472a15',

);