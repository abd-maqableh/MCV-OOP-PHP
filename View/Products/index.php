<?php

include('../Layout/header.php');
include('../../database/Database.php');
include('../../Model/Product.php');

$db = new Database();
$conn = $db->connect();
$product = new Product($conn);

if (isset($_POST['delete_product'])) {

    $product->delete($_POST['delete_product_id']);
}

$products = $product->Get();

?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Price</th>
        <th scope="col">Created</th>
        <th scope="col">Modified</th>
        <th scope="col">Category</th>
        <th scope="col">Delete</th>
        <th scope="col">Edit</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $number = 0;
    $value = '';
    foreach ($products as $row) {
        $number++;
        $name = $row['name'];
        $description = $row['description'];
        $price = $row['price'];
        $created = $row['created'];
        $modified = $row['modified'];
        $category_id = $row['category'];
        $id = $row ['id'];
        ?>

        <?php



                 echo "    <tr>
                        <th scope=\"row\">$number</th>
                        <td>$name</td>
                        <td>$description</td>
                        <td>$price</td>
                        <td>$created</td>
                        <td>$modified</td>
                        <td>$category_id</td>
 <td>
 <form method='post' >
    <input type='hidden' name='delete_product_id' value='$id'/>
    <button name='delete_product' type='submit'
            style=' width: 30px; height: 30px; text-align: center; padding: 6px 0; font-size: 12px; line-height: 1.428571429; border-radius: 15px '
            class='btn btn-danger btn-circle btn-sm'> Del </button>
    </form>
</td>
    <td>
                            <form action='./edit.php' method='POST'>
                                <input type='hidden' name='product-id' value='$id'>
                                <button type='submit' name='go-update-product' class='btn btn-outline-warning'>update</button>
                            </form>
                        </td>

                        
</tr>
        ";
 ?>
    <?php } ?>

    </tbody>
</table>


<?php
include('../Layout/footer.php');
?>
