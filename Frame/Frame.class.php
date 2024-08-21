<?php
//定义一个Frame的类
final class Frame{
    //静态方法定义run
    public static function run(){
        //初始化配置信息
        self::initConfig();
        //初始化路由参数
        self::initRoute();
        //初始化目录常量
        self::initConst();
        //初始化类的自动加载
        self::initAutoload();
        //初始化请求分发
        self::initDispatch();
    }
    private static function initConfig(){
        $GLOBALS["config"]=require_once("./App/Conf/Config.php");

    }
    //初始化路由参数
    private static function initRoute(){
        //定义一个平台参数
        $p=isset($_GET["p"])?$_GET["p"]:$GLOBALS['config']["default_platform"];
        $c=isset($_GET["c"])?$_GET["c"]:$GLOBALS['config']["default_controller"];//通过传参获取一个路由参数
        $a=isset($_GET["a"])?$_GET["a"]:$GLOBALS['config']["default_action"];
        //定义一个常量来存放平台的值
        define("PLAT",$p);
        define("CONTROLLER",$c);
        define("ACTION",$a);
    }
    //初始化目录常量
    private static function initConst(){
        define("DS",DIRECTORY_SEPARATOR);
//定义一个根目录
        define("ROOT_PATH",getcwd().DS);
//定义一个常量
        define("FRAME_PATH",ROOT_PATH."Frame".DS);
        define("MODEL_PATH",ROOT_PATH."App".DS.PLAT.DS."Model".DS); //定义常量MODEL_PATH
        define("CONTROLLER_PATH",ROOT_PATH."App".DS.PLAT.DS."Controller".DS);//定义常量CONTROLLER_PATH
        define("VIEW_PATH",ROOT_PATH."App".DS.PLAT.DS."View".DS.CONTROLLER.DS);//定义常量视图
    }

    //初始化类的自动加载
      private static function initAutoload(){
          spl_autoload_register(function ($className){
    //定义$arr的数组来进行类的拼接
              $arr=array(
        //替换类名
        FRAME_PATH.$className.".class.php",
        MODEL_PATH.$className.".class.php",
        CONTROLLER_PATH.$className.".class.php",
    );
    //从上面定义的数组中取值，并保存到$filename
    foreach ($arr as $filename){
        //判断filename文件是否存在
        if(file_exists($filename)){
            require_once ($filename);  //如果存在则用require_once包含在内
        }
    }
}
);
      }
    //初始化请求分发
    private  static function initDispatch(){
        //实例化对象
$controllerClassName=CONTROLLER."Controller";
//创建实例
$controllerObj=new $controllerClassName();
$action_name=ACTION;
$controllerObj->$action_name();   //直接调用控制器对象define("ROOT_PATH",getcwd().DS);

    }
}