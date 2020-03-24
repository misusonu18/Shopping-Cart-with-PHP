$(document).ready(function() {
    alertify.set('notifier', 'position', 'top-center');
    var status = 'success';
    var Sortby = 'id';

    function addItem(cartId, category) {
        $.ajax({
            url: 'ajax_crud.php',
            method: 'POST',
            data: { cart_id_add: cartId, category: category },
            success: function(response) {
                alertify.notify('Item Added Successfully', 'success', 2, function(){
                    window.location.href='index.php';
                });
            }
        });
    }
    
    function updateItem(cartId, category) {
        $.ajax({
            url: 'ajax_crud.php',
            method: 'POST',
            data: { cart_item_add: cartId, category: category },
            success: function(data) {
                alertify.notify('Item Increase Successfully', 'success', 2, function(){
                    window.location.href='index.php';
                });
            }
        });
    }

    function subtractItem(cartId, category) {
        $.ajax({
            url: 'ajax_crud.php',
            method: 'POST',
            data: { cart_item_subtract: cartId, category: category },
            success: function(data) {
                alertify.notify('Item Decrease Successfully', 'success', 2, function(){
                    window.location.href='index.php';
                });
            }
        });
    }

    function deleteItem(cartId, category) {
        $.ajax({
            url: 'ajax_crud.php',
            method: 'POST',
            data: { cart_item_delete: cartId, category: category },
            success: function(data) {
                alertify.notify('Item Deleted Successfully', 'success', 2, function(){
                    window.location.href='index.php';
                });
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
        var category = get_category('category');
        var data = 'data';
        $.ajax({
            url: 'fetch_data.php',
            method: 'POST',
            data:{category:category,data:data},
            success: function(records) {
                // alertify.alert(records);
                $(".cart_data").html(records);
                
            }
        });
    }

    function get_category(class_name) {
        var get_category = [];
        $('.' + class_name + ':checked').each(function() {
            get_category.push($(this).val());
        });
        return get_category;
    }

    fetchDataCart();

    $(document).on('change','.category',function(){
        var id = $(this).attr('data-id');
        fetchDataCart();
    });

});