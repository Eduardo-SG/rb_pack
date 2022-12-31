@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Products</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('create-product')
                            <a href="{{ route('products.create') }}" class="btn btn-warning">New Product</a>
                            @endcan
                            <table class="table table-striped mt-2 display nowrap" id="table_id">
                                <thead style="background-color: #e9302e">
                                    <th style="color: white">ID</th>
                                    <th style="color: white">Name</th>
                                    <th style="color: white">Brand</th>
                                    <th style="color: white">Price</th>
                                    <th style="color: white">Category</th>
                                    <th style="color: white">Image</th>
                                    <th style="color: white">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{$product->id}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->brand}}</td>
                                            <td>{{$product->price}}</td>
                                            @foreach ($categories as $key => $value)
                                            @if ($product->categoryid == $key)
                                            <td>{{ $value }}</td>
                                            @endif
                                            @endforeach
                                            <td width="120px">
                                                <img src="/img/{{$product->image}}" width="100px" alt="{{$product->image}}">
                                            </td>
                                            <td>
                                                @can('edit-product')
                                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                                                @endcan
                                                @can('delete-product')
                                                    {!! Form::open(['method' => 'DELETE', 'route' =>['products.destroy', $product->id], 'style' =>'display:inline', 'class' => 'delete',]) !!}
                                                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $products->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
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
                     visible: false
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

@section('page_js'){
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('del') == 'ok')
        <script>
            Swal.fire(
                'Deleted!',
                'Your product has been deleted.',
                'success'
            )
        </script>
    @endif
    <script>
        $('.delete').submit(function(e) {
            e.preventDefault();


            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit()
                }
            })
        });
    </script>
    @endsection
}