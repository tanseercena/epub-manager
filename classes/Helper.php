<?php 

use PhpInflector\Inflector;

class Helper {

    public static function pluralize($str){
        return Inflector::pluralize($str);
    }

    public static function snake($str){
        return Inflector::underscore($str);
    }
}