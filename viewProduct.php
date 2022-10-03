<?php
include 'config.php';  //import all content from config.php

if(isset($_POST['editProduct'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $category=$_POST['category'];   //received the data from HTML form input
    $price=$_POST['price'];
    $description=$_POST['description'];
    $quantity=$_POST['quantity'];
    $image="image=''";

    if($_FILES['fileToUpload']!=''){
        //upload image code
        
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        } 
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }

        // Check file size  2000000=2mb
        if ($_FILES["fileToUpload"]["size"] > 2000000) {            
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {            
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                //if new image upload SQL will extend
                $image="image='".basename($_FILES["fileToUpload"]["name"])."'";   
            } 
        }
        
    }


    //update ..... set price='2000.00',image='aaa.jpg'
    $sql="update product set product_name='$name',category='$category', product_price='$price', product_description='$description', product_quantity='$quantity',".$image." where product_id='$id'";
    $result=$conn->query($sql);    
}


if(isset($_GET['id'])){
    $deleteID=$_GET['id'];
    $sql="delete from product where product_id='$deleteID'";
    $result=$conn->query($sql);//run SQL
}

$keyword="";
if(isset($_POST['keyword'])){
    $k=$_POST['keyword'];
    $keyword=" where product.product_name like '%".$k."%'";    
}  // php "-----"."-------".$var

$sql="select product.product_id,product.product_name,category.category_name as category,product.product_price,product.product_description,product.product_quantity from product left join category on product.category=category.category_id".$keyword;  //define SQL where name like %keyword%
$result=$conn->query($sql);//run SQL

include 'header.php';
?>

<!-- get from bootsnips-->
<div class="container">
    <br><br>
    <div class="row col-md-10 col-md-offset-2 custyle">
    <table class="table table-striped custab">
    <thead>
    <a href="addProduct.php" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new product</a>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Description</th>
            <th>Quantity</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <?php
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $product_id=$row['product_id']; //$row name must same with databse field name
                $product_name=$row['product_name']; 
                $category=$row['category']; 
                $product_price=$row['product_price']; 
                $product_description=$row['product_description']; 
                $product_quantity=$row['product_quantity']; 
    ?>
            <tr>
                <td><?php echo $product_id; ?></td>
                <td><?php echo $product_name; ?></td>
                <td><?php echo $category; ?></td>
                <td><?php echo $product_price; ?></td>
                <td><?php echo $product_description; ?></td>
                <td><?php echo $product_quantity; ?></td>
                <td class="text-center"><a class='btn btn-info btn-xs' href="editProduct.php?id=<?php echo $product_id; ?>"> Edit</a> <a href="viewProduct.php?id=<?php echo $product_id; ?>" onclick="return confirm('Are you confirm delete?')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del</a></td>
            </tr>   
    <?php
            } //end while
        }///end if
    ?>        
    </table>
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