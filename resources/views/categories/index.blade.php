@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Categories</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('create-category')
                            <a href="{{ route('categories.create') }}" class="btn btn-warning">New Category</a>
                            @endcan
                            <table class="table table-striped mt-2">
                                <thead style="background-color: #e9302e">
                                    <th style="color: white">ID</th>
                                    <th style="color: white">Category</th>
                                    <th style="color: white">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{$category->id}}</td>
                                            <td>{{$category->name}}</td>
                                            <td>
                                                @can('edit-category')
                                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                                                @endcan
                                                @can('delete-category')
                                                    {!! Form::open(['method' => 'DELETE', 'route' =>['categories.destroy', $category->id], 'style' =>'display:inline', 'class' => 'delete',]) !!}
                                                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $categories->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page_js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('del') == 'ok')
        <script>
            Swal.fire(
                'Deleted!',
                'Your category has been deleted.',
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

