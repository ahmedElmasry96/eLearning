@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ @lang('dashboard/sidebar.instructors')</span>
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
							<h4 class="card-title mg-b-0">@lang('dashboard/sidebar.instructors')</h4>
							@if(auth()->user()->can('create instructor'))
								<a href="{{route('instructors.create')}}">
									<button class="btn btn-info btn-with-icon"><i class="typcn typcn-plus"></i>@lang('dashboard/instructors.add')</button>
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
										<th class="wd-15p border-bottom-0">@lang('dashboard/app.name')</th>
										<th class="wd-20p border-bottom-0">@lang('dashboard/app.email')</th>
										<th class="wd-15p border-bottom-0">@lang('dashboard/app.phone')</th>
										<th class="wd-10p border-bottom-0">@lang('dashboard/sidebar.categories')</th>
										<th class="wd-10p border-bottom-0">@lang('dashboard/app.image')</th>
										<th class="wd-25p border-bottom-0">@lang('dashboard/app.created_at')</th>
										<th class="wd-25p border-bottom-0">@lang('dashboard/app.actions')</th>
									</tr>
								</thead>
								<tbody>
									@foreach($instructors as $index => $instructor)
										<tr>
											<td>{{$index + 1}}</td>
											<td>{{$instructor->name}}</td>
											<td>{{$instructor->email}}</td>
											<td>{{$instructor->phone}}</td>
											<td>
												@foreach($instructor->subCategories as $index => $subCategory)
												{{$index== 0 ? '' : ' - '}} {{$subCategory->name}}
												@endforeach
											</td>
											<td><img src="{{url($instructor->image)}}"></td>
											<td>{{$instructor->created_at->diffForHumans()}}</td>
											<td>
												@if(auth()->user()->can('edit instructor'))
													<a href="{{route('instructors.edit', $instructor->id)}}">
														<button class="btn btn-success btn-sm"><i class="typcn typcn-edit"></i></button>
													</a>
												@endif
												@if(auth()->user()->can('delete instructor'))
													<form method="POST" action="{{route('instructors.destroy', $instructor->id)}}" style="display: inline;">
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