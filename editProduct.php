<?php
include 'config.php';  //import all content from config.php
if(isset($_GET['id'])){   //when user click add product button will run the if statement
    $id=$_GET['id'];
    $sql="select product_id,product_name,category,product_price,product_description,product_quantity,image from product where product_id='$id'";  //define SQL
    $result=$conn->query($sql);//run SQL
}

include 'header.php';
?>

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-6" style="margin: 10px;">
    <form action="viewProduct.php" method="post" enctype="multipart/form-data">
    <?php
    if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $product_id=$row['product_id']; //$row name must same with databse field name
                $product_name=$row['product_name']; 
                $category=$row['category']; 
                $product_price=$row['product_price']; 
                $product_description=$row['product_description']; 
                $product_quantity=$row['product_quantity']; 
                $image=$row['image'];
    ?>
        <h3 style="margin-top: 10px;">Edit Product Record</h3>
        <img src="images/<?php echo $image; ?>" alt="" width="50%">
    <div class="mb-3">
        <label for="id" class="form-label">ID</label>
        <input type="text" class="form-control" id="id" name="id" value="<?php echo $product_id;?>" >
    </div>
    <div class="mb-3">
        <label for="id" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $product_name;?>" >
    </div>
    <div class="mb-3">
        <label for="id" class="form-label">Category</label>
        <select name="category" id="category" class="form-control">
            <?php
                $c_sql="select * from category";
                $c_result=$conn->query($c_sql);
                if($c_result->num_rows>0){
                    while($c_row=$c_result->fetch_assoc()){
                        $c_product_id=$c_row['category_id']; //$row name must same with databse field name
                        $c_product_name=$c_row['category_name'];
            ?>
            <option value="<?php echo $c_product_id;?>"<?php if($category==$c_product_id){ echo"selected";}?>><?php echo $c_product_name;?></option>

            <?php
                    }//end while
                }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="id" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price"  value="<?php echo $product_price;?>" >
    </div>
    <div class="mb-3">
        <label for="id" class="form-label">Description</label>
        <input type="text" class="form-control" id="description" name="description" value="<?php echo $product_description;?>">
    </div>
    <div class="mb-3">
        <label for="id" class="form-label">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $product_quantity;?>">
    </div>
    <div class="mb-3">
        <label for="id" class="form-label">Product Image</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
    </div>
    <button name="editProduct" type="submit" class="btn btn-info">Update</button>
    <?php
            }
    }
    ?>
    </form>
    </div>
</div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
  </body>
</html>