@extends('Product.layout')
@section('content')
    <body>
    <div class="container">
        <h3>Products</h3>
        <div>
            <!-- <a class="btn btn-primary" href="javascript:void(0)" id="createNewProduct">Create New</a> -->
            <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="createNewProduct">Add Product</a>

        </div>
        <div class="card">
        <table class="table table-hover text-center data-table"id="data-table">
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
  <script type="text/javascript">
//     $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//         });
// </script>
// <script type="text/javascript">
//         jQuery(function () {
//             window.dataGridTable = jQuery('#data-table').DataTable({
//                 processing: false,
//                 serverSide: true,
//                 responsive: true,          
//         ajax: "{{ route('data') }}",
//         columns: [
//             // console.log('hi');
//             {data: 'id', name: 'id'},
//             // {data: 'image', name: 'image',"render": function (data, type, full, meta) {
//             //     return "<img src=\"/public/imageable/",data}},            
//             {data: 'name', name: 'name'},
//             {data: 'price', name: 'price'},
//             {data: 'category', name: 'category'},
//             // {data: 'image', name: 'image'},
//             {data: 'action', name: 'action',orderable: true, searchable: false, paging: true,},
//         ]
//         // alert(0);
//     });
    
//   });
</script>
</body>


@endsection
@push('ajax_crud')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="/js/ajax.js"></script>

@endpush 