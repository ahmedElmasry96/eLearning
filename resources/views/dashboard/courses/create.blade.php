@extends('dashboard.layouts.master')
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('dashboard/courses.add')</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
					<div class="col-md-10 col-lg-10 mx-auto col-xl-10 d-block">
						<div class="card card-body pd-20 pd-md-40 border shadow-none">
							<form method="post" action="{{route('courses.store')}}" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<div class="row row-sm">
										<div class="col-sm-6">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.name')</label> <input class="form-control" required type="text" name="name" value="{{old('name')}}">
											@if($errors->has('name'))
												<p class="text-danger">{{ $errors->first('name') }}</p>
											@endif
										</div>
										<div class="col-sm-6">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.description')</label> 
											<textarea class="form-control" required name="description">{{old('description')}}</textarea>
											@if($errors->has('description'))
												<p class="text-danger">{{ $errors->first('description') }}</p>
											@endif
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row row-sm">
										<div class="col-sm-6">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.price') $</label> 
											<input class="form-control" type="number" required name="price" value="{{old('price')}}">
											@if($errors->has('price'))
												<p class="text-danger">{{ $errors->first('price') }}</p>
											@endif
										</div>
										<div class="col-sm-6">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.image')</label>
											<input class="form-control pd-r-80" required type="file" name="image" value="{{old('image')}}">
											@if($errors->has('image'))
												<p class="text-danger">{{ $errors->first('image') }}</p>
											@endif
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row row-sm">
										<div class="col-sm-6">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/sidebar.categories')</label>
											<select class="form-control" name="category">
												<option disabled selected>@lang('dashboard/app.choose_cat')</option>
												@foreach($categories as $cat)
													<option value="{{$cat->id}}">{{$cat->name}}</option>
												@endforeach
											</select>
											@if($errors->has('category'))
												<p class="text-danger">{{ $errors->first('category') }}</p>
											@endif
										</div>
										<div class="col-sm-6">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/sidebar.instructors')</label>
											<select class="form-control" name="instructor">
												<option disabled selected>@lang('dashboard/app.choose_instructor')</option>
												@foreach($instructors as $instructor)
													<option value="{{$instructor->id}}">{{$instructor->name}}</option>
												@endforeach
											</select>
											@if($errors->has('instructor'))
												<p class="text-danger">{{ $errors->first('instructor') }}</p>
											@endif
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row row-sm">
										<div class="col-sm-6">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.hours') $</label> 
											<input class="form-control" type="text" required name="hours" value="{{old('hours')}}">
											@if($errors->has('hours'))
												<p class="text-danger">{{ $errors->first('hours') }}</p>
											@endif
										</div>
									</div>
								</div>
								<button type="submit" class="btn btn-main-primary btn-block">@lang('dashboard/app.add')</button>
							</form>
						</div>
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection