<?php
    include 'Layout/header.php';
    include 'Config/database.php';
    session_start();   

    if (isset($_POST['button']) == 'Insert') {

        if (empty($_POST['product_name']) || empty($_POST['product_details']) || empty($_POST['product_price']) || empty($_POST['product_category'])) {
            if (empty($_POST['product_name'])) {
                $_SESSION['ErrorMessage']['product_name'] = "<font style='color:red;' font-size:16px;>Product Name Required</font>";
            }
    
            if (empty($_POST['product_details'])) {
                $_SESSION['ErrorMessage']['product_details'] = "<font style='color:red;' font-size:16px;>Product Details Required</font>";
            }
    
            if (empty($_POST['product_price'])) {
                $_SESSION['ErrorMessage']['product_price'] = "<font style='color:red;' font-size:16px;>Product Price Required</font>";
            }
    
            if (empty($_POST['product_category'])) {
                $_SESSION['ErrorMessage']['product_category'] = "<font style='color:red;' font-size:16px;>Product Category Required</font>";
            }
        }
        else {
            $name = $_POST['product_name'];
            $details = $_POST['product_details'];
            $price = $_POST['product_price'];
            $category = $_POST['product_category'];

            $target_file = date('dmYHis').str_replace(" ", "", basename($_FILES["product_image"]["name"]));
            move_uploaded_file($_FILES["product_image"]["tmp_name"], "../images/".$target_file);
            $insert = mysqli_query($connection,'insert into products values(0,"'.$name.'","'.$details.'","'.$price.'","'.$category.'","'.$target_file.'",1)');
        }

    }

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="card mt-5">
                    <div class="card-header">
                       Insert
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" 
                                    name="product_name" 
                                    id="Product_name" 
                                    class="form-control"
                                    placeholder="product Name"
                                >
                            </div>
                            <?php
                                echo isset($_SESSION['ErrorMessage']['product_name']) ? $_SESSION['ErrorMessage']['product_name'] : "";
                                unset($_SESSION['ErrorMessage']['product_name']);
                            ?>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" 
                                    name="product_details" 
                                    id="Product_name" 
                                    class="form-control"
                                    placeholder="Product Details"
                                >
                            </div>
                            <?php
                                echo isset($_SESSION['ErrorMessage']['product_details']) ? $_SESSION['ErrorMessage']['product_details'] : "";
                                unset($_SESSION['ErrorMessage']['product_details']);
                            ?>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" 
                                    name="product_price" 
                                    id="Product_name" 
                                    class="form-control"
                                    placeholder="Product Price"
                                >
                            </div>
                            <?php
                                echo isset($_SESSION['ErrorMessage']['product_price']) ? $_SESSION['ErrorMessage']['product_price'] : "";
                                unset($_SESSION['ErrorMessage']['product_price']);
                            ?>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" 
                                    name="product_category" 
                                    id="Product_name" 
                                    class="form-control"
                                    placeholder="Product Category"
                                >
                            </div>
                            <?php
                                echo isset($_SESSION['ErrorMessage']['product_category']) ? $_SESSION['ErrorMessage']['product_category'] : "";
                                unset($_SESSION['ErrorMessage']['product_category']);
                            ?>
                        </div>

                        <div class="row col justify-content-between">
                            <div class="form-group">
                                <input type="file" name="product_image" required>
                            </div>
                        </div>

                        <div class="form-group text-right mt-3">
                            <input type="submit" class="btn btn-primary" name="button" value="Insert">
                        </div>
                    </div>
                </div>                
            </form>
        </div>
    </div>    
</div>
<?php
    include 'Layout/footer.php';
?>