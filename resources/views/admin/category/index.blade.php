<x-app-layout>
    <x-slot name="header">
        @php
            //dd($categories)
        @endphp
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{--   {{ __('Dashboard') }} --}}

          <b>Hello!! {{Auth::user()->name}}</b><br>
          <b class="float-end ">Total Categories: <span class="badge bg-danger"> {{count($categories)}} </span></b>
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div> --}}

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
                                <th scope="col">Category Name</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Created At </th>
                                <th scope="col">Action </th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ( $categories as $category)
                                    <tr>
                                        <th scope="row">{{$category->id}}</th>
                                        <td>{{$category->category_name}}</td>
                                        <td>{{$category->user->name}}</td>
                                        <td>{{$category->created_at->diffForHumans()}}</td>
                                        {{-- <td>{{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</td> --}} {{--Usar diff com query builder --}}

                                        <td>
                                            <form action="{{url('softdelete/category/'.$category->id)}}" method="post">
                                                <a href="{{url('category/edit/'.$category->id)}}" class="btn btn-info">Edit</a>
                                                @csrf
                                                {{ method_field('delete') }}
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$categories->links()}}
                    </div>
                    @if (!$trachCat->isEmpty())

                        <div class="card mt-5">
                            <div class="card-header">Excludes Categories</div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Deletad At </th>
                                    <th scope="col">Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $trachCat as $cat)
                                        <tr>
                                            <th scope="row">{{$cat->id}}</th>
                                            <td>{{$cat->category_name}}</td>
                                            <td>{{$cat->user->name}}</td>
                                            {{-- <td>{{$cat->deletad_at->diffForHumans()}}</td> --}}
                                            <td>{{ Carbon\Carbon::parse($cat->created_at)->diffForHumans() }}</td> {{--Usar diff com query builder --}}

                                            <td>

                                                <form action="{{url('category/pdelete/'.$cat->id)}}" method="post">
                                                    <a href="{{url('category/restore/'.$cat->id)}}" class="btn btn-info">Restore</a>
                                                    @csrf
                                                    {{ method_field('delete') }}
                                                    <button class="btn btn-danger" type="submit">P Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$trachCat->links()}}
                        </div>

                    @endif

                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Category</div>
                        <div class="card-body">
                            <form action="{{route('store.category')}}" method="POST">

                                @csrf

                                <div class="mb-3">
                                  <input type="text" class="form-control" name="category_name" >
                                  @error('category_name')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Add Category</button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
