@extends('admin.admin_master')

@section('admin')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All Category</div>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Brand Image </th>
                                <th scope="col">Created at Name</th>
                                <th scope="col">Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $brands as $brand)
                            <tr >
                                <th scope="row">{{$brand->id}}</th>
                                <td>{{$brand->brand_name}}</td>
                                <td><img src="{{asset($brand->brand_image)}}" alt="Logo" class="img-fluid w-50"></td>
                                <td>{{$brand->created_at->diffForHumans()}}</td>
                                <td>
                                    <form action="{{url('brand/delete/'.$brand->id)}}" method="post" class="row px-3">
                                        <a href="{{url('brand/edit/'.$brand->id)}}"
                                            class="btn btn-info col-12 mb-3">Edit</a>
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button class="btn btn-danger col-12" type="submit">Delete</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$brands->links()}}
                </div>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Add Brand</div>
                    <div class="card-body">
                        <form action="{{route('store.brand')}}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="mb-3">
                                <input type="text" class="form-control" name="brand_name">
                                @error('brand_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="file" class="form-control" name="brand_image">
                                @error('brand_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
