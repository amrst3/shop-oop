<?php include 'inc/header.php'; 
    require_once 'classes/Session.php';
    require_once 'inc/conn.php';
    use Route\Classes\Classes\Session;

    $session = new Session;
    $session->viue();
?>



<div class="container my-5">

    <div class="row">
        
     <!-- FETCH DATA FROM DATA BASE -->
     <?php 
            
            $query = "select * from products";
            $result = mysqli_query($conn,$query);

            if (mysqli_num_rows($result) > 0) {
              $products = mysqli_fetch_all($result,MYSQLI_ASSOC);
            }else{
              $msg = "products not found";
            }
            
            if (!empty($products)):
              foreach ($products as $product):
          ?>



    <div class="col-lg-4 mb-3">



            <div class="card">
            <img src="images/<?php echo $product['image'] ?>" class="card-img-top">
            <div class="card-body">
            <h5 class="card-title"><?php echo $product['name'] ?></h5>
            <p class="text-muted"><?php echo $product['price'] ?> EGP</p>
            <p class="card-text"><?php echo $product['description'] ?></p>
            <a href="show.php?id=<?php echo $product['id'] ?>" class="btn btn-primary">Show</a>

            <a href="edit.php?id=<?php echo $product['id'] ?>" class="btn btn-info">Edit</a>
            <a href="handlers/delete.php?id=<?php echo $product['id'] ?>" class="btn btn-danger">Delete</a>

            </div>
        </div>
        
    </div>

    <?php
              endforeach;
            else : echo $msg;
            endif;
          ?>
    
        
    </div>

</div>



<?php include 'inc/footer.php'; ?>