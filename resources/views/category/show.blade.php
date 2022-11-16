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
									Details About {{$showCategory->name_cat}}
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
												<td>{{ $showCategory->id }}</td>
												<td>{{ $showCategory->name_cat }}</td>
												<td>{{ count($counts) }}</td>
												<td>
													@foreach ($counts as $count)
														{{ $count->name_product.',' }}
													@endforeach
												</td>
												<td> 
													<a  href={{ route('catagories.edit' , $showCategory->translation_id) }}  class="btn btn-primary"> Edit </a>
													<form action="{{ route('catagories.destroy' , $showCategory->translation_id) }}" method="POST" class="Delete-form">
														@csrf
														{{ method_field('DELETE') }}
            											<button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> Delete </button>
													</form>
												</td>
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