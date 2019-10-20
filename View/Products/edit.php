<?php

include "../Layout/header.php";
include "../../database/Database.php";
include "../../model/Product.php";
include "../../model/Categorey.php";

$db = new Database();
$conn = $db->connect();

$category = new Categorey($conn);
$categories = $category->getAll();

$product = new Product($conn);

$id = "";
$name = "";
$description = "";
$price = "";
$category_id = "";
$error_updating = null;

if (isset($_POST['go-update-product'])) {
    $product_id = $_POST['product-id'];
    $product_to_update = $product->getOne($product_id);

    $id = $product_to_update['id'];
    $name = $product_to_update['name'];
    $description = $product_to_update['description'];
    $price = $product_to_update['price'];
    $category_id = $product_to_update['category_id'];
}

if (isset($_POST['update-product'])) {
    echo "updated product";
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category-id'];

    $product->setName($name);
    $product->setDescription($description);
    $product->setPrice($price);
    $product->setCategoryId($category_id);
    $updated_successfully = $product->updateOne($id);


}
?>


    <div class='container mt-3 w-75'>
        <h2 class='text-muted text-center'>Update product</h2>
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
            <?php
            if ($error_updating == true) {
                echo "<div class='alert alert-warning'>Did not updated, something went wrong</div>";
            }
            ?>
            <input name="id" type="hidden" value="<?php echo $id ?>">
            <fieldset class="form-group">
                <legend class="col-form-label col-sm-2 pt-0 text-muted font-weight-bold text-center mb-3"></legend>
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input name="name" value="<?php echo $name ?>"" type="text" class="form-control" id="name"
                    aria-describedby="emailHelp"
                    placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input name="description" value="<?php echo $description ?>" type="text" class="form-control"
                           id="description"
                           aria-describedby="emailHelp"
                           placeholder="Enter description">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input name="price" value="<?php echo $price ?>" type="number" min="1" class="form-control"
                           id="price"
                           aria-describedby="emailHelp"
                           placeholder="Enter price">
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category-id" id="category" class="custom-select mb-3">
                        <option selected>Category</option>
                        <?php
                        foreach ($categories as $row) {
                            $row_id = $row['id'];
                            $name = $row['name'];

                            if ($id == $row_id)
                                echo "<option selected value='$row_id' class='text-capitalize'>$name</option>";
                            else
                                echo "<option value='$row_id' class='text-capitalize'>$name</option>";
                        }
                        ?>
                    </select>

                </div>
            </fieldset>

            <button name="update-product" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

<?php include "../Layout/footer.php"; ?>