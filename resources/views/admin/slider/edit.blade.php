@extends('admin.admin_master')

@section('admin')

    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{session('success')}}
                    </div>
                @endif
                <h3>Home Slider</h3>
                <a href="{{route('add.slider')}}" class="btn btn-info float-right"> Edit Slider</a>

            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Sliders</div>
                    <div class="card-body">
                        <form action="{{url('/home/slider/update/'.$slider->id)}}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <input type="hidden" value="{{$slider->image}}" name="old_img">

                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control" placeholder="Title" name="title" value="{{$slider->title}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control" name="description" rows="3" value="{{$slider->description}}">{{$slider->description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlFile1">Image</label>
                                <input type="file" class="form-control-file" name="image" >
                            </div>
                            <img src="{{asset($slider->image)}}" alt="" class="img-fluid">
                            <div class="form-footer pt-4 pt-5 mt-4 border-top">
                                <button type="submit" class="btn btn-primary btn-default">Save</button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>

@endsection
