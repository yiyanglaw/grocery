<?php
include 'config.php';  //import all content from config.php
if(isset($_POST['addProduct'])){   //when user click add product button will run the if statement
    $id=$_POST['id'];
    $name=$_POST['name'];
    $category=$_POST['category'];   //received the data from HTML form input
    $price=$_POST['price'];
    $description=$_POST['description'];
    $quantity=$_POST['quantity'];

    //upload image
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
  } else {
        echo "File is not an image.";
        $uploadOk = 0;
  }
}

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
}

    // Check file size 2000000=2m
    if ($_FILES["fileToUpload"]["size"] > 2000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
}

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
}

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
    
    }else {
        echo "Sorry, there was an error uploading your file.";
  }
}
    $image=basename($_FILES["fileToUpload"]["name"]);
    $sql="insert into product values('$id','$name','$category','$price','$description','$quantity','$image')";  //define SQL
    $result=$conn->query($sql);//run SQL
}
include 'header.php';
?>

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-6" style="margin: 10px;">
    <form action="addProduct.php" method="post" enctype="multipart/form-data">
        <h3 style="margin-top: 10px;">Add Product</h3>
    <div class="mb-3">
        <label for="id" class="form-label">ID</label>
        <input type="text" class="form-control" id="id" name="id">
    </div>
    <div class="mb-3">
        <label for="id" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="mb-3">
        <label for="id" class="form-label">Category</label>
        <select name="category" id="category" class="form-control">
            <?php
                $sql="select * from category";
                $result=$conn->query($sql);
                if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){
                        $product_id=$row['category_id']; //$row name must same with databse field name
                        $product_name=$row['category_name'];
            ?>
            <option value="<?php echo $product_id;?>"><?php echo $product_name;?></option>

            <?php
                    }
                }
            ?>
        </select>
    
    </div>
    <div class="mb-3">
        <label for="id" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price">
    </div>
    <div class="mb-3">
        <label for="id" class="form-label">Description</label>
        <input type="text" class="form-control" id="description" name="description">
    </div>
    <div class="mb-3">
        <label for="id" class="form-label">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity">
    </div>
    <div class="mb-3">
        <label for="id" class="form-label">Product Image</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
    </div>
    <button name="addProduct" type="submit" class="btn btn-info">Add Product</button>
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