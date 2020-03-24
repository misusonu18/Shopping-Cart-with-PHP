<?php
    include 'Layout/header.php';
    include 'Config/database.php';
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-4">
                <div class="card mt-5">
                    <div class="card-header">
                        Register
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="username">Name:</label>
                            <div class="input-group">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                            </div>
                            <small id="name_Validate"></small>
                        </div>

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
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off">
                            </div>
                            <small id="password_Validate"></small>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" autocomplete="off">
                            </div>
                            <small id="confirm_password_Validate"></small>
                        </div>

                        <div class="form-group text-right">
                            <input type="submit" name="Submit" value="Register" id="buttonregister" class="btn btn-primary" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include 'Layout/footer.php';
?>