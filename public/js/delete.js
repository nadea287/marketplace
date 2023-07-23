$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    deleteElementConfirm('.delete-product', 'tr', 'products');
    deleteElementConfirm('.delete-product-image', '.product-image', 'images');

    function deleteElementConfirm(button, structureToBeDeleted, type) {
        $(button).on('click', function () {
            const btn = this;
            let id = $(btn).data('id');
            if (confirm('Are you sure?')) {
               const wasDeleted = deleteItem(id, type);
               wasDeleted.then((data) => {
                   alert(data.data);
                   btn.closest(structureToBeDeleted).remove();
               }).catch(error => alert(JSON.parse(error.responseText).data))

            }
        })
    }

    function deleteItem(id, type) {
        return $.ajax({
            url: '/' + type + '/' + id,
            method: 'DELETE',
            data: id = id,
        }).done(function (result) {
            //
        }).fail(function (error) {
            //
        })
    }
})
