<?php
namespace Route\Classes\Classes;

require_once '../classes/Session.php';
use Route\Classes\Classes\Session;





class Valedate{
    //  = new Session;
    
    

    public function required($key, $value){
        if(empty($value)){
            $session = new Session;
            $session->set('errors',["$key is required"]);
        }
    }


    public function string($key, $value){
        if(is_numeric($value)){
            $session = new Session;
            $session->set('errors',["$key must be string"]);
        }
    }
    
    
    public function number($key, $value){
        if(!is_numeric($value)){
            $session = new Session;
            $session->set('errors',["$key must be number"]);
        }
    }
    
    public function valedatImg($image){
        $session = new Session;
        // image attreputes
        $size = $image['size']/(1024*1024);
        $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
        $ext_arr = ["png","jpg","jpeg"];

        if ($image['error']!=0) {
            $session->set('errors',["image not correct"]);
        }elseif($size > 3){
            $session->set('errors',["image is too larg"]);
        }elseif(!in_array($ext,$ext_arr)){
            $session->set('errors',["wrong extintion"]);
        }
    }
}