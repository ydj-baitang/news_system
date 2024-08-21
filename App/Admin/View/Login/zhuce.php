<?php
// 定义配置文件路径常量
define("CONFIG_PATH", __DIR__ . '/../../../Conf/Config.php');

// 引入配置文件
require_once CONFIG_PATH;

// 获取配置信息
$config = require CONFIG_PATH;

// 数据库连接配置
$servername = $config['db_host'];
$username = $config['db_user'];
$password = $config['db_pass'];
$dbname = $config['db_name'];

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 处理表单提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['uname'];
    $upass = md5($_POST['upass']); // 使用哈希加密密码
    $is_admin = 0; // 默认非管理员

    // 检查用户名是否已存在
    $checkSql = "SELECT * FROM users WHERE uname = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("s", $uname);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // 用户名已存在，提示用户
        echo '<script type="text/javascript">alert("用户名已存在，请选择其他用户名。");</script>';
    } else {
        // 插入用户信息到数据库
        $sql = "INSERT INTO users (uname, upass, is_admin) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $uname, $upass, $is_admin);

        if ($stmt->execute()) {
            // 注册成功，使用 JavaScript 弹窗提示
            echo '<script type="text/javascript">alert("注册成功，请点击返回登录按钮返回登录页面。");</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    }

    $checkStmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: linear-gradient(to right, #fbc2eb, #a6c1ee);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            width: 300px;
        }
        .header {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .input-item {
            display: block;
            width: 100%;
            margin-bottom: 20px;
            border: none;
            border-bottom: 2px solid #ddd;
            padding: 10px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s;
        }
        .input-item:focus {
            border-bottom-color: #a6c1ee;
        }
        .input-item::placeholder {
            color: #aaa;
        }
        .btn, .back-link {
            display: block;
            text-align: center;
            padding: 12px;
            width: 100%;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn {
            background-image: linear-gradient(to right, #a6c1ee, #fbc2eb);
            color: #fff;
        }
        .btn:hover {
            background-position: right;
        }
        .back-link {
            background-color: #ddd;
            color: #333;
            text-decoration: none;
        }
        .back-link:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">Register</div>
    <form method="post" action="">
        <input type="text" name="uname" placeholder="请输入用户名" class="input-item" required>
        <input type="password" name="upass" placeholder="请输入密码" class="input-item" required>
        <input type="submit" value="注册" class="btn">
    </form>
    <a href="javascript:history.go(-2)" class="back-link">返回登录</a>
</div>

</body>
</html>
