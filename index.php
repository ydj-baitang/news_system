<?php
// 启动会话管理
session_start();
// 设置响应的 Content-Type 为 text/html，并将字符集设置为 UTF-8
header("Content-Type:text/html;charset=utf8");

// 导入Frame.class.php类文件
require_once("./Frame/Frame.class.php");

// 运行Frame类的run方法
Frame::run();
?>