<?php include 'inc/header.php';
require_once 'inc/conn.php';
?>

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
        $msg = "post not found";
      }
    
      if(!empty($product)){?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">


            <form method="POST" action="handlers/edit.php?id=<?php echo $product['id'] ?>">
                <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name = "name" value="<?php echo $product['name'] ?>">
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price'] ?>">
                </div>

                <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description:</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name = "desc"><?php echo $product['description'] ?></textarea>
                </div>

                <div class="mb-3">
                <label for="formFile" class="form-label">Image:</label>
                <input class="form-control" type="file" id="formFile" name="img">
                </div>

                <div class="col-lg-3">
                        <img src="images/<?php echo $product['image'] ?>" class="card-img-top">
                        </div>
                        
                <center><button on type="submit" class="btn btn-primary" name="submit">Add</button></center>
            </form>
        </div>
    </div>
</div>



<?php

}else{
  echo $msg;
}

include 'inc/footer.php'; ?>