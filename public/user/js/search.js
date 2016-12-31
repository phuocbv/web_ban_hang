var search = function() {

    this.init = function(data) {
        var current = this;

        $('.metismenu').metisMenu();
        $(function() {
            $('#list-product').easyPaginate({
                paginateElement: 'div.block-product-category',
                elementsPerPage: 32,
                effect: 'climb'
            });
        });
    }
}
var search = new search();
search.init();
