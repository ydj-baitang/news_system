<?php
// 定义抽象基类 BaseController
abstract class BaseController{
    // 定义 jump 方法，用于页面跳转
    public function jump($message, $second=3, $url="?"){
        // 输出提示信息
        echo "<h2>$message</h2>";
        // 设置页面定时刷新
        header("refresh:{$second},url={$url}");
        // 终止程序执行
        die();
    }
}