@extends('layouts.master')
@section('css')
<!--Internal  Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet"/>
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Ecommerce</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Product-Cart</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
				 <div class="row">
					<div class="col-xl-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<!-- Shopping Cart-->
								<div class="product-details table-responsive text-nowrap">
									<table class="table table-bordered table-hover mb-0 text-nowrap">
										<thead>
											<tr>
												<th class="text-right">Product</th>
												<th class="w-150">Quantity</th>
												<th>SUBTOTAL</th>
												<th><a class="btn btn-sm btn-outline-danger" href="#">Clear Cart</a></th>
											</tr>
										</thead>
										<tbody>
											@foreach($items as $key)

												@foreach($key->cart as $endPoint)
												<tr>
													<td>
														<div class="media">
															<div class="card-aside-img">
																<img src="{{URL::asset('/images/products/'. $endPoint->image_name)}}" alt="img" class="h-60 w-60">
															</div>
															<div class="media-body">
																<div class="card-item-desc mt-0">
																	<h6 class="font-weight-semibold mt-0 text-uppercase">{{$endPoint->name_product}}</h6>
																	{{-- <dl class="card-item-desc-1">
																		<dt>Size: </dt>
																		<dd>XXL</dd>
																	</dl> --}}
																	<dl class="card-item-desc-1">
																		<dt>Desc: </dt>
																		<dd>{{$endPoint->description}}</dd>
																	</dl>
																</div>
															</div>
														</div>
													</td>
													<td>
														<div class="form-group">
															<div class="form-group d-flex justify-content-center">
																<div class="row">
																	<input type="hidden" class="data_item" value="{{$key->cart_id}}">
																	<div class="col-md-3">
																		<button class="btn btn-primary btn-block plus">Plus</button>
																	</div>
																	<div class="col-md-6">
																		<input type="text" class="form-control quantity" placeholder="quantaty" name="quantaty" value="{{$key->count}}">
																	</div>
																	<div class="col-md-3">
																		<button class="btn btn-danger btn-block minus">Minus</button>
																	</div>
																</div>
															</div>
														</div>
													</td>
													<td class="text-center text-lg text-medium">{{$endPoint->price}}</td>
													<td class="text-center"><a class="remove-from-cart" href="#" data-toggle="tooltip" title="" data-original-title="Remove item"><i class="fa fa-trash"></i></a></td>
												</tr>
												@endforeach
											@endforeach
											<input name="token" type="hidden" value="{{ csrf_token() }}" class="token"/>
										</tbody>
									</table>
								</div>
								<div class="shopping-cart-footer  border-top-0">
									<div class="column">
										<form class="coupon-form" method="post">
											<input class="form-control" type="text" placeholder="Coupon code" required="">
											<button class="btn btn-outline-primary" type="submit">Apply Coupon</button>
										</form>
									</div>
									<div class="column text-lg">Subtotal: <span class="tx-20 font-weight-bold mr-2">$112</span></div>
								</div>
								<div class="shopping-cart-footer">
									<div class="column"><a class="btn btn-secondary" href="#">Back to Shopping</a></div>
									<div class="column"><a class="btn btn-primary" href="#" data-toast="" data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Your cart" data-toast-message="is updated successfully!">Update Cart</a><a class="btn btn-success" href="#">Checkout</a></div>
								</div>
							</div>
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
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>
<script src="{{URL::asset('assets/js/items.js')}}"></script>
@endsection