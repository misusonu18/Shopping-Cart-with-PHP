<?php
    include 'Config/database.php';

    $getProduct = mysqli_query($connection,'select * from products');

    foreach ($getProduct as $records) {
        $response[] = $records;
    }
    
    if (isset($response)) {
        echo json_encode($response);
    }
    else {
        echo "0";
    }
?>