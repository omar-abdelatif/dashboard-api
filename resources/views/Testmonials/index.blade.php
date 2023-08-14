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
                                <li class="breadcrumb-item active">Testmonials</li>
                            </ol>
                            <button type="button" class="btn btn-success" data-coreui-toggle="modal" data-coreui-target="#add_testmonial" data-coreui-whatever="@mdo">
                                <b>Add Testmonials</b>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
    <div class="modal fade" id="add_testmonial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Testmonial</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark">
                    <form action="{{route('testmonials.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group text-center mb-3">
                                    <label class="text-white" for="client_name">
                                        <b>Client Name</b>
                                    </label>
                                    <input type="text" name="client_name" id="client_name" placeholder="Client Name" class="form-control text-center">
                                </div>
                                <div class="form-group text-center mb-3">
                                    <label class="text-white" for="title">
                                        <b>Title</b>
                                    </label>
                                    <input type="text" name="title" id="title" placeholder="Title" class="form-control text-center">
                                </div>
                                <div class="form-group text-center mb-3">
                                    <label for="img" class="text-white">
                                        <b>Image</b>
                                    </label>
                                    <input type="file" name="img" id="img" class="form-control text-center" accept="image/*">
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
            <th>#</th>
            <th>Client Name</th>
            <th>Tite</th>
            <th>Image</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($testmonials as $testmonial)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$testmonial->client_name}}</td>
                    <td>{{$testmonial->title}}</td>
                    <td>
                        <img src={{asset('assets/imgs/testmonials/'.$testmonial->img)}} class="rounded" width="50" alt={{$testmonial->img}}>
                    </td>
                    <td>
                        {{-- ! edit ! --}}
                        <button type="button" class="btn btn-warning" data-coreui-toggle="modal" data-coreui-target="#edit_testmonial{{$testmonial->id}}">
                            <b>
                                <i class="fa-regular fa-pen-to-square"></i>
                            </b>
                        </button>
                        <div class="modal fade" id="edit_testmonial{{$testmonial->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Testmonial {{$testmonial->title}}</h5>
                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body bg-dark">
                                        <form action="{{route('testmonials.update')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value={{$testmonial->id}}>
                                            <div class="form-group mb-3 text-center">
                                                <label for="client_name" class="text-white">
                                                    <b>Client Name</b>
                                                </label>
                                                <input type="text" name="client_name" id="client_name" value='{{$testmonial->client_name}}' placeholder="Client Name" class="form-control text-center">
                                            </div>
                                            <div class="form-group mb-3 text-center">
                                                <label for="title" class="text-white">
                                                    <b>Title</b>
                                                </label>
                                                <input type="text" name="title" id="title" value='{{$testmonial->title}}' placeholder="Title" class="form-control text-center">
                                            </div>
                                            <div class="form-group mb-3 text-center">
                                                <label for="img" class="text-white">
                                                    <b>Image</b>
                                                </label>
                                                <input type="file" name="img" id="img" value={{$testmonial->img}} class="form-control text-center">
                                            </div>
                                            <div class="form-group mb-3 text-center">
                                                <button class="btn btn-success w-100 text-center" type="submit">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ! Delete ! --}}
                        <a href={{route('testmonials.destroy', $testmonial->id)}} class="btn btn-danger">
                            <b>
                                <i class="fa-solid fa-trash"></i>
                            </b>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
