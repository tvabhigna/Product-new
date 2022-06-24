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
        console.log(formData);

        if(method == 'put'){
            formData.append('_method','PATCH')
        }
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
