@extends('layouts.app')
@section('title', 'Omar Abdelatif | ' . $pageTitle)
@section('header')
    <header class="header header-sticky d-block">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 w-100">
                        <div class="w-100 d-flex align-items-baseline justify-content-between">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Blogs</li>
                            </ol>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#add_blog">
                                <b>Add New Blog</b>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
    <div class="modal fade" id="add_blog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark">
                    <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group text-center mb-3">
                                    <label for="title" class="text-white">
                                        <b>Title</b>
                                    </label>
                                    <input type="text" name="title" id="title" class="form-control text-center"
                                        placeholder="Project Name">
                                </div>
                                <div class="form-group text-center mb-3">
                                    <label for="img" class="text-white">
                                        <b>Image</b>
                                    </label>
                                    <input type="file" name="img" id="img" class="form-control text-center">
                                </div>
                                <div class="form-group text-center mb-3">
                                    <label for="category" class="text-white">
                                        <b>
                                            Category
                                        </b>
                                    </label>
                                    <select name="category" id="category" class="form-control text-center">
                                        <option value="">Select category...</option>
                                        @foreach ($categories as $category)
                                            <option value={{$category->title}}>{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group text-center mb-3">
                                    <label for="content" class="text-white">
                                        <b>Content:</b>
                                    </label>
                                    <textarea class="form-control pt-3 text-center" placeholder="Content Here" name="content"></textarea>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit"
                                        class="btn btn-success w-100 mt-3 text-center text-white">Submit</button>
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
    <?php $i = 1; ?>
    <table class="table text-center align-middle table-striped table-hover mt-5" id="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Author</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{ $blog['title'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
