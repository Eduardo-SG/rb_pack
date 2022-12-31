@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Create Product</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                          {{-- validation --}}
                          @if ($errors->any())
                          <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>Check again</strong>
                            @foreach ($errors->all() as $error)
                                <span class="badge badge-danger">{{$error}}</span>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @endif
                          {!! Form::open(array('route'=>'products.store', 'method'=> 'POST', 'enctype'=> 'multipart/form-data')) !!}
                          <div class="row">
                            <div class="col-xs-6 col-sm-12 col-md-6">
                                <div class=" form-group">
                                    <label for="name">Product name:</label>
                                    {!! Form::text('name', null, array('class'=>'form-control'))  !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-12 col-md-6">
                                <div class=" form-group">
                                    <label for="name">Product brand:</label>
                                    {!! Form::text('brand', null, array('class'=>'form-control'))  !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class=" form-group">
                                    <label for="image">Image</label>
                                    <input name="image" id="image" type="file"/>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-12 col-md-6">
                                <div class=" form-group">
                                    <label for="name">Product price:</label>
                                    {!! Form::text('price', null, array('class'=>'form-control'))  !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <br>
                                <div class="form-group">
                                    <strong>Category</strong>
                                    <select name="categoryid" class="form-control" id="">
                                        <option>Select a Category</option>
                                        @foreach ($categories as $key => $value)
                                            <option value="{{ $key }}" {{ ( $key == $selectedID) ? 'selected' : '' }}> 
                                            {{ $value }} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12"></div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                          {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
