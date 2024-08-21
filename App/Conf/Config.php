<?php
$arr=array(
    //数据库配置信息
    "db_host"=>"127.0.0.1",
    "db_user"=>"root",
    "db_pass"=>"password", //请修改为自己的数据库密码
    "db_name"=>"newsweb",
    "charset"=>"utf8",

    //默认路由参数
    "default_platform" => "Admin",
    "default_controller" => "News",
    "default_action" => "index",

);
return $arr;