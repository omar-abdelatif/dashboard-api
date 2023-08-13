@extends('layouts.app')
@section('title', 'Omar Abdelatif | ' . $pageTitle)
@section('header')
    <header class="header header-sticky mb-4 d-block">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 w-100">
                        <div class="w-100 d-flex align-items-baseline justify-content-between mt-2">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Services</li>
                            </ol>
                            <button type="button" class="btn btn-success" data-coreui-toggle="modal" data-coreui-target="#add_service" data-coreui-whatever="@mdo">
                                <b>Add Service</b>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
    <div class="modal fade" id="add_service" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Service</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark">
                    <form action="{{route('services.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group text-center mb-3">
                                    <label for="title" class="text-white">
                                        <b>Title</b>
                                    </label>
                                    <input type="text" class="form-control mb-3" name="title" id="title" placeholder="Service Title">
                                </div>
                                <div class="form-group text-center mb-3">
                                    <label for="img" class="text-white">
                                        <b>Image</b>
                                    </label>
                                    <input type="file" name="logo" id="img" class="form-control text-center" accept="image/*">
                                </div>
                                <div class="form-group text-center mb-3">
                                    <label for="description" class="text-white">
                                        <b>Description</b>
                                    </label>
                                    <textarea name="description" class="form-control text-center" placeholder="Services Description" id="description" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success w-100 mt-3 text-center text-white">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center mt-5">
            <p class="m-0">{{ session('success') }}</p>
        </div>
    @elseif ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger text-center mt-5">
                <p class="mb-0">{{ $error }}</p>
            </div>
        @endforeach
    @endif
    <?php $i = 1 ?>
    <table class="table text-center align-middle table-striped table-hover" id="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$service->title}}</td>
                    <td>{{$service->description}}</td>
                    <td>
                        <img src="{{asset('assets/imgs/services/'.$service->logo)}}" alt="{{$service->title}}" width="50">
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning" data-coreui-toggle="modal" data-coreui-target="#edit_service{{$service->id}}" data-coreui-whatever="@mdo">
                            <b>Edit</b>
                        </button>
                        <div class="modal fade" id="edit_service{{$service->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Service</h5>
                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body bg-dark">
                                        <form action="{{route('services.update')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <input type="hidden" name="id" value="{{$service->id}}">
                                                    <div class="form-group text-center mb-3">
                                                        <label for="title" class="text-white">
                                                            <b>Title</b>
                                                        </label>
                                                        <input type="text" class="form-control mb-3" value="{{$service->title}}" name="title" id="title" placeholder="Service Title">
                                                    </div>
                                                    <div class="form-group text-center mb-3">
                                                        <label for="img" class="text-white">
                                                            <b>Image</b>
                                                        </label>
                                                        <div class="img mb-3 mt-3">
                                                            <img src="{{asset('assets/imgs/services/'.$service->logo)}}" alt="{{$service->title}}" width="50">
                                                        </div>
                                                        <input type="file" name="logo" id="img" value="{{$service->logo}}" class="form-control text-center" accept="image/*">
                                                    </div>
                                                    <div class="form-group text-center mb-3">
                                                        <label for="description" class="text-white">
                                                            <b>Description</b>
                                                        </label>
                                                        <textarea name="description" class="form-control text-center" placeholder="Services Description" id="description" cols="30" rows="10">{{$service->description}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success w-100 mt-3 text-center text-white">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{url('delete_services/'.$service->id)}}" class="btn btn-danger">
                            <b>
                                Delete
                            </b>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
