<?php

include 'layout/header.php';
include 'Config/database.php';
session_start();

$getCarts = mysqli_query($connection, 'select * from cart_table');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
   <div class="container-fluid">
       <div class="row">
           <div class="col-lg-8">
                <div class="d-inline-flex flex-wrap cart_data">
                </div>
           </div>
           <div class="col-lg-4">
                <div class="card border-right-0 border-top-0">
                    <div class="card-body">
                        <p class="h4">Cart Details
                            <span id="cart_item_total" class="badge badge-success">0</span>
                        </p>

                        <?php
                            if (isset($getCarts)) {
                                foreach ($getCarts as $getCart) {
                        ?>
                            <img src="<?php echo 'images/'.$getCart['cart_image'] ?>" alt="demo" class="card-img-top" style="width:100px;">
                            <div class="d-flex justify-content-between">
                                <p class="h5 text-muted"><?php echo $getCart['cart_name'] ?></p>
                                <p class="h5 text-muted"><?php echo $getCart['cart_details']; ?></p>
                            </div>

                            <div class="row justify-content-end">
                                <p class="h5 text-muted">$<?php echo $getCart['cart_price'] ?></p>
                            </div>

                            <div class="d-flex justify-content-end">
                                <input type="number"
                                    name="qty"
                                    class="form-control quantity disable border-0 bg-white"
                                    id="quantity"
                                    value="<?php echo $getCart['cart_quantity'] ?>"
                                    readonly
                                >

                                <button class="btn btn-secondary btn-sm ml-2 mr-2 cart-item-add"
                                    data-cart-id="<?php echo $getCart['id']; ?>"
                                >
                                    <span class="fa fa-plus"></span>
                                </button>

                                <button class="btn btn-secondary btn-sm mr-2 cart-item-subtract"
                                    data-cart-id="<?php echo $getCart['id']; ?>"
                                >
                                    <span class="fa fa-minus"></span>
                                </button>

                                <button class="btn btn-danger cart-item-delete btn-sm"
                                    data-cart-id="<?php echo $getCart['id']; ?>"
                                >
                                    <span class="fa fa-trash"></span>
                                </button>
                            </div>

                            <hr class="bg-info">

                        <?php
                                }
                            } else {
                                echo "<p>Item Not Available</p>";
                            }
                        ?>
                    </div>

                    <div class="card-body">

                        <form action="" method="post">
                            <div class="form-inline">
                                    <div class="input-group">
                                        <select class="custom-select mr-2 " name="check-discount-type">
                                            <option selected value="1">%</option>
                                            <option value="2">$</option>
                                        </select>
                                    </div>

                                    <div class="input-group">
                                        <input type="text"
                                            name="discount_amount"
                                            id="discount"
                                            placeholder="Discount"
                                            class="form-control mr-1"
                                        >
                                    </div>

                                    <div class="input-group">
                                        <button type="submit"
                                            id="button-discount"
                                            class="btn btn-success"
                                            name="discount_button"
                                        >
                                            Apply
                                        </button>
                                    </div>
                                </div>
                        </form>

                        <hr class="bg-info">

                        <div class="d-block d-flex justify-content-between">
                            <div class="justify-content-start">
                                <p>Subtotal</p>
                                <p><?php echo ($total < 150) ? "ShippingCharges" : ""; ?></p>
                                <p>Total</p>
                                <p><?php echo empty($discount) ? "" : "Discount" ?></p>
                                <p>Tax</p>
                                <p>Payable</p>
                            </div>

                            <div class="justify-content-end">
                                <p>$<?php echo sprintf('%.2f', $subtotal); ?></p>
                                <p><?php echo ($total < 150) ? $shippingcharge : "" ; ?></p>
                                <p>$<?php echo $total ?></p>
                                <p><?php echo isset($discount) ? "$".$discount : ""; ?></p>
                                <p>$<?php echo $tax?></p>
                                <p>$<?php echo sprintf('%.2f', $payable) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
   </div>
</body>

</html>
<?php
    include 'layout/footer.php';
?>