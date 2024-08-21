<?php

final class UserController extends BaseController
{

    public function index()
    {
        $modelObj = FactoryModel::getInstance("UserModel");// 获取用户模型实例
        $arrs = $modelObj->fetchAll(); // 获取所有记录
        $count = $modelObj->rowCount();
        // 包含用户首页视图
        include VIEW_PATH."Index.html";
    }

    public function detail(){
        $id=$_GET["id"];// 获取要编辑的用户id
        $modelObj = FactoryModel::getInstance("UserModel");// 获取用户模型实例并获取指定id的用户数据
        $arr=$modelObj->fetchOne($id);
//        print_r($arr);
//        die();
        include VIEW_PATH."detail.html";  // 加载用户编辑视图页面
    }

}
//$ac=isset($_GET["ac"])?$_GET["ac"]:"index"; // 获取请求参数ac，如果未设置则默认为index
//$contorllerObj= new UserController();// 创建用户控制器实例
//$contorllerObj->$ac();// 根据请求参数调用对应的方法






//if ($ac=="delete"){
//$contorllerObj->delete(); // 调用删除方法
//}else if($ac=="add"){
//    $contorllerObj->add(); // 调用添加方法
//}else if($ac=="insert"){
//    $contorllerObj->insert(); // 调用插入方法
//} else {
//    $contorllerObj->index(); // 默认调用首页方法
//}
