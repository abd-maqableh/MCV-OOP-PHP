<?php

include('../Layout/header.php');
include('../../database/Database.php');
include('../../Model/Categorey.php');

$is_create_category="";
$database = new Database();
$connection = $database->connect();
if (isset($_POST['submit'])) {
    $categrey = new Categorey($connection);
    $categrey->setName($_POST['name']);
    $is_create_category= $categrey->addCategory();

//    echo '<br>19-cp.php - is-create-product' . $is_create_category;
}


?>


<form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" class="container">
    <?php
    if ( $is_create_category != "") {
        if ($is_create_category) {
            echo "<div class='alert alert-success'>Category was added successfully</div>";
        } else {
            echo "<div class='alert alert-warning'>Unable to add category.</div>";
        }
    }


    ?>
    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" class="container">

    <div class="form-group">
        <label for="exampleInputEmail1">Name of Category</label>
        <input name="name" type="text" class="form-control" id="add-category"
               placeholder="Enter name of Category">
    </div>

    <button type="submit" class="btn btn-primary" name="submit">Add Category</button>
</form>
    <?php
    include('../Layout/footer.php');
    ?>
