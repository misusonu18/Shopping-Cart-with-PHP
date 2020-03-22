<?php
    include 'layout/header.php';
    include 'Config/database.php';
    session_start();

    $getCarts = mysqli_query($connection, 'select * from cart_table');
    $subtotal = 0.00;

    if (isset($subtotal)) {
        foreach ($getCarts as $records) {
            $subtotal =$subtotal + $records['cart_quantity'] * $records['cart_price'];
        }
        ($subtotal < 150) ? $shippingcharge = 10 : $shippingcharge=0;
        $total = $subtotal + $shippingcharge;
        $tax = 5.00;
        $payable = floor($total) + $tax;
    }
    if (empty($subtotal)) {
            $shippingcharge = 0;
            $tax = 0.00;
            $total = 0.00;
            $payable = 0.00;
        }

    if (isset($_POST['discount_button']) && isset($_POST['discount_amount'])) {
        if ($_POST['check-discount-type'] == 1 || $_POST['check-discount-type'] == 2) {
            $discount_amount = $_POST['discount_amount'];

            if ($subtotal > 100) {
                if ($discount_amount <= 10) {
                    $discount = $discount_amount;
                    $total = $subtotal - $discount_amount;
                    ($total < 150) ? $shippingcharge = 10 : $shippingcharge=0;
                    $tax = 5.00;
                    $payable = $total + $tax;
                }
            }
            if ($subtotal > 500) {
                if ($discount_amount <= 20) {
                    $discount = $discount_amount;
                    $total = $subtotal - $discount_amount;
                    ($total < 150) ? $shippingcharge = 10 : $shippingcharge=0;
                    $tax = 5.00;
                    $payable = $total + $tax;
                }

            }
            if ($subtotal >= 2000) {
                if ($discount_amount <= 45) {
                    $discount = $discount_amount;
                    $total = $subtotal - $discount_amount;
                    ($total < 150) ? $shippingcharge = 10 : $shippingcharge=0;
                    $tax = 5.00;
                    $payable = $total + $tax;
                }
            }

            if ($discount_amount >= 50) {
                echo "
                    <script type='text/javascript'>
                        alert('Discount Not Available');
                    </script>
                    ";
            }
        }

    }

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 border">
            <label class="navbar-header mt-2 h4 font-weight-bold">Cart Manager</label>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-7 col-sm-6 ">
            <div class="d-inline-flex flex-wrap cart_data">

            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-5">
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
                                    class="form-control mr-2"
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
<?php
    include 'layout/footer.php';
?>