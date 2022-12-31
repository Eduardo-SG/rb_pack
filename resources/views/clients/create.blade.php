@extends('layouts.app')

@section('content')
    @section('title', 'Registrar cliente')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Registrar cliente</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                          {{-- validation --}}
                          @if ($errors->any())
                          <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>Revisa de nuevo</strong>
                            @foreach ($errors->all() as $error)
                                <span class="badge badge-danger">{{$error}}</span>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @endif
                          {!! Form::open(array('route'=>'clients.store', 'method'=> 'POST')) !!}
                          <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class=" form-group">
                                    <label for="client_name">Nombre del cliente</label>
                                    {!! Form::text('client_name', null, array('class'=>'form-control'))  !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class=" form-group">
                                    <label for="email">Correo electrónico</label>
                                    {!! Form::text('email', null, array('class'=>'form-control'))  !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class=" form-group">
                                    <label for="phone_num">Teléfono</label>
                                    {!! Form::text('phone_num', null, array('class'=>'form-control'))  !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
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
