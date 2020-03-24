<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="js/alertify.min.js"></script>
<script src="js/main.js"></script>

<?php
    if (isset($update)) {

        echo "
            <script type='text/javascript'>
                alertify.notify('Update Successfully', 'success', 2, function(){
                    window.location.href='index.php';    
                });
            </script>
        ";
    }

    if (isset($insert)) {

        echo "
            <script type='text/javascript'>
                alertify.notify('Insert Successfully', 'success', 2, function(){
                    window.location.href='index.php';    
                });
            </script>
        ";
    }

    if (isset($delete)) {

        echo "
            <script type='text/javascript'>
                alertify.notify('Delete Successfully', 'success', 2, function(){
                    window.location.href='index.php';    
                });
            </script>
        ";
    }

    if (isset($Multi_Delete) == 'success') {
        echo "
            <script type='text/javascript'>
                alertify.notify('Delete Successfully', 'success', 2, function(){
                    window.location.href='index.php';    
                });
            </script>
        ";
    }
?>
</body>
</html>