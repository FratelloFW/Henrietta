<?php
namespace Fratello\Henrietta\boot;

class MixBoot{
    private $path;

    public function __construct(string $path){
        $this->path = $path;

        $this->boot();

    }

    public function boot(){
        $this->load_http();

        $route_match = $this->load_routing();
        if($route_match){
            $this->laod_middleware();
            $this->controller();
            $this->model();
            $this->load_processor();

            $this->exec_farewell();
        }else{
            echo '404 NOT FOUND';
        }

    }

    private function load_http(){
        //TODO
    }

    public function load_routing(){
        $router = $_ENV['router_file'];
        include $router;
        
    }

    private function load_middleware(){
        //TODO
    }

    private function load_controller(){
        //TODO
    }

    private function load_model(){
        //TODO
    }

    private function load_processor(){
        //TODO
    }

    private function exec_farewell(){
        //TODO
    }
}