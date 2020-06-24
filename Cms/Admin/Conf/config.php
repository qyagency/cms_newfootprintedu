<?php
return array(
	// 数据库配置
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'rds6s4468n5o2mogo0jf.mysql.rds.aliyuncs.com', // 服务器地址
    'DB_NAME'               =>  'website',          // 数据库名
    'DB_USER'               =>  'website',      // 用户名
    'DB_PWD'                =>  'cX123698745',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'sh_',    // 数据库表前缀

    // 更改默认的/Public 替换规则
    'TMPL_PARSE_STRING' => array(
        '__IMG__' => '/Public/admin/img',
        '__UPLOAD__' => '/Public/Uploads',
    ),

    'SHOW_PAGE_TRACE'           =>  1//显示调试信息
);