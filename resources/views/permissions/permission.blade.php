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
@endsection
@section('content')
				<!-- row -->
				<div class="row">
					<div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
						<!--div-->
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-5 mb-3">
									Details Title 
								</div>
								<div class="table-responsive">
									<table class="table main-table-reference text-nowrap mb-0 mg-t-5">
										<thead>
											<tr>
												<th> id </th>
												<th class="wd-15p border-bottom-0">Role_Title</th>
												<th> Action's</th>
											</tr>
										</thead>
										@php
											$i = 0
										@endphp
										<tbody>
											
											@foreach ($permissions as $permission)
											<tr>
												<td>
													
												</td>
												<td>
												</td> 
												<td>
												</td> 
											</tr> 
											@endforeach
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