#!/bin/bash

# 定义 PHP 文件路径
PHP_FILE="create_newsweb.php"

# 检查 PHP 文件是否存在
if [ ! -f "$PHP_FILE" ]; then
    echo "错误: PHP 文件 $PHP_FILE 不存在"
    exit 1
fi

# 运行 PHP 文件
php "$PHP_FILE"

# 检查 PHP 文件执行结果
if [ $? -eq 0 ]; then
    echo "PHP 脚本 $PHP_FILE 执行成功"
else
    echo "PHP 脚本 $PHP_FILE 执行失败"
    exit 1
fi