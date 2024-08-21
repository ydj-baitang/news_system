<?php

class UserModel extends BaseModel{
    // 获取所有用户记录
    public function fetchAll(){
        $sql="select * from users order by uid;";

        return $this->db->fetchAll($sql);
    }
    // 删除指定id的用户记录
    public function delete($id)
    {
        $sql = "delete from users where uid={$id}";
        return $this->db->exec($sql);
    }
    public function insert($data){
        $fields="";
        $values="";
        foreach ($data as $key=>$value){
            $fields.="{$key},";// 构建字段列表
            $values.="'{$value}',";// 构建数值列表

        }
        $fields=rtrim($fields,",");// 移除字段列表和数值列表末尾多余的逗号
        $values=rtrim($values,",");// 移除字段列表和数值列表末尾多余的逗号
//        echo $fields;
//        echo $values;
//        die();
        $sql="insert into users($fields) values($values)"; // 构建插入数据的SQL语句
//        echo $sql;
//        die();
        return $this->db->exec($sql);// 执行SQL语句并返回执行结果
    }
    public function fetchOne($id){
    $sql="select * from users where uid={$id}"; // 构建查询指定id新闻的SQL语句
    return $this->db->fetchOne($sql);// 执行SQL语句并返回执行结果
    }
    public function update($id,$data){
        $str="";
        // 遍历新闻数据，构建更新字段的字符串
        foreach ($data as $key=>$value){
            $str.="{$key}='{$value}',";
        }
        $str=rtrim($str,",");
//        echo $str;
//        die();
        $sql="update users set {$str} where uid={$id}";// 构建更新新闻数据的SQL语句
//        echo $sql;
//        die();
        return $this->db->exec($sql);// 执行SQL语句并返回执行结果
    }
    public  function  rowCount(){
        $sql="select * from users order by uid";
        return $this->db->rowCount($sql);
    }
}
