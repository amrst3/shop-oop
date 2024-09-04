<?php
require_once '../inc/conn.php';


      if (isset($_GET['id'])) {
        $id = $_GET['id'];
      }else{
        header("location:../index.php");
      }

      $query = "select * from products where id=$id";
      $result = mysqli_query($conn,$query);
      

      if (mysqli_num_rows($result) == 1) {
        
        
        $product = mysqli_fetch_assoc($result);
        $image = $product['image'];
        if(!empty($image)){
            unlink("../images/$image");
        }
        $query = "delete from products where id=$id";
        $result = mysqli_query($conn,$query);
        if($result){
            $_SESSION['success']="product deleted";
            header("location:../index.php");
        }else{
            $_SESSION['errors']=["error while delete"];
            header("location:../index.php");
        }
    
    
    }else{
        $_SESSION['errors']=["product not found"];
            header("location:../index.php");
      }