@extends('layouts.app')

@section('title', 'Omar Abdelatif | ' . $pageTitle)

@section('content')
    <div class="row mt-5">
        <div class="col-lg-3">
            <div class="card mb-4 text-white bg-primary-gradient">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Total Projects</h5>
                        <span>Total Projects</span>
                    </div>
                    <p class="count mb-0">{{$project_count}}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mb-4 text-white bg-info-gradient">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Total Skills</h5>
                        <span>Total Skills</span>
                    </div>
                    <p class="count mb-0">0</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mb-4 text-white bg-warning-gradient">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Total Services</h5>
                        <span>Total Services</span>
                    </div>
                    <p class="count mb-0">0</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mb-4 text-white bg-danger-gradient">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Total Blogs</h5>
                        <span>Total Blogs</span>
                    </div>
                    <p class="count mb-0">0</p>
                </div>
            </div>
        </div>
    </div>
@endsection
