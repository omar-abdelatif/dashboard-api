@extends('layouts.app')
@section('title', 'Omar Abdelatif | ' . $pageTitle)
@section('header')
    <header class="header header-sticky mb-4 d-block">
        <div class="container-fluid">
            <button class="header-toggler px-md-0 me-md-3" type="button"
                onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                <svg class="icon icon-lg">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-menu') }}"></use>
                </svg>
            </button>
            <a class="header-brand d-md-none" href="#">
                <svg width="118" height="46" alt="CoreUI Logo">
                    <use xlink:href="{{ asset('icons/brand.svg#full') }}"></use>
                </svg>
            </a>
            <ul class="header-nav d-none d-md-flex">
                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
            </ul>
            <ul class="header-nav ms-auto">

            </ul>
            <ul class="header-nav ms-3">
                <li class="nav-item dropdown">
                    <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pt-0">
                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                            <svg class="icon me-2">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                            </svg>
                            {{ __('My profile') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <svg class="icon me-2">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-account-logout') }}"></use>
                                </svg>
                                {{ __('Logout') }}
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        <div class="header-divider"></div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 w-100">
                        <div class="w-100 d-flex align-items-baseline justify-content-between mt-2">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Tags</li>
                            </ol>
                            <button type="button" class="btn btn-success" data-coreui-toggle="modal" data-coreui-target="#add_tags" data-coreui-whatever="@mdo">
                                <b>Add Tag</b>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
    <div class="modal fade" id="add_tags" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('tags.store')}}" method="post">
                        @csrf
                        <div class="form-group text-center mb-3">
                            <label for="title">
                                <b>Title</b>
                            </label>
                            <input type="text" name="title" id="title" class="form-control text-center" placeholder="Tag Name">
                        </div>
                        <button type="submit" class="btn btn-success w-100 mt-3 text-center text-white">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
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
        <table class="table text-center align-middle table-striped table-hover" id="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1 ?>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$tag->title}}</td>
                        <td>
                            {{-- edit --}}
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit_tag{{$tag->id}}">
                                <b>
                                    Edit
                                </b>
                            </button>
                            <div class="modal fade" id="edit_tag{{$tag->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Tag {{$tag->title}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body bg-dark">
                                            <form action="{{route('tags.update')}}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <input type="hidden" name="id" value="{{$tag->id}}">
                                                        <div class="form-group text-center mb-3">
                                                            <label for="title" class="text-white">
                                                                <b>Title</b>
                                                            </label>
                                                            <input type="text" name="title" id="title" class="form-control text-center" value="{{$tag->title}}">
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
                            {{-- delete --}}
                            <a href={{route('tags.destroy',$tag->id)}} class="btn btn-danger">
                                <span>
                                    <b>
                                        Delete
                                    </b>
                                </span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
