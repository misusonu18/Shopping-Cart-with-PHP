<?php
    include 'Layout/header.php';
    include 'Config/database.php';
    session_start();

    if (empty($_SESSION['username'])) {
        header('location:login.php');
    }

    if (isset($_POST['multi_delete_button'])) {
        $check = $_POST['multi_delete'];
        for ($i=0; $i < count($check) ; $i++) { 
            $getProduct = mysqli_query($connection,'select * from products where id = "'.$check[$i].'"');
            $record = mysqli_fetch_assoc($getProduct);
            if (file_exists("../images/".$record['images'])) {
                $multiDelete = mysqli_query($connection,'delete from products where id="'.$check[$i].'" ');
                $deleteIdFromCart = mysqli_query($connection,'delete from cart_table where cart_id = "'.$check[$i].'"');
                unlink("../images/".$record['images']);
            }
        }
        $Multi_Delete = 'success';
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $product_id = base64_decode($id);
        $getProduct = mysqli_query($connection,'select * from products where id = "'.$product_id.'"');
        $record = mysqli_fetch_assoc($getProduct);
        if (file_exists("../images/".$record['images'])) {
            $delete = mysqli_query($connection,'delete from products where id="'.$product_id.'" ');
            $deleteIdFromCart = mysqli_query($connection,'delete from cart_table where cart_id = "'.$product_id.'"');
            unlink("../images/".$record['images']);
        }
    }

?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="mt-5 d-flex justify-content-end">
                    <div class="">
                        <label><?php echo $_SESSION['username'] ?></label>
                        <a href="logout.php" class="btn btn-info">Logout</a>
                    </div>
                </div>
                <div class="table-responsive mt-5">
                    <form action="" method="post">
                        <div class="justify-content-end row mr-2 mb-2">
                            <div class="mr-2">
                                <a href="insert_product.php" class="btn btn-success">Insert</a>
                            </div>

                            <div class="float-right">
                               <input type="submit" value="Multi Delete" name="multi_delete_button" class="btn btn-info" onclick="multiDeleteCpnfirm();"> 
                            </div>
                        </div>
                        <table class="table table-striped table-dark rounded table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="checkall">
                                    </th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Details</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="fetch_data">
                                
                            </tbody>
                        </table>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
    include 'Layout/footer.php';
?>