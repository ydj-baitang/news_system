##代码简介
个人在学习生活中练习搭建的新闻管理系统，代码主要实现了用户进行注册、登录、管理新闻的发布、用户权限管理等功能。代码比较简单，但是适合小白练手。此代码是依据读书期间实训要求来写的。

##windows下部署环境（或者用phpstudy进行部署也可以）
1.前提：有能运行php、html、js、css编程工具，还有一个数据库。

2.直接克隆到本地git clone https://github.com/ydj-baitang/news_system.git

3.修改文件create_newsweb.php文件中的数据库连接信息(其他不用改)，执行create_email.php文件，即可创建数据库表和所需的初始数据。                        



4.需要修改/App/Conf/Config.php文件中的数据库连接信息，运行index.php文件，即可看到登陆界面。


5.默认管理用户名：admin  密码：password

****重点****

6.通过注册登陆的用户都是普通用户，没有管理员权限。（通过默认管理员用户登陆，才可以修改其他用户的权限）

https://github.com/ydj-baitang/news_system/blob/main/Uploads/%E5%B1%8F%E5%B9%95%E6%88%AA%E5%9B%BE%202024-08-21%20222440.png

如果想在Ubuntu部署这个项目也是可以的（此项目也可以在liunx、mac系统下部署）

##需要安装apache2、php、mysql

1.安装apache2

sudo apt-get install apache2

2.安装php

sudo apt-get install php php-mysql php-curl php-gd php-mbstring php-xml php-xmlrpc php-soap php-intl php-zip libapache2-mod-php

3.安装mysql

sudo apt-get install mysql-server

4.进入数据库，设置mysql密码

ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '密码';


5.将此项目项目克隆到/var/www/html目录下

git clone https://github.com/ydj-baitang/news_system.git


sudo mv news_system /var/www/html/news

6.创建所需的数据库

修改create_newsweb.php文件中的数据库连接信息。

cd /var/www/html/news/

保存退出后运行脚本create_newsweb.sh，既可以实现数据库表的创建，和所需数据库的创建。

suod chmod +x create_newsweb.sh       

./create_newsweb.sh

7.需要修改/App/Conf/Config.php文件中的数据库连接信息

6.浏览器访问http://localhost/email即可看到登陆界面

默认管理员用户名：admin  密码：password

****重点****

通过注册登陆的用户都是普通用户，没有管理员权限。（通过默认管理员用户登陆，才可以修改其他用户的权限）

到此，部署完成。
