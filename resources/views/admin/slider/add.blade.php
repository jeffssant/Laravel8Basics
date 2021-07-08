@extends('admin.admin_master')

@section('admin')

<div class="col-12">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
    @endif
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create Slider</h2>
        </div>
        <div class="card-body">
            <form action="{{route('store.slider')}}" enctype="multipart/form-data" method="POST">
                @csrf

                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" placeholder="Title" name="title">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1">Image</label>
                    <input type="file" class="form-control-file" name="image">
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
