var category = function() {
    this.data = {
        imageAwait: null,
    }
    this.init = function(data) {
        this.data.imageAwait = data.imageAwait;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        this.addEvent();
    }

    this.addEvent = function() {
        var current = this;
        $('.fa.fa-pencil.fa-fw.edit').on('click', function(event) {
            $.blockUI({ message: '<img src="' + current.data.imageAwait + '"/>' });
            current.editCategory($(this).data('id'));
        });
        $('.dataTables_paginate.paging_simple_numbers .paginate_button').on('click', function(event) {
            current.addEvent();
        });
    }

    this.editCategory = function(categoryId) {
        $.ajax({
            url: '/admin/category/' + categoryId + '/edit',
            type: 'GET',
        })
        .done(function(data) {
            $('#category-name').val(data.name);
            $('#category-name').attr('data-id', data.id);
            $.unblockUI();
            $('.modal#modalEdit').modal();
        });
        
    } 
}
