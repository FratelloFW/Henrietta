<?php
namespace Henrietta\Session;

use Henrietta\Tools\UUID;
use Dotenv\Dotenv;

class Session{
    public static function Start(string $dumper = 'RDB'){
        if($dumper === 'RDB'){
            //TODO
        }elseif($dumper === 'Redis'){
            //TODO
        }else{
            //TODO
        }
    }

    public static function Get(){
        
    }

    public static function Insert(){
        
    }

    public static function Delete(){

    }

    public static function Read(){

    }

    public static function IsIn(){

    }

    public static function YetStart(){

    }
}