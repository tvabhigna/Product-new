<div class="modal fade" id="categoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="categoryTitleID"></h4>
                <a href="{{ url('/categories') }}" class="btn btn-primary">Cancel</a>

            </div>

            <div class="modal-body container justify-content-center row">

            <!-- {{ Form::open(['route'=>'products.store','enctype'=>'multipart/form-data','id'=>'productdata']) }} -->
            {{ Form::open(['route'=>'categories.store','enctype'=>'multipart/form-data','id'=>'categoryForm']) }}
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            @csrf
                    <input type="hidden" id="category_id" name="category_id" value="">
                    <input type="hidden" name="_method" id="categoryFormMethod">

                    <!-- data -->
                    <div class="row">
                    <div class="col-md-9 col-12 mb-4">
                        <div class="row">
                            <label class="col-form-label">Category Name <span class="text-danger" id="nameError">*</span></label>
                            <div class="col">
                            {{ Form::text('name',Request::old('name'),array('id' => 'name','class'=>"form-control",'name'=>'name')) }}
                                <!-- @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
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