<?php

include('../Layout/header.php');
include('../../database/Database.php');
include('../../Model/Product.php');
include('../../Model/Categorey.php');


$is_create_product = "";

$database = new Database();
$connection = $database->connect();
$cat = new Categorey($connection);
$getCat = $cat->getCategory();
if (isset($_POST['submit'])) {
    $product = new Product($connection);
    $product->setName($_POST['name']);
    $product->setDescription($_POST['description']);
    $product->setPrice($_POST['price']);
    $product->setCategoryId($_POST['category_id']);
    $is_create_product = $product->Add();
//    echo '<br>19-cp.php - is-create-product' . $is_create_product;
}

?>


<form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" class="container">
    <?php
    if ($is_create_product != "") {
        if ($is_create_product) {
            echo "<div class='alert alert-success'>Product was added successfully</div>";
        } else {
            echo "<div class='alert alert-warning'>Unable to add product.</div>";
        }
    }


     ?>

    <div class="form-group">
        <label for="exampleInputEmail1">name of product</label>
        <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp"
               placeholder="Enter name of product">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">description</label>
        <input name="description" type="text" class="form-control" id="description"
               placeholder="Write your description">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">price</label>
        <input name="price" type="text" class="form-control" id="price" placeholder="Write your price">
    </div>
    <select class="form-control" name="category_id">
        <option>Default select</option>
        <?php
                foreach ($getCat as $row){
                    $id=  $row ['id'];
                    $name = $row ['name'];
                    echo "<option value='$id' class='text-capitalize'> $name</option> ";
                }
        ?>
    </select>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>

<?php
include('../Layout/footer.php');
?>

