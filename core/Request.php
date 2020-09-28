<?php
namespace app\core;
class Request 
{
    public function getMethod(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getPath(){
        $path=$_SERVER["REQUEST_URI"]??'/';
        $position=stripos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
        
    }
}
