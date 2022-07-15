<?php
namespace Fratello\Henrietta\Router;
/*
* HTTP ACCESS METHOD SETTING
*/

class Method{
    public static function post($routing, $function){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $router = new Turnout($routing);
            $result = $router->RouterCore();
            if($result){
                return [$this->RouteVariable(), $function];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function get($routing, $function){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $router = new Turnout($routing);
            $result = $router->RouterCore();
            if($result){
                return [$this->RouteVariable(), $function];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function put($routing, $function){
        if($_SERVER["REQEST_METHOD"] == "PUT"){
            $router = new Turnout($routing);
            $result = $router->RouterCore();
            if($result){
                return [$this->RouteVariable(), $function];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function delete($routing, $function){
        if($_SERVER["REQUEST_METHOD"] == "DELETE"){
            $router = new Turnout($routing);
            $result = $router->RouterCore();
            if($result){
                return [$this->RouteVariable(), $function];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function all($routing, $function){
        $router = new Turnout($routing);
        $result = $router->RouterCore();
        if($result){
            return [$this->RouteVariable(), $function];
        }else{
            return false;
        }
    }
}