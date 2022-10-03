<?php
include 'config.php';  //import all content from config.php

$keyword="";
if(isset($_POST['keyword'])){
    $k=$_POST['keyword'];
    $keyword=" where product.product_name like '%".$k."%'";  
}  // php "-----"."-------".$var

if(isset($_GET['catid'])){
    $k=$_GET['catid'];
    $keyword=" where product.category ='$k'";    
}

$sql="select product.product_id,product.product_name,product.product_price,product.product_description,product.product_quantity,product.image,category.category_name as category from product left join category on product.category=category.category_id".$keyword;  //define SQL where name like %keyword%
$result=$conn->query($sql);//run SQL

include 'header.php';
?>

<!-- get from bootsnips-->
<div class="container">
    <br><br>
    <div class="row">
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
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img src="images/<?php echo $image; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product_name; ?></h5>
                    <p class="card-text">Price: RM <?php echo $product_price; ?></p>
                    <p class="card-text"> <?php echo $product_description; ?></p>
                    <p class="card-text">Available quantity: <?php echo $product_quantity; ?></p>
                    <a href="#" class="btn btn-primary">Add to Cart</a>
                </div>
            </div>
        </div>
        <?php
                } //end while
            }///end if
        ?>  
    </div>      
   
</div>
<!-- get from bootsnips-->

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