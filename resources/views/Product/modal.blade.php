<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header shadow">
                <h4 class="modal-title" id="productCrudModal"></h4>
                <a href="{{ url('/products') }}" class="btn btn-primary shadow">Cancel</a>

            </div>

            <div class="modal-body container justify-content-center row">

                {{ Form::open(['route'=>'products.store','enctype'=>'multipart/form-data','id'=>'productdata']) }}
                @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif
                @csrf
                <input type="hidden" id="product_id" name="product_id" value="">
                <input type="hidden" name="_method" id="formMethod">

                <!-- data -->
                <div class="row">
                    <div class="col-md-9 col-12 mb-4">
                        <div class="row">
                            <label class="col-form-label">Product Name <span class="text-danger" id="nameError">*</span></label>
                            <div class="col">
                                {{ Form::text('name',Request::old('name'),array('id' => 'name','class'=>"form-control",'name'=>'name')) }}
                                <!-- @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 col-12 mb-4">
                        <div class="row">
                            <label class="col-form-label">Price<span class="text-danger" id="priceError">*</span></label>
                            <div class="col">
                                {{ Form::number('price',Request::old('price'),array('id' => 'price','class'=>"form-control",'name'=>'price')) }}
                                <!-- @if ($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                @endif -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 col-12 mb-4">
                        <div class="row">
                            <label class="col-form-label">Category<span class="text-danger" id="categoryError">*</span></label>
                            <div class="col">
                                {{ Form::text('category',Request::old('category'),array('id' => 'category','class'=>"form-control",'name'=>'category')) }}
                                <!-- @if ($errors->has('category'))
                                    <span class="text-danger">{{ $errors->first('category') }}</span>
                                @endif -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 col-12 mb-4">
                        <div class="row">
                            <label class="col-form-label">Photo <span class="text-danger" id="imageError">*</span></label>
                            <div class="col">
                                {{ Form::file('image',Request::old('image'),array('id' => 'image','class'=>"form-control",'name'=>'image')) }}
                                <!-- @if ($errors->has('image')) 
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif -->
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