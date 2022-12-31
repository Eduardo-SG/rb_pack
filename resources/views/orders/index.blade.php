@extends('layouts.app')

@section('content')
    @section('title', 'Ordenes')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Ordenes de Trabajo</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- @can('create-order') --}}
                            <a href="{{ route('orders.create') }}" class="btn btn-warning mb-3">Registrar orden de trabajo nueva</a>
                            {{-- @endcan --}}
                            <table class="table table-striped mt-2" id="table_id">
                                <thead style="background-color: #e9302e">
                                    <th style="color: white">ID</th>
                                    <th style="color: white">Número de orden</th>
                                    <th style="color: white">Usuario</th>
                                    <th style="color: white">Cliente</th>
                                    <th style="color: white">Número de parte</th>
                                    <th style="color: white">Proceso</th>
                                    <th style="color: white">Fecha de entrega</th>
                                    <th style="color: white">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->order_num}}</td>
                                            @foreach ($users as $key => $value)
                                            @if ($order->user_id == $key)
                                            <td>{{ $value }}</td>
                                            @endif
                                            @endforeach
                                            @foreach ($clients as $key => $value)
                                            @if ($order->client_id == $key)
                                            <td>{{ $value }}</td>
                                            @endif
                                            @endforeach
                                            @foreach ($parts as $key => $value)
                                            @if ($order->part_id== $key)
                                            <td>{{ $value }}</td>
                                            @endif
                                            @endforeach
                                            @foreach ($processes as $key => $value)
                                            @if ($order->process_id== $key)
                                            <td>{{ $value }}</td>
                                            @endif
                                            @endforeach
                                            <td>{{$order->due_date}}</td>
                                            <td>
                                                {{-- @can('edit-order') --}}
                                                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Editar</a>
                                                {{-- @endcan --}}
                                                {{-- @can('delete-order') --}}
                                                    {!! Form::open(['method' => 'DELETE', 'route' =>['orders.destroy', $order->id], 'style' =>'display:inline', 'class' => 'delete',]) !!}
                                                    {!! Form::submit('Eliminar', ['class'=>'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                {{-- @endcan --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $orders->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script language="JavaScript" type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js" defer></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js" defer ></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" ></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" ></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" ></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js" defer></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js" defer ></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js" defer ></script>
    <script type="text/javascript">
        $(document).ready( function () {
         $('#table_id').DataTable( {
             dom: 'Bfrtip',
             lengthMenu: [
                 [ 10, 25, 50, -1 ],
                 [ '10 columnas', '25 rows', '50 rows', 'Mostrar todo' ]
             ],
             columnDefs: [
                 {
                     targets: -1,
                     visible: true
                 }
             ],
             buttons: [
                 
                 'copy', 'csv', 'excel', 'pdf', 'pageLength',
                 {
                     extend: 'print',
                     exportOptions: {
                         columns: ':visible'
                     }
                 }, 'colvis'
              
             ]
         } );
     } );
    </script>
@endsection

@section('page_js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('del') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'La orden de trabajo ha sido eliminado.',
                'success'
            )
        </script>
    @endif
    <script>
        $('.delete').submit(function(e) {
            e.preventDefault();


            Swal.fire({
                title: '¿Está seguro?',
                text: "No podrá revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit()
                }
            })


        });
    </script>
    @endsection

