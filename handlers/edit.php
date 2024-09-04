<?php 
      require_once '../inc/conn.php';



      if (isset($_POST['submit']) && isset($_GET['id']) ) {
        extract($_POST);
        
        $id = $_GET['id'];
        $query = "select * from products where id=$id";
        $result = mysqli_query($conn,$query);
         if (mysqli_num_rows($result) == 1) {
             // update
            $product = mysqli_fetch_assoc($result);
            $oldImage = $product['image'];

            // image attreputes
        if($_FILES['image'] && $_FILES['image']['name']){
            unlink("../images/$oldImage");
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
            }elseif($size > 3){
                $errors[] = "image is too large";
            }elseif(!in_array($ext,$ext_arr)){
                $errors[] = "wrong extintion";
            }elseif(empty($name)){
                $errors[] = "title required";
            }elseif(empty($desc)){
                $errors[] = "description required";
            }elseif(empty($price)){
                $errors[] = "price required";
            }
        
            $new_name = uniqid().".".$ext;
            }else{
                $new_name = $oldImage;
            }
            if (empty($errors)) {
                //   UPLOAD AND STORE DATA
                
                $query = "update products set `name` ='$name',`description` ='$desc',`image` ='$new_name',`price` ='$price' where id = '$id'";
                $result= mysqli_query($conn,$query);
                if($_FILES['image'] && $_FILES['image']['name']){
                move_uploaded_file($temp_name,"../images/$new_name");
                }
                header("location:../show.php?id=$id");
            }else{
                print_r($errors);
            }

         }else{
             $msg = "product not found";
         }
        
    }else{
        header("location:../index.php");
    }