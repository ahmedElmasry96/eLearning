@extends('website.layouts.master')
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">{{$instructor->name}} Details</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">{{$instructor->name}} Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <div class="container-xxl py-5 instructor">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 wow fadeInUp text-center" data-wow-delay="0.1s">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="{{url($instructor->image)}}" alt="instructor image">
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="instructorInfo">
                        <h4>{{$instructor->name}} ({{$instructor->title}})</h4>
                        <h6>Description:</h6>
                        <p>
                            {{$instructor->description}}
                        </p>
                    </div>
                    <div class="card" style="width: 23rem;">
                        <div class="card-header">
                          Courses
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($instructor->courses as $course)
                                <li class="list-group-item">
                                    <a href="{{route('website.course.details', $course->id)}}"><h5>{{$course->name}}</h5></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="instructorContact">
                        <h5 class="mb-3">Get In Touch</h5>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fa fa-phone-alt"></i>
                                <div class="ms-3">
                                    <p class="mb-0">{{$instructor->phone}}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fa fa-envelope-open"></i>
                                <div class="ms-3">
                                    <p class="mb-0">{{$instructor->email}}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                @if($instructor->facebook)<a class="social-icon btn btn-outline-dark btn-social" href="{{$instructor->facebook}}"><i class="fab fa-facebook-f"></i></a>@endif
                                @if($instructor->twitter)<a class="social-icon btn btn-outline-dark btn-social" href="{{$instructor->twitter}}"><i class="fab fa-twitter"></i></a>@endif
                                @if($instructor->instagram)<a class="social-icon btn btn-outline-dark btn-social" href="{{$instructor->instagram}}"><i class="fab fa-instagram"></i></a>@endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection