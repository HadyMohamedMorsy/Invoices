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
							<h4 class="content-title mb-0 my-auto">Ecommerce</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Products</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-3 col-lg-3 col-md-12 mb-3 mb-md-0">
						<div class="card">
							<div class="card-header border-bottom pt-3 pb-3 mb-0 font-weight-bold text-uppercase">Category</div>
							<div class="card-body pb-0">
								@foreach ($catagoriesProduct as $catagory)
									<div class="form-group">
										<label class="form-label">{{ $catagory->name_cat }}</label>
										<select name="beast" id="select-beast" class="form-control  nice-select  custom-select">
											<option value="0">--Select--</option>
											@foreach ($catagory->pro as $product)
												<option value="{{ $product->translation_id }}"> {{ $product->name_product }}</option>
											@endforeach
										</select>
									</div>
									@endforeach
								<button class="btn btn-primary-gradient mt-2 mb-2 pb-2" type="submit">Filter</button>
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
							@php
								$i = 0;
							@endphp
							@foreach ($products as $product)
								
								<div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
									<div class="card">
										<div class="card-body">
											<div class="pro-img-box">
												<a href="{{route('products.show' , $product->translation_id)}}">
													<img class="w-100" src="{{URL::asset('/images/products/'. $product->image_name)}}" alt="product-image">
												</a>
												<button class="adtocart" data_product ={{ $product->translation_id }}>
													<input name="token" type="hidden" value="{{ csrf_token() }}" />
													<i class="las la-shopping-cart "></i>
												</button>
											</div>
											<div class="text-center pt-3">
												<h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">{{ $product->name_product }}</h3>
												<h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">  {{ $product->price }} $ </h4>
											</div>
										</div>
									</div>
								</div>
							@endforeach
							<ul class="pagination product-pagination mr-auto float-left">
								{{ $products->links() }}
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
<script src="{{URL::asset('assets/js/addCart.js')}}"></script>
@endsection