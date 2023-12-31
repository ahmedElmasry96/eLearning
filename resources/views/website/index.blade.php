@extends('website.layouts.master')
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            @foreach($sliders as $slider)
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{url($slider->image)}}" alt="slider image">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-sm-10 col-lg-8">
                                    <h5 class="text-primary text-uppercase mb-3 animated slideInDown">{{$slider->slogan}}</h5>
                                    <h1 class="display-3 text-white animated slideInDown">{{$slider->title}}</h1>
                                    <p class="fs-5 text-white mb-4 pb-2">{{$slider->paragraph}}</p>
                                    <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">{{$slider->button_title}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                @foreach($services as $service)
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item text-center pt-3">
                            <div class="p-4">
                                <img src="{{url($service->image)}}" class="img-responsive" width="50" height="50" alt="service image">
                                <h5 class="mb-3 mt-3">{{$service->title}}</h5>
                                <p>{{$service->description}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="{{url($about->image)}}" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                    <h1 class="mb-4">{{$about->title}}</h1>
                    <p class="mb-4">{{substr($about->description, 0, 300)}}...</p>
                    <a class="btn btn-primary py-3 px-5 mt-2" href="{{route('website.about')}}">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    @if($categories)
    <!-- Categories Start -->
    <div class="container-xxl py-5 category">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Categories</h6>
                <h1 class="mb-5">Courses Categories</h1>
            </div>
            <div class="row g-3">
                <div class="col-lg-7 col-md-6">
                    <div class="row g-3">
                        <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                            <a class="position-relative d-block overflow-hidden" href="{{route('website.categoryCourses', $categories[0]->id)}}">
                                <img class="img-fluid" src="{{url($categories[0]->image)}}" alt="Category image">
                                <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                                    <h5 class="m-0">{{$categories[0]->name}}</h5>
                                    <small class="text-primary">{{count($categories[0]->courses)}} Courses</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                            <a class="position-relative d-block overflow-hidden" href="{{route('website.categoryCourses', $categories[1]->id)}}">
                                <img class="img-fluid" src="{{url($categories[1]->image)}}" alt="Category image">
                                <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                                    <h5 class="m-0">{{$categories[1]->name}}</h5>
                                    <small class="text-primary">{{count($categories[1]->courses)}} Courses</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                            <a class="position-relative d-block overflow-hidden" href="{{route('website.categoryCourses', $categories[2]->id)}}">
                                <img class="img-fluid" src="{{url($categories[2]->image)}}" alt="Category image">
                                <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                                    <h5 class="m-0">{{$categories[2]->name}}</h5>
                                    <small class="text-primary">{{count($categories[2]->courses)}} Courses</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                    <a class="position-relative d-block h-100 overflow-hidden" href="{{route('website.categoryCourses', $categories[3]->id)}}">
                        <img class="img-fluid position-absolute w-100 h-100" src="{{url($categories[3]->image)}}" alt="Category image" style="object-fit: cover;">
                        <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin:  1px;">
                            <h5 class="m-0">{{$categories[3]->name}}</h5>
                            <small class="text-primary">{{count($categories[3]->courses)}} Courses</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Categories End -->
    @endif


    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
                <h1 class="mb-5">Popular Courses</h1>
            </div>
            <div class="row g-4 justify-content-start">
                @foreach($courses as $course)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="course-item bg-light">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid" src="{{url($course->image)}}" alt="course image">
                                <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                    <a href="{{route('website.course.details', $course->id)}}" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 30px">Join Now</a>
                                </div>
                            </div>
                            <div class="text-center p-4 pb-0">
                                <h3 class="mb-0">${{$course->price}}</h3>
                                <div class="mb-3">
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small>(0)</small>
                                </div>
                                <h5 class="mb-4">{{$course->name}}</h5>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>{{$course->instructor->name}}</small>
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>{{$course->hours}} Hrs</small>
                                <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>{{$course->students_number}} Students</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Courses End -->


    <!-- Instructor Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Instructors</h6>
                <h1 class="mb-5">Expert Instructors</h1>
            </div>
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
    <!-- Instructor End -->

@endsection