@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('dashboard/sidebar.slider')</span>
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
				<div class="card">
					@include('dashboard.alert-messages')
					<div class="card-header pb-0">
						<div class="d-flex justify-content-between">
							<h4 class="card-title mg-b-0">@lang('dashboard/sidebar.slider')</h4>
							@if(auth()->user()->can('create slider'))
								<a href="{{route('sliders.create')}}">
									<button class="btn btn-info btn-with-icon"><i class="typcn typcn-plus"></i>@lang('dashboard/slider.add')</button>
								</a>
							@endif
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table text-md-nowrap" id="example1">
								<thead>
									<tr>
										<th class="wd-15p border-bottom-0">#</th>
										<th class="wd-15p border-bottom-0">@lang('dashboard/app.image')</th>
										<th class="wd-25p border-bottom-0">@lang('dashboard/app.created_at')</th>
										<th class="wd-25p border-bottom-0">@lang('dashboard/app.actions')</th>
									</tr>
								</thead>
								<tbody>
									@foreach($sliders as $index => $slider)
										<tr>
											<td>{{$index + 1}}</td>
											<td><img src="{{url($slider->image)}}" width="150" height="100" alt="slider image"></td>
											<td>{{$slider->created_at->diffForHumans()}}</td>
											<td>
												@if(auth()->user()->can('edit slider'))
													<a href="{{route('sliders.edit', $slider->id)}}">
														<button class="btn btn-success btn-sm"><i class="typcn typcn-edit"></i></button>
													</a>
												@endif
												@if(auth()->user()->can('delete slider'))
													<form method="POST" action="{{route('sliders.destroy', $slider->id)}}" style="display: inline;">
														@csrf
														{{method_field('DELETE')}}
														<button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('{{trans("dashboard/app.confirm")}}')"><i class="ti-trash"></i></button>
													</form>
												@endif
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection