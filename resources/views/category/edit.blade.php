@extends('layouts.master')
@section('css')
<!--- Internal Select2 css-->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
<!---Internal Fancy uploader css-->
<link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
<!--Internal Sumoselect css-->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect.css')}}">
<!--Internal  TelephoneInput css-->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/telephoneinput/telephoneinput.css')}}">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ __('categories.Create') }} <span id="config" data-page="category"> {{ __('categories.page') }} </span> </h4>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->

				<!-- breadcrumb -->
				<div class="dropdown mb-3 save-data">
					<button aria-expanded="false" aria-haspopup="true" class="btn ripple button-saving  btn-primary" data-toggle="dropdown" id="dropdownMenuButton" type="button"> Auto translate when save Your data <i class="fas fa-caret-down ml-1"></i></button>
					<div  class="dropdown-menu tx-13">
						<a class="dropdown-item" href="#" data-auto="noAuto">No Auto Translate When Save Your data</a>
					</div>
				</div>
@endsection
@section('content')
				<!-- row -->
				<div class="row">
					<form class="col-lg-12 col-md-12 form_category" action={{ route('catagories.update' , $showCategory->translation_id) }} method="POST" enctype="multipart/form-data">
						@csrf
						{{ method_field('PUT') }}
						<div class="card">
							<div class="card-body">
								<div class="mb-4">
                                    <div class="form-group name_category">
                                        <label class="label_category mt-3"> {{ __('categories.Name Of category') }} </label>
                                        <input class="form-control text_category" type="text" placeholder="{{ __('categories.Name Of category') }}" data-name="name_cat"  name="{{ "name_cat_".LaravelLocalization::getCurrentLocale() }}" value={{ $showCategory->name_cat }}>
                                    </div>
								</div>
								<div class="col-lg-12 col-md-12">
									<div class="card">
										<div class="card-body">
											<div>
												<h6 class="card-title mb-1">{{ __('categories.File Upload') }}</h6>
												<p class="text-muted card-sub-title">{{ __('categories.u must upload format your JPG/PNG/PDF') }}</p>
											</div>
											<div class="row mb-4">
												<div class="col-lg-12">
													<img src="{{URL::asset('images/Catagories/'.$showCategory->image_name)}}" alt="" class="img-thumbnail rounded" style="height: 250px">
												</div>
											</div>
											<div class="row mb-4">
												<div class="col-lg-12">
													<input type="file" class="dropify" data-height="200" name="file"/>
												</div>
											</div>
										</div>
									</div>
								</div>
								<button class="btn ripple btn-primary bl-tl-0 bl-bl-0" type="submit">{{ __('categories.Submit') }}</button>
							</div>
						</div>
					</form>
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
				</div>
				<!-- /row -->

				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal Fileuploads js-->
<script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
<!--Internal Fancy uploader js-->
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
<!--Internal  Form-elements js-->
<script src="{{URL::asset('assets/js/advanced-form-elements.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<!--Internal Sumoselect js-->
<script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
<!-- Internal TelephoneInput js-->
<script src="{{URL::asset('assets/js/Regular.js')}}"></script>
<script src="{{URL::asset('assets/plugins/telephoneinput/telephoneinput.js')}}"></script>
<script src="{{URL::asset('assets/plugins/telephoneinput/inttelephoneinput.js')}}"></script>

<script>
	
	TakeSelectingElement("text");

	let saveData = document.querySelector(".save-data");

	saveData.addEventListener("click", (e) => {

		const target = e.target.closest(".dropdown-item");

		let button = document.querySelector(".button-saving");

		if (!target) return;

		let formApplication = getElementBySelecting(`.${generateConfig(config,'form')}`);

		if(target.dataset.auto == "noAuto"){

			target.dataset.auto= "Auto" ;

			button.innerHTML = "Auto Translate When Save Your data";

			WorkingFunctionTranslation("name", "label", "text");
			
			formApplication.removeAttribute('action');

			let IdCatagory = window.location.href;
			
			let Get = IdCatagory.split('/');

			console.log(Get);
			
			
			formApplication.setAttribute('action',`http://127.0.0.1:8000/en/multi/update/${Get[Get.length - 2]}`);


		}else{

			target.dataset.auto = "noAuto";
			
			button.innerHTML = "No Auto Translate When Save Your data";
			
			WorkingFunctionTranslationDeleting("name", "label", "text");

			formApplication.removeAttribute('action');

			let IdCatagory = window.location.href;
			
			let Get = IdCatagory.split('/');

			console.log(Get);


			formApplication.setAttribute('action' , `http://127.0.0.1:8000/en/catagories/update/${Get[Get.length - 2]}`);

		}
		
	}); 
</script>
@endsection