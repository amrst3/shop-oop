<?php
require_once '../inc/conn.php';
require_once '../classes/Request.php';
require_once '../classes/valedate.php';
require_once '../classes/Session.php';
use Route\Classes\Classes\Session;
use Route\Classes\Classes\Request;
use Route\Classes\Classes\Valedate;

$valedate = new Valedate;
$request = new Request;
$session = new Session;

if (isset($_POST['submit'])) {
    extract($_POST);

    // image attreputes
    $image = $_FILES['image'];
    // var_dump($image);
    $temp_name = $image['tmp_name'];
    $size = $image['size']/(1024*1024);
    $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
    $ext_arr = ["png","jpg","jpeg"];

    $errors = [];
    // ERRORS CATCH
    if ($image['error']!=0) {
        $errors[] = "image not correct";
    }elseif($size > 5){
        $errors[] = "image is too large";
    }elseif(!in_array($ext,$ext_arr)){
        $errors[] = "wrong extintion";
    }elseif(empty($name)){
        $errors[] = "name required";
    }elseif(empty($desc)){
        $errors[] = "description required";
    }elseif(empty($price)){
        $errors[] = "price required";
    }

    $new_name = uniqid().".".$ext;
    if (empty($errors)) {
        //   UPLOAD AND STORE DATA
        move_uploaded_file($temp_name,"../images/$new_name");
        $query = "insert into products(`name`,`price`,`description`,`image`) values('$name','$price','$desc','$new_name')";
        mysqli_query($conn,$query);
        header("location:../index.php");
    }else{
        print_r($errors);
    }

}else{
    $request->redirect('../add.php');
}