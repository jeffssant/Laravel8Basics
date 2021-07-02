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
                        <div class="card-header">Edit Category</div>
                        <div class="card-body">
                            <form action="{{url('category/update/'.$category->id)}}" method="POST">

                                @csrf

                                <div class="mb-3">
                                  <input type="text" class="form-control" name="category_name" value="{{$category->category_name}}">
                                  @error('category_name')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Save Category</button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
