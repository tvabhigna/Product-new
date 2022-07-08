<div class="modal fade" id="productModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header shadow">
                <h4 class="modal-title" id="productTitleID"></h4>
                <a href="{{ url('/products') }}" class="btn btn-primary shadow">Cancel</a>

            </div>

            <div class="modal-body container justify-content-center row">

                {{ Form::open(['route'=>'products.store','enctype'=>'multipart/form-data','id'=>'productForm']) }}
                <!-- @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif -->
                @csrf
                <input type="hidden" id="product_id" name="product_id" value="">
                <input type="hidden" name="_method" id="productFormMethod">

                <!-- data -->
                <div class="row">
                    <div class="col-md-9 col-12 mb-4">
                        <div class="row">
                            <label class="col-form-label">Product Name <span class="text-danger" id="nameError">*</span></label>
                            <div class="col ">
                                {{ Form::text('name',Request::old('name'),array('id' => 'name','class'=>"form-control",'name'=>'name')) }}
                                <span class="text-danger name" style="display:none">{{ $errors->first('name') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 col-12 mb-4">
                        <div class="row">
                            <label class="col-form-label">Price<span class="text-danger" id="priceError">*</span></label>
                            <div class="col ">
                                {{ Form::number('price',Request::old('price'),array('id' => 'price','class'=>"form-control",'name'=>'price')) }}
                                <span class="text-danger price" style="display:none">{{ $errors->first('price') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 col-12 mb-4">
                        <div class="row">
                            <label class="col-form-label">Category<span class="text-danger" id="categoryError">*</span></label>
                            <div class="col ">
                                {{ Form::select('category_id', $categories, isset($categoryIds) ? $categoryIds : null, array('id' => 'category_id','class'=>"form-control select2"))}}
                                <span class="text-danger category_id" style="display:none">{{ $errors->first('category_id') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 col-12 mb-4">
                        <div class="row">
                        <!-- <img src='' id="edit_image" width="100px;" height="120" class="mt-2">
                            <p>Old image</p> -->
                            <label class="col-form-label">Photo <span class="text-danger" id="imageError">*</span></label>
                            <div class="col">
                                {{ Form::file('image',Request::old('image'),array('id' => 'image','class'=>"form-control",'name'=>'image')) }}
                                <span class="text-danger image" style="display:none">{{ $errors->first('image') }}</span>
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