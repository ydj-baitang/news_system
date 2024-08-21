<?php
final class NewsController extends BaseController{
    public function delete(){
        // 检查是否为管理员
        if($_SESSION["is_admin"]==1) {
            // 获取要删除的记录id
            $id = $_GET["id"];
            $modelObj = FactoryModel::getInstance("NewsModel");// 获取新闻模型实例
            // 调用模型类的删除方法
            if ($modelObj->delete($id)) {
                // 如果删除成功，则跳转并显示成功信息
                $this->jump("删除id={$id}记录成功！", 3, "?p=Admin&c=News");
            } else {
                // 如果删除失败，则跳转并显示失败信息
                $this->jump("删除id={$id}记录失败！", 3, "?p=Admin&c=News");
            }
        }else{
            // 非管理员权限提示，跳转到登录页面
            $this->jump("没有权限,请重新登录！", 3, "?p=Admin&c=Login");
        }
    }
    public function index(){
        // 检查是否为管理员
        if($_SESSION["is_admin"]==='1'){
            $modelObj = FactoryModel::getInstance("NewsModel");// 获取新闻模型实例
            $arrs = $modelObj->fetchAll();// 获取所有记录
            $count = $modelObj->rowCount();
            include VIEW_PATH . "index.html";// 包含新闻首页视图
        }else{
            // 非管理员权限提示，跳转到登录页面
            $this->jump("没有权限,请重新登录！", 3, "?p=Admin&c=Login");
        }
    }
    public function add(){
        // 检查是否为管理员
        if($_SESSION["is_admin"]==1) {
            // 加载新闻添加视图页面
            include VIEW_PATH . "add.html";
        }else{
            // 非管理员权限提示，跳转到登录页面
            $this->jump("没有权限,请重新登录！", 3, "?p=Admin&c=Login");
        }
    }
    public function insert(){
        // 检查是否为管理员
        if($_SESSION["is_admin"]==1) {
            $data["title"] = $_POST["title"];
            $data["content"] = $_POST["content"];
            $data["editor"] = $_POST["editor"];
            $data["release_time"] = date("Y-m-d H:i:s");
            $modelObj = FactoryModel::getInstance("NewsModel");// 获取新闻模型实例
            if ($modelObj->insert($data)) {
                // 插入新闻数据是否成功并跳转回主页面
                $this->jump("添加新闻成功", 3, "?p=Admin&c=News");
            } else {
                $this->jump("添加新闻失败", 3, "?p=Admin&c=News");
            }
        }else{
            // 非管理员权限提示，跳转到登录页面
            $this->jump("没有权限,请重新登录！", 3, "?p=Admin&c=Login");
        }
    }
    public function edit()
    {
        if ($_SESSION["is_admin"] == 1) {
            $id = $_GET["id"];// 获取要编辑的新闻id
            $modelObj = FactoryModel::getInstance("NewsModel");
            $arr = $modelObj->fetchOne($id);
            include VIEW_PATH . "edit.html"; // 加载新闻编辑视图页面
        }else{
            // 非管理员权限提示，跳转到登录页面
            $this->jump("没有权限,请重新登录！", 3, "?p=Admin&c=Login");
        }
    }
    public function update(){
        // 检查是否为管理员
        if ($_SESSION["is_admin"] == 1) {
            $id = $_POST["nid"]; // 获取要更新的新闻id
            $data["title"] = $_POST["title"]; // 获取更新的新闻标题
            $data["content"] = $_POST["content"]; // 获取更新的新闻内容
            $data["editor"] = $_POST["editor"]; // 获取新闻编辑者

            // 获取 NewsModel 模型实例并更新新闻数据
            $modelObj = FactoryModel::getInstance("NewsModel");
            if ($modelObj->update($id, $data)) {
                // 更新成功时跳转到新闻管理页面
                $this->jump("修改新闻成功", 3, "?p=Admin&c=News");
            } else {
                // 更新失败时跳转到新闻管理页面
                $this->jump("修改新闻失败", 3, "?p=Admin&c=News");
            }
        } else {
            // 非管理员权限提示，跳转到登录页面
            $this->jump("没有权限,请重新登录！", 3, "?p=Admin&c=Login");
        }
    }
}




