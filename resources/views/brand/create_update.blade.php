@extends('layout.master')
@section('title')
Brand
@endsection
@section('content')
<div class="card-body">
    <div class="card">
    <h3 class="card-header shadow text-muted text-center">Brands
        <a class="btn btn-sm btn-primary shadow" id="createNewCategory"href="{{ route('brands.create')}}" >Add brand</a>

    </h3>
    <div class="card-body shadow">  
        <h4 class="card-title">@if(isset($brand)) {{'Update'}} @else {{'Create'}} @endif {{'brand'}}</h4>
    
    @if(isset($brand))
            {{ Form::model($brand, ['route'=>['brands.update', $brand->id],'method'=>'put','enctype'=>'multipart/form-data','id'=>'brandForm']) }}
            @method('PUT')
        @else
            {{ Form::open(['route'=>'brands.store','enctype'=>'multipart/form-data','method'=>'post','id'=>'brandForm']) }}
        @endif
        @csrf
            <input type="hidden" id="brand_id" name="brand_id" value="">
            <!-- <input type="hidden" name="_method" id="brandFormMethod"> -->

                <div class="row">
                <div class="col-md-9 col-12 mb-4">
                    <div class="row">
                        <label class="col-form-label">Name<span class="text-danger">*</span></label>
                        <div class="col ">
                            {{ Form::text('name',Request::old('name'),array('id' => 'name','class'=>"form-control",'name'=>'name')) }}
                            <span class="text-danger name" style="display:none">{{ $errors->first('name') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 col-12 mb-6">
                        <div class="row">
                            <label class="col-form-label">Status<span class="text-danger">*</span></label>
                            <div class="col col-form-label text-md-middle">
                                <label class="radio-inline col-md-6 ">
                                @if(isset($brand))
                                <input type="radio" name="status" class="form-check-input inable" value="inable"{{ ($brand->status=="inable")? "checked" : "" }}>{{'Inable'}}
                                <!-- {{ Form::radio('type','user','', Request::old('type') ,array('id' => 'user','class'=>"form-check-input User",'name'=>'type')) }}{{'user'}} -->
                                <label class="radio-inline">
                                <input type="radio" name="status" class="form-check-input disable" value="disable"{{ ($brand->status=="disable")? "checked" : "" }}>{{'Disable'}}
                                <!-- {{ Form::radio('type','admin','', Request::old('type') ,array('id' => 'admin','class'=>"form-check-input Admin">'type')) }}{{'admin'}} -->
                                @else
                                <input type="radio" name="status" class="form-check-input inable" value="inable">{{'Inable'}}
                                <!-- {{ Form::radio('type','user','', Request::old('type') ,array('id' => 'user','class'=>"form-check-input User",'name'=>'type')) }}{{'user'}} -->
                                <label class="radio-inline">
                                <input type="radio" name="status" class="form-check-input disable" value="disable">{{'Disable'}}
                                <!-- {{ Form::radio('type','admin','', Request::old('type') ,array('id' => 'admin','class'=>"form-check-input Admin">'type')) }}{{'admin'}} -->
                                @endif

                                <span class="text-danger status" style="display:none">{{ $errors->first('status') }}</span>
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
            {{ Form::submit('Submit',array('class'=>'btn btn-primary')) }}
            {!! Form::close() !!}
</div>            
@endsection