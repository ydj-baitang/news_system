<?php
header("Content-Type:text/html;charset=utf8");

// 连接到 MySQL 数据库服务器
$conn = mysqli_connect('127.0.0.1', 'root', 'password', '', '3306');    // 注意修改数据库连接参数                      

// 检查连接是否成功
if (!$conn) {
    die("连接错误: " . mysqli_connect_errno() . "<br />错误信息: " . mysqli_connect_error());
}

// 创建数据库 newsweb
$sql = "CREATE DATABASE IF NOT EXISTS newsweb DEFAULT CHARSET=utf8;";
if (mysqli_query($conn, $sql)) {
    echo "数据库 newsweb 创建成功<br />";
} else {
    echo "数据库 newsweb 创建失败<br />";
}

// 选择数据库
mysqli_select_db($conn, 'newsweb');

// 创建表 news
$sql = "CREATE TABLE IF NOT EXISTS news (
    nid INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    title VARCHAR(200) NOT NULL,
    content TEXT,
    release_time DATETIME,
    editor VARCHAR(30) NOT NULL
) DEFAULT CHARSET=utf8;";

if (mysqli_query($conn, $sql)) {
    echo "数据表 news 创建成功<br />";
} else {
    echo "数据表 news 创建失败<br />";
}

// 创建表 users
$sql = "CREATE TABLE IF NOT EXISTS users (
    uid INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    uname VARCHAR(50) NOT NULL UNIQUE,
    upass VARCHAR(255) NOT NULL,
    is_admin TINYINT(1) NOT NULL DEFAULT 0
) DEFAULT CHARSET=utf8;";

if (mysqli_query($conn, $sql)) {
    echo "数据表 users 创建成功<br />";
} else {
    echo "数据表 users 创建失败<br />";
}

// 插入一条数据到 users 表
$uname = 'admin';
$upass = md5('password');  // 将密码进行 MD5 加密
$is_admin = 1;

$sql = "INSERT INTO users (uname, upass, is_admin) VALUES ('$uname', '$upass', $is_admin);";

if (mysqli_query($conn, $sql)) {
    echo "用户 $uname 插入成功<br />";
} else {
    echo "用户 $uname 插入失败: " . mysqli_error($conn) . "<br />";
}

// 关闭数据库连接
mysqli_close($conn);
?>