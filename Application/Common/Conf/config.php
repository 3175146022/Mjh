<?php
return array(
    /* 数据库设置 */
    'DB_TYPE'                => 'mysql', // 数据库类型
    'DB_HOST'                => '127.0.0.1', // 服务器地址
    'DB_NAME'                => 'mjh', // 数据库名
    'DB_USER'                => 'root', // 用户名
    'DB_PWD'                 => 'root', // 密码
    'DB_PORT'                => '3306', // 端口
    'DB_PREFIX'              => '', // 数据库表前缀
    /* 页面样式路径 */
    'TMPL_PARSE_STRING' => array(
        '__STYLE__' => __ROOT__. '/Public/Admin/',
        '__HOME__' => __ROOT__.'/Public/Home/',
    ),
    'WX_OPENID'         => 'wxbad65c144dae20cf', // 微信公众open_id
    'WX_SECRET'         => '127.0.0.1' // 微信公众密匙
);