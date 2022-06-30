<div class="modal fade" id="userModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header shadow">
                <h4 class="modal-title" id="userTitleID"></h4>
                <a href="{{ url('/users') }}" class="btn btn-primary shadow">Cancel</a>

            </div>

            <div class="modal-body container justify-content-center row">

                {{ Form::open(['route'=>'users.store','enctype'=>'multipart/form-data','id'=>'userForm']) }}
                @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif
                @csrf
                <input type="hidden" id="user_id" name="user_id" value="">
                <input type="hidden" name="_method" id="userFormMethod">

                <!-- data -->
                <div class="row">
                    <div class="col-md-9 col-12 mb-4">
                        <div class="row">
                            <label class="col-form-label">User Name <span class="text-danger">*</span></label>
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
                            <label class="col-form-label">Email<span class="text-danger">*</span></label>
                            <div class="col">
                                {{ Form::text('email',Request::old('email'),array('id' => 'email','class'=>"form-control",'name'=>'email')) }}
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
                            <label class="col-form-label">Password<span class="text-danger" id="categoryError">*</span></label>
                            <div class="col">
                                {{ Form::text('password',Request::old('password'),array('id' => 'password','class'=>"form-control",'name'=>'password')) }}
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
                            <label class="col-form-label">User Type<span class="text-danger">*</span></label>
                            <div class="row mb-6 col-form-label text-md-strt">
                                <label class="radio-inline row-md-3">
                                {{ Form::radio('type','user','', Request::old('type') ,array('id' => 'user','class'=>"form-check-input",'name'=>'type')) }}{{'user'}}
                                <label class="radio-inline row-md-1">
                                {{ Form::radio('type','admin','', Request::old('type') ,array('id' => 'admin','class'=>"form-check-input",'name'=>'type')) }}{{'admin'}}
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