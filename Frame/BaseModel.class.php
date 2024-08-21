<?php
abstract class BaseModel{
    protected $db=null;
    public function __construct(){
    $this->db=Db::getInstance();
    }
}