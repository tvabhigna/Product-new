@extends('layout.master')
@section('title')
Product
@endsection
@section('content')

<div class="card-body">
    <div class="card">
        <h3 class="card-header shadow text-muted text-center">Products
        <a href="javascript:void(0)" class="btn btn-sm btn-primary shadow" id="createNewProduct">Add Product</a>
    </h3>
    <div class="card-body shadow">
        <table class="table table-hover text-center shadow" ID="data-table">
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
        @include('product.modal')
    </div>
</div>
<!-- View Modal Product-->
<div id="productView" class="modal" tabindex="-1">
    <div class="modal-dialog shadow">
        <div class="modal-content bg-teal-300 view-table-bg ">
            <div class="modal-header shadow">
                <h5 class="modal-title">{{'Details'}}</h5>
                <button type="button" class="close modal-close-btn-show" data-dismiss="modal" id="header_close_button_show">&times;
                </button>
            </div>

            <div class="modal-body">
                <table class="table table_for_view shadow">
                    <tbody id="modal-table-data_product">

                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-black modal-close-btn-show shadow" data-dismiss="modal">{{'Close'}}</button>
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
            ajax: "{{ route('products.data') }}",
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
                    data: 'category_id',
                    name: 'category_id'
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

    var root_url_product = <?php echo json_encode(route('products.data')) ?>;
    var store_product = "{{route('products.store')}}";
    var update_product = "{{route('products.update','')}}";
</script>
<script src="/js/ajax.js"></script>

@endsection
@endsection