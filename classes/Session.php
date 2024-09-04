<?php 

namespace  Route\Classes\Classes;

class Session{

    //start

    public function __construct(){
        
        session_start();

    }

    //set

    public static function set($key , $value){
        $_SESSION[$key] = $value;
    }

    //get

    public function get($key){

       return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    //viue

    public function viue(){
            if (isset($_SESSION['errors'])) {
                foreach ($_SESSION['errors'] as $error) {?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php
                }
            }
            unset($_SESSION['errors']);
            if (isset($_SESSION['success'])) {
                ?>
                    <div class="alert alert-success"><?php echo $_SESSION['success']; ?></div>
                <?php
            }
            unset($_SESSION['success']);
        
    }

    //unset
    
    public function remove($key){
        unset($_SESSION[$key]);
    }



    //destroy

    public function destroy($key){
        session_destroy()  ;  
    }
}