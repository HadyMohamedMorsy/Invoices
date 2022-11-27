@extends('layouts.master')
@section('css')
<style>
	form{
		display: inline-block;
	}
</style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">  </h4>
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
				<div class="row">
					<div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
						<!--div-->
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-5 mb-3">
									Details About 
								</div>
								<div class="table-responsive">
									<table class="table main-table-reference text-nowrap mb-0 mg-t-5">
										<thead>
											<tr>
												<th> id </th>
												<th class="wd-15p border-bottom-0">Section_name</th>
												<th class="wd-15p border-bottom-0">Counts</th>
												<th class="wd-15p border-bottom-0">Products</th>
												<th> Action's</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td></td>
												<td></td>
												<td></td>
											</tr> 
										</tbody>
									</table>
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
@endsection