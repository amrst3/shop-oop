<?php 

//namespace

namespace Route\Classes\Classes;

class Request{

    public function get($key){

        // return (isset($_GET[$key])) ? $_GET[$key] : null ;

        if(isset($_GET[$key])){
            return $_GET[$key];
        }else{
            return null;
        }

    }


    public function post($key){

        if(isset($_POST[$key])){
            return $_POST[$key];
        }else{
            return null;
        }
    }

    
    public function check($data){

        return isset($data);
    }

    public function clean($data){
        return trim(htmlspecialchars($data));
    }

    public function checkMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }

    public function redirect($file){
        header("location:$file");
    }
    
}