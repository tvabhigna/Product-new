//   *  Insert company data

$("body").on("click", "#createNewProduct", function (e) {

    e.preventDefault;
    $('#productdata').attr('action', store);
    $('#productCrudModal').html("Create product");
    $('#submit').val("Create product");
    $('#formMethod').val("post");
    $('#modal-id').modal('show');
    $('#product_id').val('');
    $('#productdata').trigger("reset");
});

// //Save data into database

$("#productdata").submit(function (event) {
    event.preventDefault();
    var id = $("#product_id").val();
    let form = $(this);
    let url = form.attr('action');
    let formData = new FormData(this);
    let method = $(this).attr('method');
    if (method == 'put') {
        formData.append('_method', 'PATCH')
    }
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (category) {
            $('#categoryModal').modal('hide');
            Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Success',
                showConfirmButton: false,
            })
            location.reload();
        },
        error: function (category) {
            console.log('Error......');
        }
    });
});

// show modal window 

$('body').on('click', '.modal-popup-view', function () {
    var view_url = $(this).data('url');
    $.ajax({
        url: view_url,
        type: 'GET',  // products.show

        success: function (data) {
            var view_html = '';
            $.each(data, function (k, v) {
                view_html += '<tr><td>' + k + '</td><th>' + v + '</th></tr>';
            });
            $('#modal-table-data').html(view_html);
            $('#modal_for_view').show();
        }
    })
});
$('body').on('click', '.modal-close-btn-show', function () {
    $('#modal_for_view').hide();
});

//Edit modal window
$('body').on('click', '#editProduct', function (event) {
    event.preventDefault();
    $('#productdata').trigger("reset");
    var id = $(this).data('id');
    $.get(store + '/' + id + '/edit', function (data) {
        $('#productdata').attr('action', update + '/' + data.data.id);
        $('#formMethod').val("put");
        $('#productCrudModal').html("Edit product");
        $('#submit').val("Edit product");
        $('#modal-id').modal('show');
        $('#product_id').val(data.data.id);
        $('#name').val(data.data.name);
        $('#price').val(data.data.price);
        $('#category').val(data.data.category);
        $('#image').val(data.data.image);
    })
});

// / Delect Record popup-> 
$('body').on('click', '.modal-popup-delete', function (e) {
    var del_url = $(this).data('url');
    $('.modal-delete-confirm').attr('data-url', del_url);
    $('#modal_delete_warning').show();
});
$('body').on('click', '.modal-close-btn-delete', function () {
    $('#modal_delete_warning').hide();
});

// delete record from database 
$('body').on('click', '.modal-delete-confirm', function () {
    var id = $(this).attr('data-url');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: id,
        type: 'DELETE',  // products.destroy
        dataType: 'json',

        success: function (result) {
            $('#modal_delete_warning').modal("hide");
            location.reload();
        }
    });
});

