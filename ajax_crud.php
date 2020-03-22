<?php
    include 'layout/header.php';
    include 'Config/database.php';

    $catagory = $_POST['catagory'];

    if (isset($catagory) == 'AddItem') {

        if (isset($_POST['cart_id_add'])) {
            $cart_id = $_POST['cart_id_add'];
    
            $check_cart = mysqli_query($connection,'select * from cart_table where cart_id = "'.$cart_id.'"');
            $productRecords = mysqli_query($connection,'select * from products where id = "'.$cart_id.'"');
    
            if (mysqli_num_rows($check_cart) > 0) {
                $quantity = 1;
                foreach ($check_cart as $cart) {
                    $quantity += $cart['cart_quantity'];
                }
    
                $insert = mysqli_query($connection,'update cart_table set cart_quantity = "'.$quantity.'" where cart_id = "'.$cart_id.'"');
            }
            else {

                foreach ($productRecords as $record) {
                    $insert = mysqli_query($connection,'insert into cart_table values(0,"'.$cart_id.'","'.$record['name'].'","'.$record['details'].'","'.$record['price'].'",1,"'.$record['images'].'")');
                }
            } 
            echo 'success';
        }

    }

    if (isset($catagory) == 'UpdateItem') {

        if (isset($_POST['cart_item_add'])) {
            $cart_id = $_POST['cart_item_add'];

            $check_cart = mysqli_query($connection, 'select * from cart_table where id = "'.$cart_id.'"');

            if (mysqli_num_rows($check_cart) > 0) {
                $quantity = 1;
                foreach ($check_cart as $cart) {
                    $quantity += $cart['cart_quantity'];
                }
                echo $quantity;
                $insert = mysqli_query($connection, 'update cart_table set cart_quantity = "'.$quantity.'" where id = "'.$cart_id.'"');
            }
        }

    }

    if (isset($catagory) == "SubtractItem") {
        if (isset($_POST['cart_item_subtract'])) {
            $cart_id = $_POST['cart_item_subtract'];

            $check_cart = mysqli_query($connection, 'select * from cart_table where id = "'.$cart_id.'"');

            if (mysqli_num_rows($check_cart) > 0) {
                $quantity = 1;
                foreach ($check_cart as $cart) {
                    $quantity = $cart['cart_quantity'] - $quantity;
                    if($cart['cart_quantity'] > 1) {
                        $insert = mysqli_query($connection, 'update cart_table set cart_quantity = "'.$quantity.'" where id = "'.$cart_id.'"');
                    }
                    else {
                        $delete_item_cart = mysqli_query($connection, 'delete from cart_table where id = "'.$cart_id.'"');
                    }
                }
            }
        }
    }

    if (isset($catagory) == "DeleteItem") {
        if (isset($_POST['cart_item_delete'])) {
           $cart_id = $_POST['cart_item_delete'];

           $delete_item_cart = mysqli_query($connection, 'delete from cart_table where id = "'.$cart_id.'"');

        }  
    }

    include 'layout/footer.php';
?>
