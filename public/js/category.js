    //   *  Insert company data

    $("body").on("click","#createNewCategory",function(e){
    
        e.preventDefault;
        $('#categoryForm').attr('action', store);
        $('#categoryTitleID').html("Add Category");
        $('#submit').val("Add");
        $('#formMethod').val("post");
        $('#categoryModal').modal('show');
        $('#category_id').val('');
        $('#categoryForm').trigger("reset"); 
    });

    // //Save data into database

    $("#categoryForm").submit(function(event) {
        event.preventDefault();
        var id = $("#category_id").val();
        let form = $(this);
        let url = form.attr('action');
        let formData = new FormData(this);
        let method = $(this).attr('method');

        if(method == 'put'){
            formData.append('_method','PATCH')
        }
        // console.log('hi');
        $.ajax({
            type:'POST',
            url: url,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            dataType: 'json',
            
            success: function (data) { 
                $('#categoryModal').modal('hide');
                          
                Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Success',
                showConfirmButton: false,
                })
                location.reload();
            },
            error: function (data) {
                console.log('Error......');       
                }
        });
    });

// show modal window 

$('body').on('click', '.modal-popup-view', function () {
    var view_url = $(this).data('url');
    $.ajax({
        url: view_url,
        type: 'GET',  // category.show

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
