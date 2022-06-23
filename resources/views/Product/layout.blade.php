<html>
    <head>
        <title>Products</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    
        <!-- yajra datatable -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    </head>
    <body>
    <!-- View Modal -->
    <div id="modal_for_view" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content bg-teal-300 view-table-bg">
                    <div class="modal-header">
                        <h5 class="modal-title">{{'Details'}}</h5>
                        <button type="button" class="close modal-close-btn-show" data-dismiss="modal"
                                id="header_close_button_show">&times;
                        </button>
                    </div>

                    <div class="modal-body">
                        <table class="table table_for_view">
                            <tbody id="modal-table-data">
                            @foreach ($data as $images)

                            <img src="{{ URL::asset('storage/images'.$images->image) }}" border="0" width="100" height="100" class="img-rounded" align="center" />
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-black modal-close-btn-show" data-dismiss="modal">{{'Close'}}</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- /view modal  -->
        <!-- delete modal -->
    <div id="modal_delete_warning" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h6 class="modal-title">Warning!!</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h6 class="font-weight-semibold">Are you sure you want to delete this record ?</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link modal-close-btn-delete" data-dismiss="modal">Close</button>
                <button type="button" class="btn bg-warning modal-delete-confirm">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- /delete modal --> 
        @yield('content')
        <script>
        var root_url = <?php echo json_encode(route('data')) ?>;
        var store = "{{route('products.store')}}";
        var update = "{{route('products.update','')}}";

    </script>

    @stack('ajax_crud')
    </body>
</html>