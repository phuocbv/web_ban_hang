var category = function() {

    this.data = {
        parent_id: null,
        category_id: null,
    }

    this.dataSearch = {
        from: null,
        to: null,
    }

    this.init = function(data) {
        var current = this;
        this.data.parent_id = data.parent_id;
        this.data.category_id = data.category_id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $('.metismenu').metisMenu();
        current.paginate();
        current.hoverBlockProduct();
        if (current.data.parent_id == null) {
            var category_current = "#category_" + current.data.category_id;
            $(category_current).css('color', 'red');
            $(category_current).parent().addClass('active');
            $(category_current).next().attr('aria-expanded', 'true').addClass('in');
        } else {
            var root_category = "#category_" + current.data.parent_id;
            var category_current = "#sub_category_" + current.data.category_id;
            $(category_current).css('color', 'red');
            $(root_category).css('color', 'red');
            $(root_category).parent().addClass('active');
            $(root_category).next().attr('aria-expanded', 'true').addClass('in');
        }
        this.addEvent();
    }

    this.addEvent = function() {
        var current = this;
        $('#search-by-price').on('click', function(event) {
            current.dataSearch.from = $('#from').val();
            current.dataSearch.to = $('#to').val();
            if (current.dataSearch.from === '' || current.dataSearch.to === '') {
                alert(lang['rate']['not-fill']);

                return;
            }
            if (current.dataSearch.from > current.dataSearch.to) {
                alert(lang['input-false']);

                return;
            }
            current.searchProduct(current.data.category_id, current.dataSearch,
                current.loadProduct, current);
        });
        $('div.easyPaginateNav a').on('click', function() {
            current.hoverBlockProduct();
        });
    }

    this.searchProduct = function(category_id, data, callback, current) {
        $.ajax({
            url: '/category/' + category_id + '/searchProduct',
            type: 'POST',
            data: data,
        })
        .done(function(data) {
            callback(data, current);
            current.hoverBlockProduct();
        });
    }          

    this.loadProduct = function(data, current) {
        $('div.easyPaginateNav').remove();
        $('#list-product').html(data);
        current.paginate();
    }

    this.paginate = function() {
        $('#list-product').easyPaginate({
            paginateElement: 'div.block-product-category',
            elementsPerPage: 24,
            effect: 'climb'
        });
    }

    this.hoverBlockProduct = function() {
        $('.block-product-category').hover(
            function() {
                $(this).css('z-index', 1);
            }, function() {
                $(this).css('z-index', 0);
            }
        );
    }
}
