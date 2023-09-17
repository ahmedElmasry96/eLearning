@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('dashboard/app.edit')</span>
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
							<form method="post" action="{{route('settings.update', $setting->id)}}" enctype="multipart/form-data">
								@csrf
								{{method_field('PUT')}}
								<div class="form-group">
									<div class="row row-sm">
										<div class="col-sm-6">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.logo')</label>
											<input class="form-control pd-r-80" type="file" name="logo" value="{{old('logo')}}">
											@if($setting->logo)
											<img class="mt-2" src="{{url($setting->logo)}}" width="50" height="50" alt="logo">
											@endif
											@if($errors->has('logo'))
												<p class="text-danger">{{ $errors->first('logo') }}</p>
											@endif
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row row-sm">
										<div class="col-md-4">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.website_name')</label> 
											<input class="form-control" type="text" name="website_name" value="{{$setting->website_name}}" required>
											@if($errors->has('website_name'))
												<p class="text-danger">{{ $errors->first('website_name') }}</p>
											@endif
										</div>
										<div class="col-md-4">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.email')</label> 
											<input class="form-control" type="email" name="email" value="{{$setting->email}}" required>
											@if($errors->has('email'))
												<p class="text-danger">{{ $errors->first('email') }}</p>
											@endif
										</div>
										<div class="col-sm-4">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.phone')</label> 
											<input type="text" class="form-control" name="phone" value="{{$setting->phone}}" required>
											@if($errors->has('phone'))
												<p class="text-danger">{{ $errors->first('phone') }}</p>
											@endif
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row row-sm">
										<div class="col-md-6">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.address')</label> 
											<input class="form-control" type="text" name="address" value="{{$setting->address}}" required>
											@if($errors->has('address'))
												<p class="text-danger">{{ $errors->first('address') }}</p>
											@endif
										</div>
										<div class="col-sm-6">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.copyright')</label> 
											<input type="text" class="form-control" name="copyright" value="{{$setting->copyright}}" required>
											@if($errors->has('copyright'))
												<p class="text-danger">{{ $errors->first('copyright') }}</p>
											@endif
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row row-sm">
										<div class="col-md-6">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.facebook')</label> 
											<input class="form-control" type="text" name="facebook" value="{{$setting->facebook}}">
											@if($errors->has('facebook'))
												<p class="text-danger">{{ $errors->first('facebook') }}</p>
											@endif
										</div>
										<div class="col-sm-6">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.twitter')</label> 
											<input type="text" class="form-control" name="twitter" value="{{$setting->twitter}}">
											@if($errors->has('twitter'))
												<p class="text-danger">{{ $errors->first('twitter') }}</p>
											@endif
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row row-sm">
										<div class="col-md-4">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.linkedin')</label> 
											<input class="form-control" type="text" name="linkedin" value="{{$setting->linkedin}}">
											@if($errors->has('linkedin'))
												<p class="text-danger">{{ $errors->first('linkedin') }}</p>
											@endif
										</div>
										<div class="col-sm-4">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.youtube')</label> 
											<input type="text" class="form-control" name="youtube" value="{{$setting->youtube}}">
											@if($errors->has('youtube'))
												<p class="text-danger">{{ $errors->first('youtube') }}</p>
											@endif
										</div>
										<div class="col-sm-4">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.instagram')</label> 
											<input type="text" class="form-control" name="instagram" value="{{$setting->instagram}}">
											@if($errors->has('instagram'))
												<p class="text-danger">{{ $errors->first('instagram') }}</p>
											@endif
										</div>
									</div>
								</div>
								<button class="btn btn-main-primary btn-block">@lang('dashboard/app.edit')</button>
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
@section('js')
@endsection