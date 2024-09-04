<?php include 'inc/header.php'; 
    require_once 'inc/conn.php';
?>




<div class="container my-5">

    <div class="row">

    <?php
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
      }else{
        header("location:index.php");
      }

      $query = "select * from products where id=$id";
      $result = mysqli_query($conn,$query);
      if (mysqli_num_rows($result) == 1) {
        $product = mysqli_fetch_assoc($result);
      }else{
        $msg = "product not found";
      }
    
      if(!empty($product)){?>

    <div class="col-lg-6">
            <img src="images/<?php echo $product['image'] ?>" class="card-img-top">
            </div>
            <div class="col-lg-6">
            <h5 ><?php echo $product['name'] ?></h5>
            <p class="text-muted">Price: <?php echo $product['price'] ?> EGP</p>
            <p><?php echo $product['description'] ?></p>
            <a href="index.php" class="btn btn-primary">Back</a>
            <a href="edit.php?id=<?php echo $product['id'] ?>" class="btn btn-info">Edit</a>
            <a href="handlers/delete.php?id=<?php echo $product['id'] ?>" class="btn btn-danger">Delete</a>
        </div>
        
        <?php
      }else{
        echo $msg;
      }
      ?>
    </div>
</div>



<?php include 'inc/footer.php';
?>