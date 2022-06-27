@extends('master.layout')
@section('title')
Users
@endsection
@section('content')

<div class="card-body">
    <div class="card">
        <h3 class="card-header shadow text-muted text-center">Users
        <a href="javascript:void(0)" class="btn btn-sm btn-primary shadow" id="createNewuser">Add User</a>
    </h3>
    <div class="card-body shadow">
        <table class="table table-hover text-center shadow" ID="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Email Address</th>
                    <th>Password</th>
                    <th>User Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        @include('User.modal')
    </div>
</div>
<!-- View Modal Product-->
<div id="userView" class="modal" tabindex="-1">
    <div class="modal-dialog shadow-lg">
        <div class="modal-content bg-teal-300 view-table-bg">
            <div class="modal-header shadow">
                <h5 class="modal-title">{{'Details'}}</h5>
                <button type="button" class="close modal-close-btn-show" data-dismiss="modal" id="header_close_button_show">&times;
                </button>
            </div>

            <div class="modal-body">
                <table class="table table_for_view shadow">
                    <tbody id="modal-table-data_user">

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
            ajax: "{{ route('user') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'password',
                    name: 'password'
                },
                {
                    data: 'type',
                    name: 'type'
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

    var root_url_user = <?php echo json_encode(route('user')) ?>;
    var store_user = "{{route('users.store')}}";
    var update_user = "{{route('users.update','')}}";
</script>
<script src="/js/user.js"></script>

@endsection
@endsection