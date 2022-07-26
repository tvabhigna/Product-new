@extends('layout.master')
@section('title')
Brand
@endsection
@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
<div class="card-body">
    <div class="card">
    <h3 class="card-header shadow text-muted text-center">Brands
        <a class="btn btn-sm btn-primary shadow" id="createNewBrand"href="{{route('brands.create')}}" data-url="{{route('brands.create')}}">Add brand</a>
        <!-- <a href="javascript:;" data-url="' . url('categories/' . $data->id) . '" class="modal-popup-view btn btn-outline-primary ml-1 legitRipple shadow">Show</i></a> -->

    </h3>
    <div class="card-body shadow">
        <table class="table table-hover text-center shadow" ID="data-table">
            <thead class="thead">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="tbody">

            </tbody>
        </table>
        @include('category.modal')

    </div>
</div>
<!-- View Modal Brand-->
<div id="brandView" class="modal" tabindex="-1">
    <div class="modal-dialog shadow-lg">
        <div class="modal-content bg-teal-300 view-table-bg">
            <div class="modal-header shadow">
                <h5 class="modal-title">{{'Details'}}</h5>
                <button type="button" class="close modal-close-btn-show" data-dismiss="modal" id="header_close_button_show">&times;
                </button>
            </div>

            <div class="modal-body">
                <table class="table table_for_view shadow">
                    <tbody id="modal-table-data_brand">

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

<script type="text/""javascript">
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
            ajax: "{{ route('brands.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'category_id',
                    name: 'category_id'
                },
                {
                    data: 'status',
                    name: 'status'
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

    var root_url_brand = "{{route('brands.data')}}";
    var store_brand = "{{route('brands.store')}}";
    var update_brand = "{{route('brands.update','')}}";
    var show_image = "{{route('brands.image','')}}";
    var store_category = "{{route('categories.store')}}";

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="/js/brand.js"></script>
<script src="/js/category.js"></script>
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->


@endsection
@endsection