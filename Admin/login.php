<?php
    include 'Layout/header.php';
    include 'Config/database.php';
    session_start();

    if (isset($_SESSION['username'])) {
        header('logout.php','_self');
    }

?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-4">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <div class="input-group">
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" autocomplete="off">
                            </div>
                            <small id="username_Validate"></small>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" >
                            </div>
                            <small id="password_Validate"></small>
                        </div>

                        <div class="form-group text-right">
                            <input type="submit" name="Submit" id="buttonlogin" value="Login" class="btn btn-primary" >
                        </div>

                        <div class="form-group text-right">
                            <a href="register.php" class="btn btn-link">Sign-Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include 'Layout/footer.php';
?>