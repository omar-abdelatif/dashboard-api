@php
    use Illuminate\Support\Facades\Form;
@endphp
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
                                    <input type="text" name="title" id="title" class="form-control text-center" placeholder="Project Name">
                                </div>
                                <div class="form-group text-center mb-3">
                                    <label for="img" class="text-white">
                                        <b>Image</b>
                                    </label>
                                    <input type="file" name="img" id="img" class="form-control text-center">
                                </div>
                                <div class="form-group text-center mb-3">
                                    <label for="category" class="text-white">
                                        <b>Category</b>
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
                                <div class="form-group mb-3 text-center">
                                    <label for="admins" class="text-white">
                                        <b>Admins:</b>
                                    </label>
                                    <select name="author" id="admins" class="form-control text-center">
                                        <option value="">Select Admin...</option>
                                        @foreach ($admins as $admin)
                                            <option value={{$admin->name}}>{{$admin->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group text-center">
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
    <?php $i = 1; ?>
    <table class="table text-center align-middle table-striped table-hover mt-5" id="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Author</th>
                <th>Title</th>
                <th>Content</th>
                <th>Category</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $blog['author'] }}</td>
                    <td>{{ $blog['title'] }}</td>
                    <td>{{ $blog['content'] }}</td>
                    <td>{{ $blog['category'] }}</td>
                    <td>
                        <img src={{asset('assets/imgs/Blogs/'.$blog['img'])}} class="rounded-circle" width="50" alt={{$blog['title']}}>
                    </td>
                    <td>
                        {{-- Edit --}}
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" data-coreui-toggle="modal" data-coreui-target="#edit_project_{{$blog->id}}">
                            <b>
                                <i class="fa-regular fa-pen-to-square"></i>
                            </b>
                        </button>
                        <div class="modal fade" id="edit_project_{{$blog->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Project {{$blog->title}}</h5>
                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body bg-dark">
                                        <form action="{{route('blogs.update')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <input type="hidden" name="id" value="{{$blog->id}}">
                                                <div class="col-lg-12">
                                                    <div class="form-group text-center mb-3">
                                                        <label for="author" class="text-white">
                                                            <b>Author</b>
                                                        </label>
                                                        <select name="author" id="author" class="form-control text-center">
                                                            <option>Choose Category</option>
                                                            @foreach ($admins as $admin)
                                                                <option value="{{$admin->name}}" {{$blog->author == $admin->name ? 'selected' : ''}}>{{$admin->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group text-center mb-3">
                                                        <label for="title" class="text-white">
                                                            <b>Title</b>
                                                        </label>
                                                        <input type="text" name="title" id="title" value="{{$blog->title}}" class="form-control text-center">
                                                    </div>
                                                    <div class="form-group text-center mb-3">
                                                        <label for="category" class="text-white">
                                                            <b>Category</b>
                                                        </label>
                                                        <select name="category" id="category" class="form-control text-center">
                                                            <option>Choose Category</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{$category->title}}" {{$blog->category == $category->title ? 'selected' : ''}}>{{$category->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group text-center mb-3">
                                                        <label for="img" class="text-white">
                                                            <b>Image</b>
                                                        </label>
                                                        <input type="file" name="img" id="img" class="form-control text-center" value={{$blog->img}}>
                                                    </div>
                                                    <div class="form-group text-center mb-3">
                                                        <label for="content" class="text-white">
                                                            <b>Content</b>
                                                        </label>
                                                        <textarea name="content" class="form-control text-center pt-4" id="content" cols="30" rows="10">{{$blog->content}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success w-100">
                                                            <b>Update</b>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href={{route('blogs.destroy', $blog['id'])}} class="btn btn-danger">
                            <b>
                                <i class="fa-solid fa-trash text-white"></i>
                            </b>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
