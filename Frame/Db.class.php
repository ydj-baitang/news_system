<?php
//class Db{
//    private $db_host;
//    private $db_user;
//    private $db_pass;
//    private $db_name;
////    private $db_post;
//    private $charset;
//    private $conn;
//
//    private static $obj=null;
//    private function __construct($config=array())
//    {
//        $this->db_host=$config["db_host"];
//        $this->db_user=$config["db_user"];
//        $this->db_pass=$config["db_pass"];
//        $this->db_name=$config["db_name"];
//        $this->charset=$config["charset"];
////        $this->db_post=$config["db_post"];
//        $this->connectDb();
//        $this->selectDb();
//        $this->setCharset();
//    }
//
//    private function __clone(){
//
//    }
//    public function __destruct()
//    {
//       mysqli_close($this->conn);
//    }
//    private function connectDb(){
//        if(!$this->conn=@mysqli_connect($this->db_host,$this->db_user,$this->db_pass)){
//            echo "连接数据库失败";
//            die();
//        }
//    }
//    private function selectDb(){
//        if(!mysqli_select_db($this->conn,$this->db_name)){
//            echo "选择数据库失败";
//            die();
//        }
//    }
//    private function setCharset(){
//        mysqli_set_charset($this->conn,$this->charset);
//    }
//    public static function getInstance($config=array()){
//        if(!self::$obj instanceof self){
//            self::$obj=new self($config);
//        }
//        return self::$obj;
//    }
//    //执行成功返回ture，执行失败返回false，增，删，改
//    private function query($sql){
//        $sql=strtolower($sql);
//        if(substr($sql,0,6)!="select"){
//            echo "不能执行select语句!";
//            die();
//        }
//        return mysqli_query($this->conn,$sql);
//    }
//    public  function fetchOne($sql){
//        $result=$this->query($sql);
//        return mysqli_fetch_array($result,MYSQLI_ASSOC);
//    }
////    获取多条数据
//    public function fetchAll($sql){
//        $result=$this->query($sql);
//        return mysqli_fetch_all($result,MYSQLI_ASSOC);
//
//    }
////    获取所有有的记录数
//    public function rowCount($sql){
//        $result=$this->query($sql);
//        return mysqli_num_rows($result);
//    }
//}

class Db
{
    private $db_host;
    private $db_user;
    private $db_pass;
    private $db_name;
    private $charset;
    private $conn;
    // 私有的静态属性
    private static $obj = null;

    // 私有的构造方法
    private function __construct()
    {
        // 从全局配置文件中获取数据库配置信息
        $this->db_host = $GLOBALS["config"]['db_host']; // 数据库主机地址
        $this->db_user = $GLOBALS["config"]["db_user"]; // 数据库用户名
        $this->db_pass = $GLOBALS["config"]["db_pass"]; // 数据库密码
        $this->db_name = $GLOBALS["config"]["db_name"]; // 数据库名称
        $this->charset = $GLOBALS["config"]["charset"]; // 数据库字符集

        // 连接数据库
        $this->connectDb();

        // 选择数据库
        $this->selectDb();

        // 设置字符集
        $this->setCharset();
    }

    // 私有的克隆方法
    private function __clone()
    {
        // 克隆方法
    }

    public function __destruct()
    {
        mysqli_close($this->conn);
    }

    private function connectDb()
    {
        //加@符号在报错时，不返回报错信息。
        if (!$this->conn = @mysqli_connect($this->db_host, $this->db_user, $this->db_pass)) {
            echo "连接数据库失败！";
            die();
        }
    }

    private function selectDb()
    {
        if (!mysqli_select_db($this->conn, $this->db_name)) {
            echo "选择数据库失败！";
            die();
        }
    }

    public function setCharset()
    {
        mysqli_set_charset($this->conn, $this->charset);
    }

    // 实现一个类只有一个对象
    public static function getInstance()
    {
        if (!self::$obj instanceof self) {
            self::$obj = new self();
        }
        return self::$obj;
    }

    // 执行成功返回true,执行失败返回false.增，删，改
    function exec($sql)
    {
        $sql = strtolower($sql);
        if (substr($sql, 0, 6) == "select") {
            echo "不能执行select语句！";
            die();
        }
        return mysqli_query($this->conn, $sql);
    }

    // 执行成功返回结果集,执行失败返回false

    private function query($sql)
    {
        $sql = strtolower($sql);
        if (substr($sql, 0, 6) != "select") {
            echo "不能执行非select语句！";
            die();
        }
        return mysqli_query($this->conn, $sql);
    }

    // 获得单条记录
    public function fetchOne($sql)
    {
        $result = $this->query($sql);
        return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    //获取多条数据
    public function fetchAll($sql)
    {
        $result = $this->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //获取所有的记录数
    public function rowCount($sql)
    {
        $result = $this->query($sql);
        return mysqli_num_rows($result);
    }

}
// $st1 = new kmyzstudent();
// $st1 -> display();