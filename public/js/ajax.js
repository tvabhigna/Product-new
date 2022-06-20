
$(document).ready(function () {

    getData()
    
    $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    
    //Get all products
    function getData() {
        
        $.ajax({
            url: root_url,
            type:'GET',
            data: { }
        }).done(function(data){
            table_data_row(data.data)
        });
    }
    
    //Product table row
    function table_data_row(data) {
        // console.log('hi');
    
        var	rows = '';
        
        $.each( data, function( key, value ) {
            
              rows = rows + '<tr>';
              rows = rows + '<td>'+value.id+'</td>';
              rows = rows + '<td>'+value.name+'</td>';
              rows = rows + '<td>'+value.price+'</td>';
              rows = rows + '<td>'+value.category+'</td>';
              rows = rows + '<td>'+value.image+'</td>';

              rows = rows + '<td data-id="'+value.id+'">';
                    rows = rows + '<a class="btn btn-success" style="font-size: 0.8em;" id="showProduct" data-id="'+value.id+'" data-toggle="modal" data-target="#modal-id">Show</a> ';
                    rows = rows + '<a class="btn btn-primary" style="font-size: 0.8em;" id="editProduct" data-id="'+value.id+'" data-toggle="modal" data-target="#modal-id">Edit</a> ';
                    rows = rows + '<a class="btn btn-danger" style="font-size: 0.8em;" id="deleteProduct" data-id="'+value.id+'" >Delete</a> ';
                    rows = rows + '</td>';
              rows = rows + '</tr>';
        });
    
        $("tbody").html(rows);
    }
    /*
     * View Data Modal :  Start
     */
$('body').on('click','#showProduct',function () {
    var view_url = $(this).data('url');
    $.ajax({
        url:view_url,
        type: 'GET',  // students.show

        success:function (data) {
            var view_html = '';
            $.each(data,function(k,v){
                view_html +='<tr><td>'+k+'</td><th>'+v+'</th></tr>';
            });
            $('#modal-table-data').html(view_html);
            $('#showProduct').modal();
        }
    })
});
$('body').on('click', '.modal-close-btn-show', function() {
    $('#modal_for_view').hide();
});

    //Insert company data
    $("body").on("click","#createNewProduct",function(e){
    
        e.preventDefault;
        $('#productCrudModal').html("Create product");
        $('#submit').val("Create product");
        $('#modal-id').modal('show');
        $('#product_id').val('');
        $('#productdata').trigger("reset"); 
    
    });
    
    // //Save data into database
    // $('body').on('click','#submit', function (event) {

    //     event.preventDefault()
    //     // var id = $("#product_id").val();
    //     // var name = $("#name").val();
    //     // var price = $("#price").val();
    //     // var category = $("#category").val();
    //     // var image = $("#image").val();
    //     let formData = new FormData(this);

    //    console.log(image);
    //     $.ajax({
    //       url: store,
    //       type: "POST",
    //       data: formData,
    //       dataType: 'json',
    //       success: function (data) {

    //           $('#productdata').trigger("reset");
    //           $('#modal-id').modal('hide');
              
    //           Swal.fire({
    //             position: 'top',
    //             icon: 'success',
    //             title: 'Success',
    //             showConfirmButton: false,
                
    //           })
    //           location.reload();p
    //         },

    //       error: function (data) {
    //           console.log('Error......');       
               
    //       }
    //   });              
          
      
    // });
        // //Save data into database

    $("#productdata").submit(function(event) {
        // console.log('hi');

        event.preventDefault();
        var id = $("#product_id").val();

        let form = $(this);
        let url = form.attr('route');
        let formData = new FormData(this);
        $.ajax({

            type: 'POST',
            url: store,
            data: formData,
            dataType: 'json',
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {
// console.log('hi');  
                          $('#productdata').trigger("reset");
                          $('#modal-id').modal('hide');
                          
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


    //Edit modal window
    $('body').on('click', '#editProduct', function (event) {
    // console.log('hi');
        event.preventDefault();
        var id = $(this).data('id');

        $.get(store+'/'+ id+'/edit', function (data) {
            // var array = JSON.parse(data);
            // console.log(data);
            // console.log(data.data.name);
             $('#productCrudModal').html("Edit product");
             $('#submit').val("Edit product");
             $('#modal-id').modal('show');
             $('#product_id').val(data.data.id);
             $('#name').val(data.data.name);
             $('#price').val(data.data.price);
             $('#category').val(data.data.category);
             $('#image').val(data.data.image);
             $('#productdata').trigger("update"); 


         })
    });
    
     //DeleteCompany
     $('body').on('click', '#deleteProduct', function (event) {
        // if(!confirm("Do you really want to do this?")) {
        //    return false;
        //  }
        if(!confirm("Do you really want to do this?")) {
               return false;
             }
        
         event.preventDefault();
        var id = $(this).attr('data-id');
     
        $.ajax(
            {
              url: store+'/'+id,
              type: 'DELETE',
              data: {
                    id: id
            },
            
         });location.reload() 
       });
    
    }); 