<x-app-layout>
    <x-slot name="header">
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
                                <th scope="col">User Id</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Created At </th>

                              </tr>
                            </thead>
                            <tbody>
                                @foreach ( $categories as $category)
                                    <tr>
                                        <th scope="row">{{$category->id}}</th>
                                        <td>{{$category->user_id}}</td>
                                        <td>{{$category->category_name}}</td>
                                        <td>{{$category->created_at->diffForHumans()}}</td>
                                        {{-- <td>{{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</td> --}} {{--Usar diff com query builder --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
