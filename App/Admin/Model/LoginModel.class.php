<?php
class LoginModel extends BaseModel{
    /**
     * 检查用户登录信息
     * @param array $data 用户登录信息数组
     * @return array|null 查询结果数组，如果查询失败返回null
     */
    public function check($data){
        $str="";
        foreach ($data as $key=>$value){
            $str.="{$key}='{$value}' and ";
        }
        $str=rtrim($str," and ");// 移除字段列表和数值列表末尾多余的逗号
        $sql="select * from users where {$str}";
//        echo $sql;
//        die();
        return $this->db->fetchOne($sql);// 执行查询并返回结果
    }
}
