@extends('admin.admin_master')

@section('admin')
    <div class="container">
        <div class="row">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{session('success')}}
            </div>
            @endif


            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Brand</div>
                    <div class="card-body">
                        <form action="{{url('brand/update/'.$brand->id)}}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <input type="hidden" value="{{$brand->brand_image}}" name="old_img">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="brand_name" value="{{$brand->brand_name}}">
                                @error('brand_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">

                                <input type="file" class="form-control" name="brand_image" value="{{$brand->brand_image}}">
                                @error('brand_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <img src="{{asset($brand->brand_image)}}" alt="Logo {{$brand->brand_name}}"
                                    class="img-fluid mt-3">
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
