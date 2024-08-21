<?php
class LoginController extends BaseController{
    public function index(){
        include VIEW_PATH."index.html";//加载名为 index.html 的视图文件
    }

    public function check(){
        $modelObj=FactoryModel::getInstance("LoginModel");
        $data["uname"]=$_POST["uname"];
        $data["upass"]=md5($_POST["upass"]);
        $result=$modelObj->check($data);
        $useryzm = strtoupper($_POST['useryzm']);//通过使用 strtolower() 函数将用户输入的验证码和生成的验证码都转换为小写
        $yzmchar = strtoupper($_SESSION['yzm']);
//        echo $yzmchar;
//        echo $useryzm;

    if ($useryzm != $yzmchar) {
        // 验证码错误，重定向回登录页面
        $this->jump("验证码错误. 请重新输入! ", 3, "?p=Admin&c=Login");
        // 结束脚本的执行
        return;
    } else {
        // 验证码正确，销毁验证码
        unset($_SESSION["yzm"]);
    
        if (isset($result)) {
         // 用户验证成功，设置会话变量
        $_SESSION["uname"] = $result["uname"];
        $_SESSION["is_admin"] = $result["is_admin"];

        // 根据用户是否是管理员决定跳转页面
        if ($_SESSION["is_admin"] == 0) {
            // 非管理员用户重定向到首页的新闻页面
            $this->jump("登陆成功. 正在跳转! ", 3, "?p=Home&c=News");
        } else {
            // 管理员用户重定向到管理员的新闻页面
            $this->jump("登陆成功. 正在跳转! ", 3, "?p=Admin&c=News");
        }
    } else {
        // 用户名或密码错误，重定向回登录页面
        $this->jump("用户名或密码错误. 请重新登录! ", 3, "?p=Admin&c=Login");
    }
}
    }
    //在 LoginController 类中定义的 logout 方法。它的作用是注销用户的登录状态，并对用户进行提示后进行页面跳转
    public function logout(){
        unset($_SESSION["uname"]);
        unset($_SESSION["is_admin"]);
        $this->jump("用户已退出! ",3,"?p=Admin&c=Login");
    }
}



