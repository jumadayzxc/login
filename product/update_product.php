<?php
// Include the database connection
include('../database/db.php');

// Check if the form is submitted
if (isset($_POST['update_product'])) {
    // Get the form data
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_type = $_POST['product_type'];
    $product_price = $_POST['product_price'];

    // Check if an image file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Upload the new image
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = "../product/product_img/" . $image_name;
        
        // Move the uploaded file to the desired folder
        move_uploaded_file($image_tmp, $image_path);

        // Update the product information in the database (including the new image)
        $query = "UPDATE product_tbl SET pt_name = :product_name, pt_type = :product_type, pt_price = :product_price, pt_img = :image WHERE pt_id = :product_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':product_type', $product_type);
        $stmt->bindParam(':product_price', $product_price);
        $stmt->bindParam(':image', $image_name);
        $stmt->bindParam(':product_id', $product_id);
    } else {
        // Update product information without changing the image
        $query = "UPDATE product_tbl SET pt_name = :product_name, pt_type = :product_type, pt_price = :product_price WHERE pt_id = :product_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':product_type', $product_type);
        $stmt->bindParam(':product_price', $product_price);
        $stmt->bindParam(':product_id', $product_id);
    }

    // Execute the update query
    if ($stmt->execute()) {
        // Redirect to the product page
        header("Location: ../products_page.php");
        exit;
    } else {
        echo "Failed to update product.";
    }
}
?>
 