@extends('website.layouts.master')
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Courses</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Courses</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
    
    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-5">{{$category->name}} Courses</h1>
            </div>
            <div>
                <div>
                    <div class="position-relative mx-auto mb-5" style="max-width: 600px;border: 1px solid #ddd;">
                        <input id="search" name="search" class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Enter Course Name">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <div id="courses" class="row g-4 justify-content-start">
                    @foreach($courses as $course)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="course-item bg-light">
                                <div class="position-relative overflow-hidden">
                                    <img class="img-fluid" src="{{url($course->image)}}" alt="">
                                    <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                        <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a>
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
    </div>
    <!-- Courses End -->
@endsection
@section('js')
    <script>
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        $(document).ready(function () {
            var asset = "{{asset('')}}";
            var categoryId = "{{$category->id}}";
            console.log(categoryId);
            $('#search').on('keyup', function(){
                var value = $(this).val();
                $.ajax({
                    type: "get",
                    url: `/categoryCourses/${categoryId}/search`,
                    data: {'search':value},
                    success: function (data) {
                        $('#courses').empty();
                        if (data.length > 0) {
                            data.forEach(d => {
                                $('#courses').append('<div class="col-lg-4 col-md-6"><div class="course-item bg-light"><div class="position-relative overflow-hidden"><img class="img-fluid" src="'+ asset + d.image +'" alt=""><div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4"><a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a></div></div><div class="text-center p-4 pb-0"><h3 class="mb-0">$'+d.price +'</h3><div class="mb-3"><small class="fa fa-star text-primary"></small><small class="fa fa-star text-primary"></small><small class="fa fa-star text-primary"></small><small class="fa fa-star text-primary"></small><small class="fa fa-star text-primary"></small><small>(0)</small></div><h5 class="mb-4">'+ d.name +'</h5></div><div class="d-flex border-top"><small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>'+ d.instructorName +'</small><small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>'+ d.hours +' Hrs</small><small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>'+ d.students_number +' Students</small></div></div></div>');
                            });
                        } else {
                            $('#courses').append('<div class="text-center">There is no courses with this name</div>');
                        }
                    }
                });

            });
        });
    </script>
@endsection