@extends('layouts.master')
@section('css')
<!--Internal  Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet"/>
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Products</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Product-Cart</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<form class="row " id="Checkout" method="POST" action="{{ route('Checkout') }}">
					<!--div-->
					<div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									Add <span class="tx-sserif">Invoice</span>
								</div>
								<p class="mg-b-20">Your invoices </p>
								<div class="row row-sm mg-b-20">
									<div class="col-lg-4">
										<div class="form-group">
											<label> invoice_number </label>
											<input class="form-control invoice_number" type="text" placeholder="Name of Section"  name="invoice_number">
										</div>	
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label> Date Invoice</label>
											<input class="form-control" type="date" placeholder="Name of Section"  name="invoice_Date" value="<?php echo date('Y-m-d'); ?>">
										</div>	
									</div>
									<div class="col-lg-4">
										<p class="mg-b-10">Select Type Payment</p>
										<select class="form-control select2-no-search products" name="Type_Payment">
											<option label="Choose one">
											</option>
											@foreach ($TypePayment as $type)
											<option value="{{ $type->type_payment }}"
												@if ($type->type_payment == "cash" || $type->type_payment == "كاش")
													selected="selected"
												@endif
												>
												{{  $type->type_payment }}
											</option>
											@endforeach
										</select>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label> Note </label>
											<textarea class="form-control"  placeholder="Description Of Your Section"  name="note" ></textarea>
										</div>
									</div>
								</div>
							<!-- row -->	
						<!-- row closed -->
							</div>
						</div>
					</div>
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
												<th>
													<a class="btn btn-sm btn-outline-danger" href="{{ route('clear.ClearCart') }}"
													onclick="event.preventDefault();
															document.getElementById('clear').submit();">
															Clear Cart
													</a>
													<form id="clear" action="{{ route('clear.ClearCart') }}" method="POST" class="d-none">
														@csrf
													</form>
												</th>
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
																		<span class="btn btn-primary btn-block plus">Plus</span>
																	</div>
																	<div class="col-md-6">
																		<input type="text" class="form-control quantity" placeholder="quantaty" value="{{$key->count}}">
																	</div>
																	<div class="col-md-3">
																		<span class="btn btn-danger btn-block minus">Minus</span>
																	</div>
																</div>
															</div>
														</div>
													</td>
													<td class="text-center text-lg text-medium subtotal">{{$key->total}}</td>
													<td class="text-center">
														<a class="remove-from-cart" href="#" data-toggle="tooltip" title="" data-original-title="Remove item" data-remove={{$key->cart_id}}>
															<i class="fa fa-trash"></i>
														</a>
													</td>
												</tr>
												@endforeach
											@endforeach
											<input name="token" type="hidden" value="{{ csrf_token() }}" class="token"/>
										</tbody>
									</table>
								</div>
								<div class="shopping-cart-footer  border-top-0">
									<div class="column text-lg">Subtotal: <span class="tx-20 font-weight-bold mr-2 total"></span></div>
								</div>
								<div class="shopping-cart-footer">
									<div class="column"><a class="btn btn-secondary" href="{{ route('products.index') }}">Back to Shopping</a></div>
									<div class="column">
										<button class="btn btn-success" type="submit">
												Checkout
										</button>
										<input type="hidden" name="Checkout" class="Checkout">
										<input type="hidden" name="type_status" value="{{ $typeStatusPayment->payment_status }}">
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
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
<script src="{{URL::asset('assets/js/No-Invoice.js')}}"></script>

<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection