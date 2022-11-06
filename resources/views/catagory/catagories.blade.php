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


				@if (\Session::has('success'))
					<div class="alert alert-success">
						{!! \Session::get('success') !!}
					</div>
				@endif

				@if (\Session::has('updated'))
					<div class="alert alert-success">
						{!! \Session::get('updated') !!}
					</div>
				@endif

				@if (\Session::has('Deleted'))
					<div class="alert alert-success">
						{!! \Session::get('Deleted') !!}
					</div>
				@endif

@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-3 col-lg-3 col-md-12 mb-3 mb-md-0">
						<div class="card">
							<div class="card-header border-bottom pt-3 pb-3 mb-0 font-weight-bold text-uppercase">Category</div>
							<div class="card-body pb-0">
								<div class="form-group">
									<label class="form-label">Ctagory</label>
									<select name="beast" id="select-beast" class="form-control  nice-select  custom-select">
										<option value="0">--Select--</option>
										<option value="1">Foot wear</option>
										<option value="2">Top wear</option>
										<option value="3">Bootom wear</option>
										<option value="4">Men's Groming</option>
										<option value="5">Accessories</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-9 col-lg-9 col-md-12">
						<div class="card">
							<div class="card-body p-2">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search ...">
									<span class="input-group-append">
										<button class="btn btn-primary" type="button">Search</button>
									</span>
								</div>
							</div>
						</div>
						<div class="row row-sm">
							<div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="pro-img-box">
											<div class="d-flex product-sale">
												<div class="badge bg-pink">New</div>
												<i class="mdi mdi-heart-outline ml-auto wishlist"></i>
											</div>
											<img class="w-100" src="{{URL::asset('assets/img/ecommerce/01.jpg')}}" alt="product-image">
											<a href="#" class="adtocart"> <i class="las la-shopping-cart "></i>
											</a>
										</div>
										<div class="text-center pt-3">
											<h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">FLOWER POT</h3>
											<span class="tx-15 ml-auto">
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star-half text-warning"></i>
												<i class="ion ion-md-star-outline text-warning"></i>
											</span>
											<h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">$26 <span class="text-secondary font-weight-normal tx-13 ml-1 prev-price">$59</span></h4>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="pro-img-box">
											<div class="d-flex product-sale">
												<i class="mdi mdi-heart text-danger ml-auto wishlist"></i>
											</div>
											<img class="w-100" src="{{URL::asset('assets/img/ecommerce/02.jpg')}}" alt="product-image">
											<a href="#" class="adtocart"> <i class="las la-shopping-cart "></i>
											</a>
										</div>
										<div class="text-center pt-3">
											<h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">Chair</h3>
											<span class="tx-15 ml-auto">
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star-half text-warning"></i>
												<i class="ion ion-md-star-outline text-warning"></i>
											</span>
											<h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">$35 <span class="text-secondary font-weight-normal tx-13 ml-1 prev-price">$79</span></h4>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="pro-img-box">
											<div class="d-flex product-sale">
												<div class="badge bg-success">New</div>
												<i class="mdi mdi-heart-outline ml-auto wishlist"></i>
											</div>
											<img class="w-100" src="{{URL::asset('assets/img/ecommerce/03.jpg')}}" alt="product-image">
											<a href="#" class="adtocart"> <i class="las la-shopping-cart "></i>
											</a>
										</div>
										<div class="text-center pt-3">
											<h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">Hiking Boots</h3>
											<span class="tx-15 ml-auto">
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star-half text-warning"></i>
												<i class="ion ion-md-star-outline text-warning"></i>
											</span>
											<h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">$25 <span class="text-secondary font-weight-normal tx-13 ml-1 prev-price">$59</span></h4>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="pro-img-box">
											<div class="d-flex product-sale">
												<div class="badge bg-success">New</div>
												<i class="mdi mdi-heart-outline ml-auto wishlist"></i>
											</div>
											<img class="w-100" src="{{URL::asset('assets/img/ecommerce/06.jpg')}}" alt="product-image">
											<a href="#" class="adtocart"> <i class="las la-shopping-cart "></i>
											</a>
										</div>
										<div class="text-center pt-3">
											<h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">college  bag</h3>
											<span class="tx-15 ml-auto">
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star-half text-warning"></i>
												<i class="ion ion-md-star-outline text-warning"></i>
											</span>
											<h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">$35 <span class="text-secondary font-weight-normal tx-13 ml-1 prev-price">$69</span></h4>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="pro-img-box">
											<div class="d-flex product-sale">
												<i class="mdi mdi-heart ml-auto wishlist text-danger"></i>
											</div>
											<img class="w-100" src="{{URL::asset('assets/img/ecommerce/04.jpg')}}" alt="product-image">
											<a href="#" class="adtocart"> <i class="las la-shopping-cart"></i>
											</a>
										</div>
										<div class="text-center pt-3">
											<h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">Headphones</h3>
											<span class="tx-15 ml-auto">
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star-half text-warning"></i>
												<i class="ion ion-md-star-outline text-warning"></i>
											</span>
											<h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">$46 <span class="text-secondary font-weight-normal tx-13 ml-1 prev-price">$89</span></h4>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="pro-img-box">
											<div class="d-flex product-sale">
												<i class="mdi mdi-heart-outline ml-auto wishlist"></i>
											</div>
											<img class="w-100" src="{{URL::asset('assets/img/ecommerce/05.jpg')}}" alt="product-image">
											<a href="#" class="adtocart"> <i class="las la-shopping-cart "></i>
											</a>
										</div>
										<div class="text-center pt-3">
											<h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">Camera lens</h3>
											<span class="tx-15 ml-auto">
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star-half text-warning"></i>
												<i class="ion ion-md-star-outline text-warning"></i>
											</span>
											<h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">$159 <span class="text-secondary font-weight-normal tx-13 ml-1 prev-price">$299</span></h4>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="pro-img-box">
											<div class="d-flex product-sale">
												<div class="badge bg-purple">New</div>
												<i class="mdi mdi-heart ml-auto wishlist text-danger"></i>
											</div>
											<img class="w-100" src="{{URL::asset('assets/img/ecommerce/09.jpg')}}" alt="product-image">
											<a href="#" class="adtocart"> <i class="las la-shopping-cart "></i>
											</a>
										</div>
										<div class="text-center pt-3">
											<h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">Camera</h3>
											<span class="tx-15 ml-auto">
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star-half text-warning"></i>
												<i class="ion ion-md-star-outline text-warning"></i>
											</span>
											<h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">$129 <span class="text-secondary font-weight-normal tx-13 ml-1 prev-price">$189</span></h4>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="pro-img-box">
											<div class="d-flex product-sale">
												<i class="mdi mdi-heart-outline ml-auto wishlist"></i>
											</div>
											<img class="w-100" src="{{URL::asset('assets/img/ecommerce/11.jpg')}}" alt="product-image">
											<a href="#" class="adtocart"> <i class="las la-shopping-cart "></i>
											</a>
										</div>
										<div class="text-center pt-3">
											<h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">Handbag</h3>
											<span class="tx-15 ml-auto">
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star-half text-warning"></i>
												<i class="ion ion-md-star-outline text-warning"></i>
											</span>
											<h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">$19 <span class="text-secondary font-weight-normal tx-13 ml-1 prev-price">$39</span></h4>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="pro-img-box">
											<div class="d-flex product-sale">
												<div class="badge bg-info">New</div>
												<i class="mdi mdi-heart ml-auto wishlist text-danger"></i>
											</div>
											<img class="w-100" src="{{URL::asset('assets/img/ecommerce/07.jpg')}}" alt="product-image">
											<a href="#" class="adtocart"> <i class="las la-shopping-cart "></i>
											</a>
										</div>
										<div class="text-center pt-3">
											<h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">Laptop</h3>
											<span class="tx-15 ml-auto">
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star text-warning"></i>
												<i class="ion ion-md-star-half text-warning"></i>
												<i class="ion ion-md-star-outline text-warning"></i>
											</span>
											<h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">$89 <span class="text-secondary font-weight-normal tx-13 ml-1 prev-price">$120</span></h4>
										</div>
									</div>
								</div>
							</div>
							<ul class="pagination product-pagination mr-auto float-left">
								<li class="page-item page-prev disabled">
									<a class="page-link" href="#" tabindex="-1">Prev</a>
								</li>
								<li class="page-item active"><a class="page-link" href="#">1</a></li>
								<li class="page-item"><a class="page-link" href="#">2</a></li>
								<li class="page-item"><a class="page-link" href="#">3</a></li>
								<li class="page-item"><a class="page-link" href="#">4</a></li>
								<li class="page-item"><a class="page-link" href="#">5</a></li>
								<li class="page-item page-next">
									<a class="page-link" href="#">Next</a>
								</li>
							</ul>
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
<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>
@endsection