@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Catagories</h4>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->


				@if (Session::has('success'))
					<div class="alert alert-success">
						{!! Session::get('success') !!}
					</div>
				@endif

				@if (Session::has('updated'))
					<div class="alert alert-success">
						{!! Session::get('updated') !!}
					</div>
				@endif

				@if (Session::has('Deleted'))
					<div class="alert alert-success">
						{!! Session::get('Deleted') !!}
					</div>
				@endif

@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-12 col-lg-12 col-md-12">
						<div class="card">	
							<div class="card-body p-2">
								<form class="input-group" action="{{ URL('search/category') }}" method="POST">
									@csrf
									{{ method_field('POST') }}
										<input type="text" class="form-control" placeholder="Search ..." name="search">
										<input type="hidden"  name="Lang" value="{{ LaravelLocalization::getCurrentLocale() }}">

										<span class="input-group-append">
											<button class="btn btn-primary" type="submit">Search</button>
										</span>
									
								</form>
							</div>
						</div>
						<div class="row row-sm">
								@foreach($Catagories as $Catagore)
									<div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="pro-img-box">
													<a href="{{ route('catagories.show' , $Catagore->translation_id) }}">
														<img class="w-100" src="{{URL::asset('images/Catagories/'.$Catagore->image_name)}}" alt="product-image">
													</a>
												</div>
												<div class="text-center pt-3">
													<h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">{{ $Catagore->name_cat}}</h3>
													<span class="tx-15 ml-auto">
														<i class="ion ion-md-star text-warning"></i>	
														<i class="ion ion-md-star text-warning"></i>
														<i class="ion ion-md-star text-warning"></i>
														<i class="ion ion-md-star-half text-warning"></i>
														<i class="ion ion-md-star-outline text-warning"></i>
													</span>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						<ul class="pagination product-pagination mr-auto ml-auto justify-content-center">
							{{ $Catagories->links() }}
						</ul>
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>
@endsection