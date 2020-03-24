$(function(){

    alertify.set('notifier', 'position', 'top-center');

    let $NameRegEx = /^([a-z A-Z]{2,20})$/;
    let $EmailIdRegEx = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{2,10})(\]?)$/;
    let $PasswordRegEx = /^(?=.*\d)(?=.*[a-z]).{6,20}$/;
    let $PhoneRegEx = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;

    let specialKeys = new Array();
    specialKeys.push(8); //Backspace.
    specialKeys.push(9); //Tab.
    specialKeys.push(46); //Delete.
    specialKeys.push(16); //Shift.
    specialKeys.push(20); //Caps Lock.
    specialKeys.push(32); //space
    specialKeys.push(13); //Enter

    let name = false,
        username = false, 
        password = false,
        cpassword = false;

    $("#name").bind("keypress", function (e) {
        let keyCode = e.which ? e.which : e.keyCode
        let ret = ((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || specialKeys.indexOf(keyCode) != -1);
        $("#name_Validate").html(ret ? "" : "(*) Invalid Last Input..!!");
        return ret;
    });
    $("#name").bind("blur", function (e) {
        $("#name_Validate").empty();
        if ($("#name").val() == "") {
            name = false;
            $("#name_Validate").html('(*) Name Required..!!');
        } else {
            if (!$("#name").val().match($NameRegEx)) {
                $("#name_Validate").html('Invalid Name..!!');
                name = false;
            } else {
                name = true;
            }
        }
    });

    $("#username").bind("keypress", function (e) {
        let keyCode = e.which ? e.which : e.keyCode
        let ret = ((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || specialKeys.indexOf(keyCode) != -1);
        $("#username_Validate").html(ret ? "" : "(*) Invalid Last Input..!!");
        return ret;
    });
    $("#username").bind("blur", function (e) {
        $("#username_Validate").empty();
        if ($("#username").val() == "") {
            username = false;
            $("#username_Validate").html('(*) Username Required..!!');
        } else {
            if (!$("#username").val().match($NameRegEx)) {
                $("#username_Validate").html('Invalid Username..!!');
                username = false;
            } else {
                username = true;
            }
        }
    });

    $("#password").bind("keypress", function (e) {
        let keyCode = e.which ? e.which : e.keyCode
        let ret = ((keyCode >= 65 && keyCode <= 90) || (keyCode >= 48 && keyCode <= 57) || (keyCode >= 97 && keyCode <= 122) || specialKeys.indexOf(keyCode) != -1);
        $("#password_Validate").html(ret ? "" : "(*) Invalid Last Input..!!");
        return ret;
    });
    $("#password").bind("focus",function(){
        $("#password_Validate").empty();
        $("#password_Validate").html('Atleast one capital letter, one Number and greaterthan 6 and Less than 20');
    });
    $("#password").bind("blur", function (e) {
        $("#password_Validate").empty();
        if ($("#password").val() == "") {
            password = false;
            $("#password_Validate").html('(*) Password Required..!!');
        } else {
            if (!$("#password").val().match($PasswordRegEx)) {
                $("#password_Validate").html('Invalid Password..!!');
                password = false;
            } else {
                password = true;
            }
        }
    });

    $("#confirm_password").bind("keypress", function (e) {
        let keyCode = e.which ? e.which : e.keyCode
        let ret = ((keyCode >= 65 && keyCode <= 90) || (keyCode >= 48 && keyCode <= 57) || (keyCode >= 97 && keyCode <= 122) || specialKeys.indexOf(keyCode) != -1);
        $("#confirm_password_Validate").html(ret ? "" : "(*) Invalid Last Input..!!");
        return ret;
    });
    $("#confirm_password").bind("focus",function(){
        $("#confirm_password_Validate").empty();
        $("#confirm_password_Validate").html('Atleast one capital letter, one Number and greaterthan 6 and Less than 20');
    });
    $("#confirm_password").bind("blur", function (e) {
        $("#confirm_password_Validate").empty();
        if ($("#confirm_password").val() == "") {
            cpassword = false;
            $("#confirm_password_Validate").html('(*) Confirm Password Required..!!');
        } else {
            if (!$("#confirm_password").val().match($PasswordRegEx)) {
                $("#confirm_password_Validate").html('Invalid Confirm Password..!!');
                cpassword = false;
            } else {
                cpassword = true;
            }
        }
    });

    $("#buttonregister").click(function(){
        $("#name_Validate").empty();
        if ($("#name").val() == "") {
            name = false;
            $("#name_Validate").html('(*) Name Required..!!');
        } else {
            if (!$("#name").val().match($NameRegEx)) {
                $("#name_Validate").html('Invalid Name..!!');
                name = false;
            } else {
                name = true;
            }
        }

        $("#username_Validate").empty();
        if ($("#username").val() == "") {
            username = false;
            $("#username_Validate").html('(*) Username Required..!!');
        } else {
            if (!$("#username").val().match($NameRegEx)) {
                $("#username_Validate").html('Invalid Username..!!');
                username = false;
            } else {
                username = true;
            }
        }

        $("#password_Validate").empty();
        if ($("#password").val() == "") {
            password = false;
            $("#password_Validate").html('(*) Password Required..!!');
        } else {
            if (!$("#password").val().match($PasswordRegEx)) {
                $("#password_Validate").html('Invalid Password..!!');
                password = false;
            } else {
                password = true;
            }
        }

        $("#confirm_password_Validate").empty();
        if ($("#confirm_password").val() == "") {
            cpassword = false;
            $("#confirm_password_Validate").html('(*) Confirm Password Required..!!');
        } else {
            if (!$("#confirm_password").val().match($PasswordRegEx)) {
                $("#confirm_password_Validate").html('Invalid Confirm Password..!!');
                cpassword = false;
            } else {
                cpassword = true;
            }
        }

        if (name === true && username === true && password === true && cpassword === true && $("#password").val() === $("#confirm_password").val()) {
            var user_name = $("#name").val();
            var user_username = $("#username").val();
            var user_password = $("#password").val(); 
            $.ajax({
                url:'verification.php',
                method:'POST',
                data:{name:user_name,username:user_username,password:user_password,btnregister:'Register'},
                success:function(response){
                    if (response === 'success' && alertify.success('Account Created Successfully')) {
                        alertify.notify('Account Created Successfully', 'success', 2, function(){
                            window.location.href='login.php';
                        });
                    }
                    else {
                        alertify.error(response);
                    }
                }
            })
        }
        else {
            if ($("#password").val() != $("#confirm_password").val()) {
                $("#confirm_password_Validate").html('Confirm Password is not matching!!');
            }
            else {
                alertify.error('Enter All Fleid');
            }
        }
    });

    $("#buttonlogin").click(function(){
        $("#password_Validate").empty();
        if ($("#password").val() == "") {
            password = false;
            $("#password_Validate").html('(*) Password Required..!!');
        } else {
            if (!$("#password").val().match($PasswordRegEx)) {
                $("#password_Validate").html('Invalid Password..!!');
                password = false;
            } else {
                password = true;
            }
        }

        $("#username_Validate").empty();
        if ($("#username").val() == "") {
            username = false;
            $("#username_Validate").html('(*) Username Required..!!');
        } else {
            if (!$("#username").val().match($NameRegEx)) {
                $("#username_Validate").html('Invalid Username..!!');
                username = false;
            } else {
                username = true;
            }
        }

        if (username === true && password === true) {
            var user_username = $("#username").val();
            var user_password = $("#password").val();
            $.ajax({
                url:'verification.php',
                method:'POST',
                data:{username:user_username, password:user_password,btnlogin:'Login'},
                success:function(response){
                    if(response == "success" ) {
                        alertify.notify('Login Successfully', 'success', 2, function(){
                            window.location.href='index.php';
                        });
                    }
                }
            });
        }
        else {
            alertify.error('Enter All Fleid');
        }
    });

    function getProductData(){
        $.ajax({
            url:'fetch_data.php',
            method:'POST',
            success:function(response){
                var data = JSON.parse(response);
                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        $('.fetch_data').append(
                            "<tr>" +
                                "<td><input type='checkbox' name='multi_delete[]' class='check' value='"+ data[i].id +"'></td>" +
                                "<td>"+ data[i].id +"</td>" +
                                "<td>"+ data[i].name +"</td>" +
                                "<td>"+ data[i].details +"</td>" +
                                "<td>$"+ data[i].price +"</td>" +
                                "<td>"+ data[i].category +"</td>" +
                                "<td><img src=../Images/"+ data[i].images +" alt='demo' style='width:100px;'></td>" +
                                "<td>" +
                                    "<a href='update_product.php?product_id="+ btoa(data[i].id) +"' class='btn btn-outline-warning mr-2'><span class='fa fa-edit'></span></a>" +
                                    // "<a href='index.ph?id="+ btoa(data[i].id) +"' class='btn btn-outline-danger delete_product'><span class='fa fa-trash'></span></a>" +
                                    "<button type='button' class='btn btn-outline-danger delete_product' data-id='"+ data[i].id +"'><span class='fa fa-trash'></span></button>" +
                                "</td>" +  
                            "</tr>" 
                        );
                    }
                }
                else {
                    $('.fetch_data').append(
                        "<tr>" +
                            "<td colspan='8' class='text-center'>Item Not Found</td>" +
                        "</tr>"
                   );
                }
            }
        });
    }

    getProductData();

    $(document).on('click','.delete_product',function(){
        var id = $(this).attr('data-id');
        alertify.confirm('Delete Product', 'Do you want to delete this product?', function() { 
            window.location.href='index.php?id='+btoa(id);
        }, function() { 
            alertify.error('Cancel');
        });
    });

    $('#checkall').on('click',function(){
        if(this.checked){
            $('.check').each(function(){
                this.checked = true;
            });
        }else{
            $('.check').each(function(){
                this.checked = false;
            });
        }
    });

    function multiDeleteConfirm() {
        if($('.check:checked').length > 0){
            alertify.confirm("Multi Delete Confirm" , "Are you sure to delete selected product?", function(){
                return true;
            }, function(){
                return false;
            });
        }else{
            alertify.alert('Select at least 1 record to delete.');
            return false;
        }
    }

});