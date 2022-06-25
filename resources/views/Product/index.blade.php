@extends('master.layout')
@section('title')
Product
@endsection
@section('content')

    <div>
        <h3 align="center" class="card-header center">Products</h3>
        <div class="card-body">
            <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="createNewProduct">Add Product</a>
        </div>
        <div class="card">
            <table class="table table-hover text-center" ID="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            @include('Product.modal')
        </div>
    </div>
<!-- View Modal Product-->
<div id="modal_for_view" class="modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content bg-teal-300 view-table-bg">
                    <div class="modal-header">
                        <h5 class="modal-title">{{'Details'}}</h5>
                        <button type="button" class="close modal-close-btn-show" data-dismiss="modal" id="header_close_button_show">&times;
                        </button>
                    </div>

                    <div class="modal-body">
                        <table class="table table_for_view">
                            <tbody id="modal-table-data">

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
            ajax: "{{ route('data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'image',
                    name: 'image'
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

    var root_url_product = <?php echo json_encode(route('data')) ?>;
    var store_product = "{{route('products.store')}}";
    var update_product = "{{route('products.update','')}}";

</script>
<script src="/js/ajax.js"></script>
 
@endsection
@endsection