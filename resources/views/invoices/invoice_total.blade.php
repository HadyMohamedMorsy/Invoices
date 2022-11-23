@extends('layouts.master')
@section('css')
@ends	ection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Invoice</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-md-12 col-xl-12">
						<div class=" main-content-body-invoice">
							<div class="card card-invoice">
								<div class="card-body">
									<div class="invoice-header">
										<h1 class="invoice-title">Invoice</h1>
										<div class="billed-from">
											<h6>{{ $invoices->name_client }}</h6>
											{{-- <p>201 Something St., Something Town, YT 242, Country 6546</p> --}}
											<p>Tel No: {{ $invoices->phone }}</p>
										</div><!-- billed-from -->
									</div><!-- invoice-header -->
									<div class="row mg-t-20">
										<div class="col-md">
											<label class="tx-gray-600">Billed To</label>
											<div class="billed-to">
												<h6>Valex</h6>
												<p>4033 Patterson Road, Staten Island, NY 10301<br>
												Tel No: 01012315216 <br>
												Email: youremail@companyname.com</p>
											</div>
										</div>
										<div class="col-md">
											<label class="tx-gray-600">Invoice Information</label>
											<p class="invoice-info-row"><span>Invoice No</span> <span>{{ $invoices->number_invoice }}</span></p>
											<p class="invoice-info-row"><span>type</span> <span>{{ $invoices->type }}</span></p>
											<p class="invoice-info-row"><span>Issue Date:</span> <span>{{ $invoices->updated_at }}</span></p>
											<p class="invoice-info-row"><span>Due Date:</span> <span>{{ $invoices->updated_at }}</span></p>
										</div>
									</div>
									<div class="table-responsive mg-t-40">
										@foreach ($Languages as $lang )
											<span class="mt-5 mb-5 d-block"></span>
											<table class="table table-invoice border text-md-nowrap mb-0">
												<thead>
														<tr>
															<th class="text-center" >{{ $lang->Language_name == 'ar' ? 'منتج' : 'PRODUCT' }} </th>
															<th class="text-center"> {{ $lang->Language_name == 'ar' ? 'وصف' : 'DESCRIPTION' }} </th>
															<th class="{{ $lang->Language_name == 'ar' ? 'tx-right' : 'tx-left' }}"> {{ $lang->Language_name == 'ar' ? 'عدد' : 'QNTY' }} </th>
															<th class="{{ $lang->Language_name == 'ar' ? 'tx-right' : 'tx-left' }}"> {{ $lang->Language_name == 'ar' ? 'سعر منتج ' : 'UNIT PRICE' }} </th>
															<th class="{{ $lang->Language_name == 'ar' ? 'tx-right' : 'tx-left' }}">{{ $lang->Language_name == 'ar' ? 'الاجمالى' : 'AMOUNT' }} </th>
														</tr>
													</thead>
													<tbody>
														@foreach ($carts as $item)
															@foreach ($item->cart as $product)
																@if($product->lang_id == $lang->id)
																	<tr>
																		<td class="text-center"> {{$product->name_product }}</td>
																		<td class="text-center">{{ $product->description }} </td>
																		<td class="{{ $lang->Language_name == 'ar' ? 'tx-right' : 'tx-left' }}">{{ $item->count }} </td>
																		<td class="{{ $lang->Language_name == 'ar' ? 'tx-right' : 'tx-left' }}">{{ $product->price }} </td>
																		<td class="{{ $lang->Language_name == 'ar' ? 'tx-right' : 'tx-left' }}">{{ $item->total }} </td>
																	</tr>
																@endif
														@endforeach
													@endforeach
														<tr>
															<td class="tx-center tx-uppercase tx-bold tx-inverse border border-primary" colspan="2">{{ $lang->Language_name == 'ar' ? 'الاجمالى' : 'TOTAL DUE' }}</td>
															<td class="tx-center border border border-primary" colspan="3">
																<h4 class="tx-primary tx-bold">{{ $invoices->total }}</h4>
															</td>
														</tr>
													</tbody>
											</table>
										@endforeach
									</div>
									<hr class="mg-b-40">
									@if ( $invoices->status == 'Not_Payment')
										<a class="btn btn-purple float-left mt-3 mr-2" href="{{ route('payInvoice') }}"
										onclick="event.preventDefault();
											document.getElementById('Pay-form').submit();">
											<i class="bx bx-log-out"></i> Pay Now
										</a>
										<form id="Pay-form" action="{{ route('payInvoice') }}" method="POST" class="d-none">
											<input type="hidden" value="{{ $invoices->number_invoice }}" name="number_invoice">
											{{ method_field('PUT') }}
											@csrf
										</form>
									@endif
									<a href="#" class="btn btn-danger float-left mt-3 mr-2">
										<i class="mdi mdi-printer ml-1"></i>Print
									</a>
									<a href="#" class="btn btn-success float-left mt-3">
										<i class="mdi mdi-telegram ml-1"></i>Send Invoice
									</a>
								</div>
							</div>
						</div>
					</div><!-- COL-END -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
@endsection