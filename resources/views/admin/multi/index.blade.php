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
                    <div class="row">
                        @foreach ($multi as $image)
                            <div class="col-md-4 mt-5">
                                <img src="{{asset($image->image)}}" alt="" class="img-fluid">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Multi Image</div>
                        <div class="card-body">
                            <form action="{{route('add.image')}}" method="POST" enctype="multipart/form-data">

                                @csrf

                                <div class="mb-3">
                                  <input type="file" class="form-control" name="image[]"  multiple>
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
