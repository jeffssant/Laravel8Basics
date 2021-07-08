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
                <a href="{{route('add.slider')}}" class="btn btn-info float-right"> Add Slider</a>

            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Sliders</div>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $sliders as $slider)
                            <tr >
                                <th scope="row">{{$slider->id}}</th>
                                <td>{{$slider->title}}</td>
                                <td>{{$slider->description}}</td>
                                <td><img src="{{asset($slider->image)}}" alt="Logo" class="img-fluid w-50"></td>
                                <td>
                                    <form action="{{url('home/slider/delete/'.$slider->id)}}" method="post" class="row px-3">
                                        <a href="{{url('home/slider/edit/'.$slider->id)}}"
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

                </div>

            </div>

        </div>
    </div>

@endsection
