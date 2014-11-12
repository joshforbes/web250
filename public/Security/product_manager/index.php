<?php
require('../model/database.php');
require('../model/product_db.php');
require('../model/category_db.php');
require('../helpers/validation_functions.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'list_products';
}

if ($action == 'list_products') {
    // Get the current category ID
    if (empty($_GET['category_id'])) {
        $category_id = 1;
    } else {
        $category_id = $_GET['category_id'];
    }

    // Get product and category data
    $category_name = get_category_name($category_id);
    $categories = get_categories();
    $products = get_products_by_category($category_id);

    // Display the product list
    include('product_list.php');
} else if ($action == 'delete_product') {
    // Get the IDs
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];

    // Delete the product
    delete_product($product_id);

    // Display the Product List page for the current category
    header("Location: .?category_id=$category_id");
} else if ($action == 'show_add_form') {
    $categories = get_categories();
    include('product_add.php');
} else if ($action == 'add_product') {
    $category_id = $_POST['category_id'];
    $code = $_POST['code'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Validate the inputs
    // I think it would be way better if this code was structure to have a "product" model
    // and then we could save the validation rules there. This seems a very "spaghetti"
    // way to handle the problem. But given the code structure I think it is the
    // best course of action.

    if (!has_presence($code) || !has_presence($name) || !has_presence($price)) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } elseif (!has_length($code, ['min' => 2])) {
        $error = "Product code must be at least two characters long.";
        include('../errors/error.php');
    } elseif (!has_number($price) || !has_format_matching($price, '/^[0-9]+(\.[0-9]{2})$/')) {
        $error = "Incorrectly formatted price. Must be a number and include two decimal places";
        include('../errors/error.php');
    }else {
        add_product($category_id, $code, $name, $price);

        // Display the Product List page for the current category
        header("Location: .?category_id=$category_id");
    }
} else if ($action == 'list_categories') {
    $categories = get_categories();
    include('category_list.php');
} else if ($action == 'add_category') {
    $name = $_POST['name'];

    // Validate inputs
    if (empty($name)) {
        $error = "Invalid category name. Check name and try again.";
        include('view/error.php');
    } else {
        add_category($name);
        header('Location: .?action=list_categories');  // display the Category List page
    }
} else if ($action == 'delete_category') {
    $category_id = $_POST['category_id'];
    delete_category($category_id);
    header('Location: .?action=list_categories');      // display the Category List page
}
?>