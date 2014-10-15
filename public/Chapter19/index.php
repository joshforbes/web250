<?php
require('util/main.php');

require('model/database.php');
require('model/product_db.php');

/*********************************************
 * Select some products
 **********************************************/

// Sample data
$category_id = 1;

// Get the products
$products = get_products_by_category($category_id);

/***************************************
 * Delete a product
 ****************************************/

// Sample data
$name = 'Fender Telecaster';
$product = get_product_by_name($name);

if ($product) {
    $row_count = delete_product($product['productID']);
    if ($row_count) {
        $delete_message = 'Product successfully deleted';
    } else {
        $delete_message = 'No products were deleted';
    }
} else {
    $delete_message = 'There is no product with the name' . $name;
}

/***************************************
 * Insert a product
 ****************************************/

// Sample data
$category_id = 1;
$code = 'tele';
$name = 'Fender Telecaster';
$description = 'NA';
$price = '949.99';

// Insert the data
// Display an appropriate message
$newProduct = get_product_by_code($code);
if (!$newProduct) {
    $product_id = add_product($category_id, $code, $name, $description, $price, 0);
    if ($product_id) {
        $insert_message = "Product Added Successfully";
    }
} else {
    $insert_message = "No rows were inserted.";
}

include 'home.php';
?>