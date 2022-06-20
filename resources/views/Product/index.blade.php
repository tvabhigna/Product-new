@extends('Product.layout')
@section('content')
<html>
    <body>
    <div class="container">
        <h3>Products</h3>
        <div>
            <!-- <a class="btn btn-primary" href="javascript:void(0)" id="createNewProduct">Create New</a> -->
            <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="createNewProduct">Add Product</a>

        </div>
        <div class="card">
        <table class="table table-hover text-center data-table">
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
    <!-- <script type="text/javascript">
  $(function () {
    
    var table = $('.data-table').DataTable({
        processing: false,
        serverSide: true,
        ajax: "{{ route('data') }}",
        columns: [
            {data: 'id', name: 'product_id'},
            {data: 'name', name: 'name'},
            {data: 'price', name: 'price'},
            {data: 'category',name: 'category'},
            {data: 'image',name: 'image'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script> -->
</body>

</html>

@endsection
@push('ajax_crud')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="/js/ajax.js"></script>

@endpush 