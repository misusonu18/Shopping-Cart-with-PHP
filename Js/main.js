$(document).ready(function() {
    alertify.set('notifier', 'position', 'top-center');
    var status = 'success';

    function addItem(cartId, catagory) {
        $.ajax({
            url: 'ajax_crud.php',
            method: 'POST',
            data: { cart_id_add: cartId, catagory: catagory },
            success: function(response) {
                alertify.success("Item Added Successfully");                
                window.open('','_self');
            }
        });
    }

   
    function updateItem(cartId, catagory) {
        $.ajax({
            url: 'ajax_crud.php',
            method: 'POST',
            data: { cart_item_add: cartId, catagory: catagory },
            success: function(data) {
                alertify.success("Item Increase Successfully");
            }
        });
    }

    function subtractItem(cartId, catagory) {
        $.ajax({
            url: 'ajax_crud.php',
            method: 'POST',
            data: { cart_item_subtract: cartId, catagory: catagory },
            success: function(data) {
                alertify.success("Item Decrease Successfully");
            }
        });
    }

    function deleteItem(cartId, catagory) {
        $.ajax({
            url: 'ajax_crud.php',
            method: 'POST',
            data: { cart_item_delete: cartId, catagory: catagory },
            success: function(data) {
                alertify.success("Item Deleted Successfully");
            }
        });
    }

    $(document).on("click", ".button-cart", function() {
        addItem(parseInt($(this).attr('data-cart-id')), "AddItem");    
    });

    $(document).on("click", ".cart-item-add", function() {
        updateItem(parseInt($(this).attr('data-cart-id')), "UpdateItem");
    });

    $(document).on("click", ".cart-item-subtract", function() {
        subtractItem(parseInt($(this).attr('data-cart-id')), "SubtractItem");
    });

    $(document).on("click", ".cart-item-delete", function() {
        deleteItem(parseInt($(this).attr('data-cart-id')), "DeleteItem");
    });

    function fetchDataCart() {
        $.ajax({
            url: 'fetch_data.php',
            method: 'POST',
            success: function(records) {
                var cart_data = JSON.parse(records);
                if (cart_data.length > 0) {
                    for (let i = 0; i < cart_data.length; i++) {
                        $('.cart_data').append( 
                            "<div class='card ml-5 mb-5' style='width: 15rem;'>" +
                                "<img src='images/" + cart_data[i].images + "' alt='demo' class='card-img-top'>" +
                                "<div class='card=body'>" +
                                    "<p class='h5 font-weight-bold'>" + cart_data[i].name + "</p>" +
                                    "<p class='lead text-justify text-truncate text-muted'>" + cart_data[i].details + "</p>" +
                                    "<p class='h5 text-center font-weight-bold'>$" + cart_data[i].price + "</p>" +
                                    "<div class='text-center'>" +
                                        "<button class='btn btn-info btn-lg rounded-pill button-cart' id='button-cart' data-cart-id='" + cart_data[i].id + "' data-cart-name='" + cart_data[i].name + "' data-cart-details='" + cart_data[i].details + "' data-cart-price='" + cart_data[i].price + "' data-cart-image='" + cart_data[i].images + "'> " +
                                            "Add to cart" +
                                        "</button>" +
                                    "</div>" +
                                "</div>" +
                            "</div>" 
                        );
                    }
                }
            }
        });
    }


    fetchDataCart();

});