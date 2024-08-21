<?php

class NewsModel extends BaseModel{

    // 获取所有新闻记录
    public function fetchAll(){
        $sql="select * from news order by nid;";
        return $this->db->fetchAll($sql);
    }
    // 删除指定id的新闻记录
public function delete($id)
{
    $sql = "delete from news where nid={$id}";
    return $this->db->exec($sql);
}
    public function insert($data){// 插入新闻记录
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
        $sql="insert into news($fields) values($values)";// 构建插入数据的SQL语句
//        echo $sql;
//        die();
        return $this->db->exec($sql);// 执行SQL语句并返回执行结果
    }
    public function fetchOne($id){
        // 构建查询指定id新闻的SQL语句
        $sql="select * from news where nid={$id}";
        return $this->db->fetchOne($sql);// 执行查询并返回结果
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
        $sql="update news set {$str} where nid={$id}";// 构建更新新闻数据的SQL语句
//        echo $sql;
//        die();
        // 执行更新操作并返回结果
        return $this->db->exec($sql);
    }
    public  function  rowCount(){
        $sql="select * from news order by nid";
        return $this->db->rowCount($sql);
    }
}