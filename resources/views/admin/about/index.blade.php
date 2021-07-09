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
                <h3>Home About</h3>

            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{url('/home/about/update/')}}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control" placeholder="Title" name="title" value="{{$about->title}}">
                            </div>

                            <div class="form-group">
                                <label>Resumo</label>
                                <textarea id="teste" class="ckeditor form-control" name="short_dis" rows="3" value="{{$about->short_dis}}">{{$about->short_dis}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="ckeditor form-control" name="long_dis" rows="3" value="{{$about->long_dis}}">{{$about->long_dis}}</textarea>
                            </div>


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
