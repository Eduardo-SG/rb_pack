@extends('layouts.app')

@section('content')
    @section('title', 'Registrar orden')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Registrar orden de trabajo</h3>
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
                          {!! Form::open(array('route'=>'orders.store', 'method'=> 'POST')) !!}
                          <div class="row">
                            <input type="hidden" name="user_id" value="">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class=" form-group">
                                    <label for="order_num">Número de orden</label>
                                    {!! Form::text('order_num', null, array('class'=>'form-control'))  !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class=" form-group">
                                    <label for="user_id">Usuario</label>
                                    {!! Form::text('user_id', auth()->id(), array('class'=>'form-control'))  !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <br>
                                <div class="form-group">
                                    <strong>Cliente</strong>
                                    <select name="client_id" class="form-control" id="">
                                        <option>Seleccione un cliente</option>
                                        @foreach ($clients as $key => $value)
                                            <option value="{{ $key }}" {{ ( $key == $selectedID) ? 'selected' : '' }}> 
                                            {{ $value }} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <br>
                                <div class="form-group">
                                    <strong>Número de parte</strong>
                                    <select name="part_id" class="form-control" id="">
                                        <option>Seleccione un número de parte</option>
                                        @foreach ($parts as $key => $value)
                                            <option value="{{ $key }}" {{ ( $key == $selectedID) ? 'selected' : '' }}> 
                                            {{ $value }} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <br>
                                <div class="form-group">
                                    <strong>Procesos</strong>
                                    <select name="process_id" class="form-control" id="">
                                        <option>Seleccione un proceso</option>
                                        @foreach ($processes as $key => $value)
                                            <option value="{{ $key }}" {{ ( $key == $selectedID) ? 'selected' : '' }}> 
                                            {{ $value }} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="process_name">Procesos</label>
                                    <br/>
                                    @foreach ($processes as $value)
                                        <label for="">{!! Form::checkbox('processes[]', $value->id, false, array('class'=>'name')) !!}
                                            {{$value->process_name}}
                                        </label>
                                        <br/>
                                    @endforeach
                                </div>
                            </div> --}}
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class=" form-group">
                                    <label for="due_date">Fecha de entrega</label>
                                    {!! Form::date('due_date', null, array('class'=>'form-control'))  !!}
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
