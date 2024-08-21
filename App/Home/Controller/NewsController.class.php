<?php
final class NewsController extends BaseController{

    public function index(){
        $modelObj = FactoryModel::getInstance("NewsModel");// 获取新闻模型实例
        $arrs = $modelObj->fetchAll();// 获取所有记录

        $count=$modelObj->rowCount();

        include VIEW_PATH."index.html";// 包含新闻首页视图
    }

    public function detail(){
        $id=$_GET["id"];// 获取要编辑的新闻id
        $modelObj = FactoryModel::getInstance("NewsModel");
        $arr=$modelObj->fetchOne($id);

        include VIEW_PATH."detail.html"; // 加载新闻编辑视图页面
    }

}

//$ac=isset($_GET["ac"])?$_GET["ac"]:"index"; // 获取请求参数ac，如果未设置则默认为index
//$contorllerObj= new NewsController();// 创建新闻控制器实例
//$contorllerObj->$ac();// 根据请求参数调用对应的方法



