<?php
namespace Fratello\Henrietta\boot;

use Dotenv;

class SettingSolver{
    public function read_env(string $path){
        Dotenv::createImmutable($path)->load();
    }
}