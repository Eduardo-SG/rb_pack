@extends('layouts.app')

@section('content')
    @section('title', 'Usuarios')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Usuarios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- tabla con usuarios --}}
                            {{-- @can('create-user') --}}
                            <a class="btn btn-warning" href="{{ route('users.create')}}">Registrar nuevo usuario</a>
                            <div><br></div>
                            {{-- @endcan --}}
                            {{-- <form action="{{route('users.index')}}" method="get">
                                <div class="col-md-6">
                                    <label for="min">Minimum Date: </label>
                                    <input type="date" id="min" name="min" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="max">Maximum Date: </label>
                                    <input type="date" id="max" name="max" class="form-control">
                                    <button type="submit" class="btn btn-primary mt-3 mb-3">Filter</button>
                                </div>
                            </form> --}}
                            <table class="table table-striped mt-2 display nowrap" id="table_id">
                                <thead style="background-color: #e9302e">
                                    <th style="color: white">ID</th>
                                    <th style="color: white">Nombre</th>
                                    <th style="color: white">Correo</th>
                                    <th style="color: white">Rol</th>
                                    <th style="color: white">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>  
                                            <td>{{$user->name}}</td>  
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @if (!empty($user->getRoleNames()))
                                                    @foreach ($user->getRoleNames() as $roleName)
                                                        <h5><span class="badge badge-dark">{{$roleName}}</span></h5>
                                                        
                                                    @endforeach
                                                    
                                                @endif    
                                            </td>
                                            <td>
                                                {{-- @can('edit-user') --}}
                                                <a class="btn btn-warning" href="{{ route('users.edit', $user->id) }}">Editar</a>
                                                {{-- @endcan --}}
                                                {{-- @can('delete-user') --}}
                                                {!! Form::open(['method' => 'DELETE', 'route'=> ['users.destroy', $user->id], 'style' => 'display: inline', 'class' => 'delete',]) !!}
                                                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                                {{-- @endcan --}}
                                            </td>
                                        </tr>     
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {{-- {!! $users->links() !!} --}}
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
                'EL usuario ha sido eliminado.',
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
