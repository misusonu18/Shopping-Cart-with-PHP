<?php
    include 'Config/database.php';
    session_start();

    if (isset($_POST['btnregister']) == 'Register') {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = md5($password);

        $checkdata = mysqli_query($connection,'select * from user_table where username = "'.$username.'"');
        
        if (mysqli_num_rows($checkdata) > 0) {
            echo 'Sorry Username Already Taken...';
        } else {
            $insertdata = mysqli_query($connection,'insert into user_table values(0,"'.$name.'","'.$username.'","'.$password.'")');
        }
        // echo 'success';
    }

    if (isset($_POST['btnlogin']) == 'Login') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = md5($password);

        $checkdata = mysqli_query($connection,'select * from user_table where username = "'.$username.'" AND password = "'.$password.'"');

        if (mysqli_num_rows($checkdata) > 0) {
            $_SESSION['username'] = $username;
        }
        echo "success"; 
    }
?>