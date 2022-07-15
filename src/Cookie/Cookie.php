<?php
namespace Fratello\Henrietta\Cookie;

class Cookie{
    private static $options = [];

    public static function Insert(string $Key, $Val)
    {
        $option = '';
        foreach(self::$options as $key => $value){
            if(gettype($value) === 'boolean' && $value){
                $option .= $value.';';
            }else{
                $option .= $key.'='.$value.';';
            }
        }
        header('Set-Cookie: '.$Key.'='.$Val.';'.$option);
    }

    public static function Get(string $Key)
    {
        if(array_key_exists($Key, $_COOKIE)){
            return $_COOKIE[$Key];
        }
    }

    public static function Delete(string $Key){
        header('Set-Cookie: '.$Key.'=DelFlag;Max-Age=-114514;');
    }

    public static function SetOptions(array $Option = array())
    {
        foreach($Option as $Key => $Opt){
            if($Key === 'Expires' || $Key === 'Max-Age' || $Key === 'Domain' || $Key === 'Path'){
                self::$options[$Key] = $Opt;
            }else if($Key === 'Secure' || $Key === 'HttpOnly'){
                if(gettype($Opt) === 'boolean'){
                    self::$options[$Key] = $Opt;
                }
            }else if($Key === 'Samesite'){
                if($Opt === 'Strict' || $Opt === 'Lax' || $Opt === 'None'){
                    self::$options[$Key] = $Opt;
                }
            }
        }
        return false;
    }
}