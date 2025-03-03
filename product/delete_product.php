<?php
// Include the database connection
include('../database/db.php');

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the product ID from the URL
    $product_id = $_GET['id'];

    // Delete the product from the database
    $query = "DELETE FROM product_tbl WHERE pt_id = :product_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':product_id', $product_id);

    // Execute the delete query
    if ($stmt->execute()) {
        // Redirect to the product page
        header("Location: ../products_page.php");
        exit;
    } else {
        echo "Failed to delete product.";
    }
}
?>
