var addcart = function() {
    this.init = function(selector) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        this.addEvent(selector);       
    }

    this.addEvent = function(selector) {
        var current = this;
        $('.cart').on('click', selector, function(event) {
            event.preventDefault();
            current.addToCart($(this).attr('product-id'));
        });
    }

    this.addToCart = function(id) {
        $.ajax({
            url: '/user/cart',
            type: 'POST',
            data: {id: id},
        })
        .done(function(data) {
            if (data == 'success') {
                alert(lang['cart']['success']);
            } else if (data == 'not-found') {
                alert(lang['cart']['not-found']);
            } else {
                alert(lang['cart']['error']);
            }
        })
        .fail(function() {
            alert(lang['cart']['unauthenticated']);
        });
    }

    this.addToCartWithNumber = function(id, number) {
        $.ajax({
            url: '/user/cart',
            type: 'POST',
            data: {id: id, number: number},
        })
        .done(function(data) {
            alert(lang['cart'][data]);
        })
        .fail(function() {
            alert(lang['cart']['unauthenticated']);
        });
    }
}
