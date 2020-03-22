<?php
    include 'Config/database.php';

    $allProducts = mysqli_query($connection, 'select * from products');

    foreach ($allProducts as $allProduct) {
        $response[] = $allProduct;
    }

    echo json_encode($response);
?>