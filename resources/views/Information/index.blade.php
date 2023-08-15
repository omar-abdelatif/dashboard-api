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
                                <li class="breadcrumb-item active">Personal Information</li>
                            </ol>
                            <button type="button" class="btn btn-success" data-coreui-toggle="modal" data-coreui-target="#add_info" data-coreui-whatever="@mdo">
                                <b>Add New Information</b>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
    <div class="modal fade" id="add_info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Information</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark">
                    <form action="{{route('infos.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group text-center mb-3">
                            <label class="text-white" for="name">
                                <b>Name</b>
                            </label>
                            <input type="text" name="name" id="name" class="form-control text-center" placeholder="Your Name">
                        </div>
                        <div class="form-group text-center mb-3">
                            <label for="age" class="text-white">
                                <b>Age</b>
                            </label>
                            <input type="number" class="form-control text-center" placeholder="Your Age" id="age" name="age" >
                        </div>
                        <div class="form-group text-center mb-3">
                            <label for="phone_number" class="text-white">
                                <b>Mobile Number</b>
                            </label>
                            <input type="number" class="form-control text-center" placeholder="Your Phone Numbr" id="phone_number" name="phone_number" >
                        </div>
                        <div class="form-group text-center mb-3">
                            <label for="address" class="text-white">
                                <b>Address</b>
                            </label>
                            <input type="text" class="form-control text-center" placeholder="Address" id="address" name="address" >
                        </div>
                        <div class="form-group text-center mb-3">
                            <label for="email" class="text-white">
                                <b>Work Email</b>
                            </label>
                            <input type="email" class="form-control text-center" placeholder="Your Work Email" id="email" name="email" >
                        </div>
                        <div class="form-group text-center mb-3">
                            <label for="img" class="text-white">
                                <b>Profile Image</b>
                            </label>
                            <input type="file" name="img" id="img" class="form-control text-center" accept="image/*">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success w-100 mt-3 text-center text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div id="success" class="alert alert-success w-50 mx-auto text-center mt-5">
                <p class="m-0">{{ session('success') }}</p>
            </div>
        @elseif ($errors->any())
            @foreach ($errors->all() as $error)
                <div id="error" class="alert alert-danger w-50 mx-auto text-center mt-5">
                    <p class="mb-0">{{ $error }}</p>
                </div>
            @endforeach
        @endif
        <?php $i = 1 ?>
        <table class="table text-center align-middle table-striped table-hover" id="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Work Email</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($infos as $info)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$info->name}}</td>
                        <td>{{$info->age}}</td>
                        <td>{{$info->phone_number}}</td>
                        <td>{{$info->address}}</td>
                        <td>{{$info->email}}</td>
                        <td>
                            <img src={{asset('assets/imgs/information/'.$info->img)}} width="50" class="rounded" alt={{$info->name}}>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning" data-coreui-toggle="modal" data-coreui-target="#edit_info{{$info->id}}">
                                <b>
                                    Edit
                                </b>
                            </button>
                            <div class="modal fade" id="edit_info{{$info->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Info {{$info->name}}</h5>
                                            <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body bg-dark">
                                            <form action="{{route('infos.update')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <input type="hidden" name="id" value="{{$info->id}}">
                                                    <div class="col-lg-6">
                                                        <div class="form-group text-center mb-3">
                                                            <label class="text-white" for="name">
                                                                <b>Name</b>
                                                            </label>
                                                            <input type="text" name="name" id="name" class="form-control text-center" value="{{$info->name}}" placeholder="Your Name">
                                                        </div>
                                                        <div class="form-group text-center mb-3">
                                                            <label for="age" class="text-white">
                                                                <b>Age</b>
                                                            </label>
                                                            <input type="number" class="form-control text-center" value="{{$info->age}}" placeholder="Your Age" id="age" name="age" >
                                                        </div>
                                                        <div class="form-group text-center mb-3">
                                                            <label for="phone_number" class="text-white">
                                                                <b>Mobile Number</b>
                                                            </label>
                                                            <input type="number" class="form-control text-center" value="{{$info->phone_number}}" placeholder="Your Phone Numbr" id="phone_number" name="phone_number" >
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group text-center mb-3">
                                                            <label for="address" class="text-white">
                                                                <b>Address</b>
                                                            </label>
                                                            <input type="text" class="form-control text-center" value="{{$info->address}}" placeholder="Address" id="address" name="address" >
                                                        </div>
                                                        <div class="form-group text-center mb-3">
                                                            <label for="email" class="text-white">
                                                                <b>Work Email</b>
                                                            </label>
                                                            <input type="email" class="form-control text-center" value="{{$info->email}}" placeholder="Your Work Email" id="email" name="email" >
                                                        </div>
                                                        <div class="form-group text-center mb-3">
                                                            <label for="img" class="text-white">
                                                                <b>Profile Image</b>
                                                            </label>
                                                            <input type="file" name="img" id="img" class="form-control text-center" value="{{$info->img}}" accept="image/*">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success w-100 mt-3 text-center text-white">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href={{route('infos.destroy', $info->id)}} class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
