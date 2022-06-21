<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title" id="productCrudModal">@if(isset($product)) {{'Update'}} @else {{'Create'}} @endif {{'Product'}}</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                <a href="{{ url('/products') }}" class="btn btn-primary">Cancel</a>

            </div>

            <div class="modal-body container justify-content-center row">
            <!-- @if(isset($product)) -->

            <!-- {{ Form::model($product, ['route'=>['products.update',$product->id],'method'=>'patch','enctype'=>'multipart/form-data']) }} -->
        <!-- @else -->
            {{ Form::open(['route'=>'products.store','enctype'=>'multipart/form-data','method'=>'post','id'=>'productdata']) }}
        <!-- @endif -->
        @csrf
                <!-- <form id="productdata" enctype="multipart/formdata" action="{{route('products.store')}}"> -->
                    <input type="hidden" id="product_id" name="product_id" value="">
                    <input type="hidden" name="_method" id="formMethod">

                    <!-- data -->
                    <div class="row">
                    <div class="col-md-6 col-12 mb-4">
                        <div class="row">
                            <label class="col-form-label">Product Name <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                            {{ Form::text('name',Request::old('name'),array('id' => 'name','class'=>"form-control")) }}
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
                            {{ Form::number('price',Request::old('price'),array('id' => 'price','class'=>"form-control")) }}
                            <!-- <input type="number" id="price" name="price" value=""> -->
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
                            {{ Form::text('category',Request::old('category'),array('id' => 'category','class'=>"form-control")) }}
                            <!-- <input type="text" id="category" name="category" value=""> -->
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
                            {{ Form::file('image',Request::old('image'),array('id' => 'image','class'=>"form-control")) }}
                            <!-- <input type="file" id="image" name="image" value=""> -->
                                @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- <input type="submit" value="Submit" id="submit" class="btn btn-sm btn-danger py-0" style="font-size: 0.8em;"> -->
                    {{ Form::submit('Submit',array('class'=>'btn btn-primary')) }}
                    <!-- <a href="{{ url('/products') }}" class="btn btn-primary">submit</a> -->

                    {!! Form::close() !!}
            </div>

        </div>
    </div>
</div> 