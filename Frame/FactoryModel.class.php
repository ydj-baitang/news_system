<?php
final class FactoryModel{
    public static function getInstance($modelClassName){
    return new $modelClassName();
    }
}
