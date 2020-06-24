<?php
/*------------------------------- CMS全局通用配置 -------------------------------*/
return array(

    /*------------------------------- 文件上传配置 -------------------------------*/
    'UPLOAD_CONFIG' => array(
        'maxSize' => 31457280,
        'rootPath' => './Public/Uploads/',
        'saveName' => array('uniqid', ''),
        'exts' => array('jpg', 'gif', 'png', 'jpeg', 'pdf', 'zip'),
        'autoSub' => false,
        'subName' => array('date', 'Ymd'),
    ),

    'UPLOAD_XLS' => array(
        'maxSize' => 31457280,
        'rootPath' => './Public/Uploads/',
        'saveName' => array('uniqid', ''),
        'exts' => array('xls'),
        'autoSub' => false,
        'subName' => array('date', 'Ymd'),
    ),

    /*------------------------------- 框架配置 -------------------------------*/

    // 默认方法
    'ACTION_SUFFIX' => 'Action',

    // 自定义标签库
    'TAGLIB_PRE_LOAD' => 'Admin\\TagLib\\Cps',

    // COOKIE
    'COOKIE_PREFIX' => 'CMS_',
    'COOKIE_EXPIRE' => '604800',

    // 分隔符
    'SPLIT' => '|',

    // 额外配置项目 power动态权限控制
    'LOAD_EXT_CONFIG' => 'power,mail,db',

    // 跳转模板
    'TMPL_ACTION_SUCCESS' => 'Public/200',
    'TMPL_ACTION_ERROR' => 'Public/500',

    /*------------------------------- 微信公共配置项 -------------------------------*/

    // 新浪短链前缀
    'SHORT_PREFIX' => 'http://t.cn',
    // 网页AC授权地址
    'SNS_TOKEN_URL' => "https://api.weixin.qq.com/sns/oauth2/access_token?appid={{APP_ID}}&secret={{APP_SECRET}}&code={{CODE}}&grant_type=authorization_code",
    // SNS授权获取用户信息
    'SNS_USER_URL' => "https://api.weixin.qq.com/sns/userinfo?access_token={{TOKEN}}&openid={{OPEN_ID}}&lang=zh_CN",

    /*------------------------------- 客户提供公众号的情况下,授权调用 -------------------------------*/
    // 网页静默授权
    'SNS_AUTH_BASE' => "https://open.weixin.qq.com/connect/oauth2/authorize?appid={{APP_ID}}&redirect_uri={{URI}}&response_type=code&scope=snsapi_base&state={{STATE}}#wechat_redirect",
    // 网页高级授权
    'SNS_AUTH_ADV' => "https://open.weixin.qq.com/connect/oauth2/authorize?appid={{APP_ID}}&redirect_uri={{URI}}&response_type=code&scope=snsapi_userinfo&state={{STATE}}#wechat_redirect",
    // 企业静默授权
    'CORP_AUTH_BASE' => "https://open.weixin.qq.com/connect/oauth2/authorize?appid={{APP_ID}}&redirect_uri={{URI}}&response_type=code&scope=snsapi_base&agentid={{AGENT_ID}}&state={{STATE}}#wechat_redirect",
    // 企业静默授权
    'CORP_AUTH_BASE_PLUS' => "https://open.weixin.qq.com/connect/oauth2/authorize?appid={{APP_ID}}&redirect_uri={{URI}}&response_type=code&scope=snsapi_userinfo&agentid={{AGENT_ID}}&state={{STATE}}#wechat_redirect",
    // 企业高级授权
    'CORP_AUTH_BASE' => "https://open.weixin.qq.com/connect/oauth2/authorize?appid={{APP_ID}}&redirect_uri={{URI}}&response_type=code&scope=snsapi_privateinfo&agentid={{AGENT_ID}}&state={{STATE}}#wechat_redirect",

    /*-------------- JSSDK --------------*/
    // 公众号AC授权地址
    'CGI_TOKEN_URL' => "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={{APP_ID}}&secret={{APP_SECRET}}",
    // JS授权地址
    'CGI_TICKET_URL' => "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={{TOKEN}}&type=jsapi",
    // AC获取用户信息
    'CGI_USER_URL' => "https://api.weixin.qq.com/cgi-bin/user/info?access_token={{TOKEN}}&openid={{OPEN_ID}}&lang=zh_CN",
    // 企业号AC授权地址
    'CORP_TOKEN_URL' => "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid={{APP_ID}}&corpsecret={{APP_SECRET}}",
    // 企业号获取成员信息
    'CGI_CORP_USER_URL' => "https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token={{TOKEN}}&code={{CODE}}",

    /*-------------- 接口调用 --------------*/
    // 多媒体文件下载
    'CGI_MEDIA' => 'http://file.api.weixin.qq.com/cgi-bin/media/get?access_token={{TOKEN}}&media_id={{MEDIA_ID}}',

    // 模板消息
    'CGI_MESSAGE' => 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token={{TOKEN}}',
    // 企业号发送消息
    'CGI_CORP_MESSAGE' =>'https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token={{TOKEN}}',
    // 带参数的二维码
    'SNS_QRCODE_URL' => "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={{TOKEN}}",
    'SNS_SHOW_QRCODE_URL' => "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket={{TICKET}}",
    'SNS_TAG_URL' => "https://api.weixin.qq.com/cgi-bin/tags/get?access_token={{TOKEN}}",
    'SNS_SET_TAG_URL' => "https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token={{TOKEN}}",
);