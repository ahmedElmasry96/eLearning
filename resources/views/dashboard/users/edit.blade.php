@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('dashboard/users.edit', ['name' => $user->name])</span>
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
							<form method="post" action="{{route('users.update', $user->id)}}">
								@csrf
								{{method_field('PUT')}}
								<div class="form-group">
									<div class="row row-sm">
										<div class="col-sm-6">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.name')</label> <input class="form-control" required type="text" name="name" value="{{$user->name}}">
											@if($errors->has('name'))
												<p class="text-danger">{{ $errors->first('name') }}</p>
											@endif
										</div>
										<div class="col-sm-6">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.email')</label> <input class="form-control" required type="email" name="email" value="{{$user->email}}">
											@if($errors->has('email'))
											<p class="text-danger">{{ $errors->first('email') }}</p>
										@endif
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.password')</label>
									<input class="form-control pd-r-80" type="password" name="password" value="{{old('password')}}">
									@if($errors->has('password'))
									<p class="text-danger">{{ $errors->first('password') }}</p>
								@endif
								</div>
								<div class="form-group">
									<div class="row row-sm">
										<div class="col-sm-6">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.phone')</label>
											<input class="form-control pd-r-80" required type="text" name="phone" value="{{$user->phone}}">
											@if($errors->has('phone'))
											<p class="text-danger">{{ $errors->first('phone') }}</p>
										@endif
										</div>
										<div class="col-sm-6">
											<label class="main-content-label tx-11 tx-medium tx-gray-600">@lang('dashboard/app.age')</label>
											<input class="form-control pd-r-80" type="number" name="age" value="{{$user->age}}">
											@if($errors->has('age'))
												<p class="text-danger">{{ $errors->first('age') }}</p>
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