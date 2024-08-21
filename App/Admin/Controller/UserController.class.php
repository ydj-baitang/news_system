<?php
final class UserController extends BaseController{
    public function delete(){
        // 检查是否为管理员
        if($_SESSION["is_admin"]==1) {
            $id = $_GET["id"]; // 获取要删除的记录id
            $modelObj = FactoryModel::getInstance("UserModel");// 获取用户模型实例
            if ($modelObj->delete($id)) {
                $this->jump("删除id={$id}记录成功！", 3, "?p=Admin&c=User");// 如果删除成功，则跳转并显示成功信息
            } else {
                $this->jump("删除id={$id}记录失败！", 3, "?p=Admin&c=User");// 如果删除失败，则跳转并显示失败信息
            }
        }else{
            // 非管理员权限提示，跳转到登录页面
            $this->jump("没有权限,请重新登录！", 3, "?p=Admin&c=Login");
        }
    }
    public function index(){
        // 检查是否为管理员
        if ($_SESSION["is_admin"] === '1') {
            $modelObj = FactoryModel::getInstance("UserModel");// 获取用户模型实例
            $arrs = $modelObj->fetchAll(); // 获取所有记录
            $count = $modelObj->rowCount();
            // 包含用户首页视图
            include VIEW_PATH . "Index.html";
        }else{
            // 非管理员权限提示，跳转到登录页面
            $this->jump("没有权限,请重新登录！", 3, "?p=Admin&c=Login");
        }
    }
    public function add(){
        // 包含添加用户视图
        include VIEW_PATH."Add.html";
    }
    public function insert(){
        // 检查是否为管理员
        if ($_SESSION["is_admin"] === '1') {
            // 获取表单数据
            $data["uname"] = $_POST["uname"];
            $data["is_admin"] = $_POST["is_admin"];
            $data["upass"] = md5($_POST["upass"]);
//            $data["upass"] = password_hash($_POST["upass"], PASSWORD_BCRYPT); // 对密码进行加密处理并截取前30个字符
            // 获取用户模型实例
            $modelObj = FactoryModel::getInstance("UserModel");
            // 插入数据是否成功并跳转会主页面
            if ($modelObj->insert($data)) {
                $this->jump("添加用户成功", 3, "?p=Admin&c=User");
            } else {
                $this->jump("添加用户失败", 3, "?p=Admin&c=User");
            }
        }else{
            // 非管理员权限提示，跳转到登录页面
            $this->jump("没有权限,请重新登录！", 3, "?p=Admin&c=Login");
        }
    }
    public function edit(){
        // 检查是否为管理员
        if ($_SESSION["is_admin"] == 1) {
            $id = $_GET["id"];// 获取要编辑的用户id
            $modelObj = FactoryModel::getInstance("UserModel");// 获取用户模型实例并获取指定id的用户数据
            $arr = $modelObj->fetchOne($id);
            include VIEW_PATH . "Edit.html";  // 加载用户编辑视图页面
        }else{
            // 非管理员权限提示，跳转到登录页面
            $this->jump("没有权限,请重新登录！", 3, "?p=Admin&c=Login");
        }
    }
    public function update(){
        // 检查是否为管理员
        if ($_SESSION["is_admin"] == 1) {
            // 获取要更新的用户id和更新的用户数据
            $id = $_POST["uid"];
            $data["uname"] = $_POST["uname"];// 获取用户
            $data["is_admin"] = $_POST["is_admin"];// 获取用户要修改的权限
            // 如果密码有修改，则进行加密处理
            if ($_POST["old_upass"] != $_POST["upass"]) {// 获取密码
                $data["upass"] = md5($_POST["upass"]);
            }
            // 获取用户模型实例并更新用户数据
            $modelObj = FactoryModel::getInstance("UserModel");
            if ($modelObj->update($id, $data)) {
                // 更新失败时跳转到用户管理页面
                $this->jump("修改用户成功", 3, "?p=Admin&c=User");
            } else {
                // 更新失败时跳转到用户管理页面
                $this->jump("修改用户失败", 3, "?p=Admin&c=User");
            }
        }else{
            // 非管理员权限提示，跳转到登录页面
            $this->jump("没有权限,请重新登录！", 3, "?p=Admin&c=Login");
        }
    }
}

