<?php
    include 'Layout/header.php';
    include 'Config/database.php';
    session_start();

    if(isset($_GET['product_id']))
    {
        $id = $_GET['product_id'];
        $id = base64_decode($id);
        $getProduct = mysqli_query($connection,'select * from products where id="'.$id.'"');
        $record = mysqli_fetch_assoc($getProduct);
    }

    if (isset($_POST['button']) == 'Update') {

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

            $id = base64_decode($_GET['product_id']);    
            $name = $_POST['product_name'];
            $details = $_POST['product_details'];
            $price = $_POST['product_price'];
            $category = $_POST['product_category'];
            $image = $_POST['image'];

            if(!empty($_FILES['product_image']['name']))
            {
                if (file_exists("../images/".$image)) {
                    $target_file = date('dmYHis').str_replace(" ", "", basename($_FILES["product_image"]["name"]));
                    move_uploaded_file($_FILES["product_image"]["tmp_name"], "../images/".$target_file);
                    $update = mysqli_query($connection,'update products set name="'.$name.'", details="'.$details.'", price="'.$price.'", category="'.$category.'",images="'.$target_file.'" where id="'.$id.'"');
                    unlink("../images/".$image);
                }
            }
            else{
                if (file_exists("../images/".$image)) {
                    $update = mysqli_query($connection,'update products set name="'.$name.'", details="'.$details.'", price="'.$price.'", category="'.$category.'"  where id="'.$id.'"');
                }
            }
        }
    }

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="card mt-5">
                    <div class="card-header">
                        Update
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" 
                                    name="product_name" 
                                    id="Product_name" 
                                    class="form-control"
                                    value="<?php echo $record['name']?>"
                                    placeholder="Product Name"
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
                                    value="<?php echo $record['details']?>"
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
                                    value="<?php echo $record['price']?>"
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
                                    value="<?php echo $record['category']?>"
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
                                <input type="file" name="product_image">
                                <input type="hidden" name="image" value="<?php echo $record['images'] ?>">
                            </div>

                            <div>
                                <img src="<?php echo "../images/".$record['images']?>" alt="Demo" style='width:100px'>
                            </div>
                        </div>

                        <div class="form-group text-right mt-3">
                            <input type="submit" class="btn btn-primary" name="button" value="Update">
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