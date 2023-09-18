@extends('website.layouts.master')
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">{{$course->name}} Details</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">{{$course->name}} Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <div class="container-xxl py-5 course">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5 wow fadeInUp text-center" data-wow-delay="0.1s">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="{{url($course->image)}}" alt="course image">
                    </div>
                    <a class="btn btn-primary py-2 px-5 mt-4" href="">Play</a>
                </div>
                <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="courseInfo">
                        <h3>{{$course->name}}</h3>
                        <span><i class="fa fa-user"></i> {{$course->instructor->name}}</span>
                        <span><i class="fa fa-clock"></i> {{$course->hours}}</span>
                        <span><i class="fa fa-clock"></i> {{$course->created_at}}</span>
                        <div class="mt-2">
                            <h3 class="mb-0">${{$course->price}}</h3>
                            <div>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small>(0)</small>
                            </div>
                        </div>
                        <h5>Description:</h5>
                        <p class="lead">
                            {{$course->description}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection