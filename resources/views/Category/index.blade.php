@extends('master.layout')
@section('title')
Category
@endsection
@section('content')

    <div>
        <h3 align="center" class="card-header center">Categories</h3>
        <div class="card-body">
            <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="createNewCategory">Add Category</a>
        </div>
        <div class="card">
            <table class="table table-hover text-center" ID="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            @include('Category.modal')
        </div>
    </div>
<!-- View Modal Category-->
<div id="categoryView" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content bg-teal-300 view-table-bg">
                    <div class="modal-header">
                        <h5 class="modal-title">{{'Details'}}</h5>
                        <button type="button" class="close modal-close-btn-show" data-dismiss="modal" id="header_close_button_show">&times;
                        </button>
                    </div>

                    <div class="modal-body">
                        <table class="table table_for_view">
                            <tbody id="modal-table-data_category">

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
@section('script')

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script type="text/javascript">
    jQuery(function() {
        window.dataGridTable = jQuery('#data-table').DataTable({
            processing: false,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('category') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: false,
                    paging: true,
                },
            ]
        });

    });
            
    var root_url_category = <?php echo json_encode(route('category')) ?>;
    var store_category = "{{route('categories.store')}}";
    var update_category = "{{route('categories.update','')}}";

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="/js/category.js"></script>


@endsection
@endsection