@extends('website.layouts.master')
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Instructor</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Instructor</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                @foreach ($instructors as $instructor)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item bg-light">
                            <div class="overflow-hidden">
                                <img class="img-fluid" src="{{url($instructor->image)}}" alt="instructor image">
                            </div>
                            <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                                <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                    @if($instructor->facebook)<a class="btn btn-sm-square btn-primary mx-1" href="{{$instructor->facebook}}"><i class="fab fa-facebook-f"></i></a>@endif
                                    @if($instructor->twitter)<a class="btn btn-sm-square btn-primary mx-1" href="{{$instructor->twitter}}"><i class="fab fa-twitter"></i></a>@endif
                                    @if($instructor->instagram)<a class="btn btn-sm-square btn-primary mx-1" href="{{$instructor->instagram}}"><i class="fab fa-instagram"></i></a>@endif
                                </div>
                            </div>
                            <a href="{{route('website.instructor.details', $instructor->id)}}">
                                <div class="text-center p-4">
                                    <h5 class="mb-0">{{$instructor->name}}</h5>
                                    <small>{{$instructor->title}}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Team End -->
@endsection