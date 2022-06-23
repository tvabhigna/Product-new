<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title" id="productCrudModal">@if(isset($product)) {{'Update'}} @else {{'Create'}} @endif {{'Product'}}</h4>
                <a href="{{ url('/products') }}" class="btn btn-primary">Cancel</a>

            </div>

            <div class="modal-body container justify-content-center row">

            {{ Form::open(['route'=>'products.store','enctype'=>'multipart/form-data','id'=>'productdata']) }}
                <!-- <form id="productdata" enctype="multipart/formdata" action="{{route('products.store')}}"> -->
                    <input type="hidden" id="product_id" name="product_id" value="">
                    <input type="hidden" name="_method" id="formMethod">

                    <!-- data -->
                    <div class="row">
                    <div class="col-md-6 col-12 mb-4">
                        <div class="row">
                            <label class="col-form-label">Product Name <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                            {{ Form::text('name',Request::old('name'),array('id' => 'name','class'=>"form-control",'name'=>'name')) }}
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="row">
                    <div class="col-md-6 col-12 mb-4">
                        <div class="row">
                            <label class="col-form-label">Price<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                            {{ Form::number('price',Request::old('price'),array('id' => 'price','class'=>"form-control",'name'=>'price')) }}
                                @if ($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12 mb-4">
                        <div class="row">
                            <label class="col-form-label">Category<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                            {{ Form::text('category',Request::old('category'),array('id' => 'category','class'=>"form-control",'name'=>'category')) }}
                                @if ($errors->has('category'))
                                    <span class="text-danger">{{ $errors->first('category') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12 mb-4">
                        <div class="row">
                            <label class="col-form-label">Photo <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                            {{ Form::file('image',Request::old('image'),array('id' => 'image','class'=>"form-control",'name'=>'image')) }}
                                @if ($errors->has('image')) 
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                    {{ Form::submit('Submit',array('class'=>'btn btn-primary','id'=>'submit')) }}

                    {!! Form::close() !!}
            </div>

        </div>
    </div>
</div> 
<!-- delete modal -->
<div id="modal_delete_warning" class="modal fade" tabindex="-1">
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
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="button" class="btn bg-warning modal-delete-confirm">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- /delete modal -->