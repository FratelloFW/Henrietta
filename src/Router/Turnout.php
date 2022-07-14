<?php
namespace Henrietta\Router;
/*
* Main routing system
*/

class Turnout{
    private $accessed_url = [];
    private $user_url = [];
    private $url_params = [];

    public function __construct(
        string $user_url
    ){
        $this->accessed_url = $this->Mining();
        $user_url = explode('/', trim(trim($user_url), '/'));
        if(count($user_url) === 1 && $user_url[0] === ""){
            $user_url = array();
        }
        $this->user_url = $user_url;
    }

    private function Mining(): array {
        $accessed_url = explode('/', trim(substr($_SERVER['REQUEST_URI'], 0, strcspn($_SERVER['REQUEST_URI'],'?')), '/'));
        $trim_from_url = explode('/', trim(pathinfo($_SERVER['SCRIPT_NAME'])['dirname'], '/'));
        foreach($trim_from_url as $number => $access){
            if($accessed_url[$number] === $access){
                unset($accessed_url[$number]);

            }
        }
        $accessed_url = array_values($accessed_url);
        return $accessed_url;
    }

    public function RouteVariable(){
        return $this->url_params;
    }

    public function RouterCore(){
        $flag = true;
        foreach($this->user_url as $url_number => $url_values){
            if(array_key_exists($url_number, $this->accessed_url)){
                if(mb_substr(trim($url_values), 0, 1) === ':' || mb_substr(trim($url_values), 0, 1) === '?'){
                    $key = ltrim($url_values, mb_substr(trim($url_values), 0, 1) === '?' ? '?' : ':');
                    $value = $this->accessed_url[$url_number];
                    $this->url_params[$key] = urldecode($value);
                }else if($this->accessed_url[$url_number] === $url_values){
                    $flag = true;
                }else{
                    $flag = false;
                }
            }else if(mb_substr(trim($url_values), 0, 1) === '?'){
                $flag = true;
            }else{
                return false;
            }
        }
        return $flag;
    }
}