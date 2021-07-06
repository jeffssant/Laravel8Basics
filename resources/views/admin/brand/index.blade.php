<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <b>Hello!! {{Auth::user()->name}}</b><br>
        </h2>
    </x-slot>

    <div class="py-12">


        <div class="container">
            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{session('success')}}
                    </div>
                @endif

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">All Category</div>
                        <table class="table">
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
                                    <tr>
                                        <th scope="row">{{$brand->id}}</th>
                                        <td>{{$brand->brand_name}}</td>
                                        <td><img src="/{{$brand->brand_image}}" alt="Logo"></td>
                                        <td>{{$brand->created_at->diffForHumans()}}</td>
                                        <td>
                                            <form action="{{url('softdelete/brand/'.$brand->id)}}" method="post">
                                                <a href="{{url('brand/edit/'.$brand->id)}}" class="btn btn-info">Edit</a>
                                                @csrf
                                                {{ method_field('delete') }}
                                                <button class="btn btn-danger" type="submit">Delete</button>
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
                                  <input type="text" class="form-control" name="brand_name" >
                                  @error('brand_name')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>

                                <div class="mb-3">
                                  <input type="file" class="form-control" name="brand_image" >
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

    </div>
</x-app-layout>
