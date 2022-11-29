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

<link rel="stylesheet" href= {{URL::asset('assets/css/bootstrap-multiselect.css')}}  type="text/css"/>


@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ __('products.Create') }} <span id="config" data-page="products"> {{ __('products.page') }} </span> </h4>
						</div>
					</div>
				</div>
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
					<form class="col-lg-12 col-md-12 form_products" action={{ route('products.update' , $editProduct->translation_id) }} method="POST" enctype="multipart/form-data">
						@csrf
						{{ method_field('PUT') }}
						<div class="card">
							<div class="card-body">
								<div class="mb-4">
                                    <div class="form-group name_products">
                                        <label class="label_products mt-3"> {{ __('products.Name-Of-Product') }} </label>
                                        <input class="form-control text_products" type="text" placeholder="{{ __('products.Name-Of-Product') }}" data-name="name_pro"  name="name_pro_en" value="{{ $editProduct->name_product }}">
                                    </div>
								</div>
								<div class="mb-4">
                                    <div class="form-group price_products">
                                        <label class="label_products mt-3"> price </label>
                                        <input class="form-control price_products" type="number" placeholder="{{ __('products.Name-Of-Product') }}" data-name="number_pro"  name="number_pro" value="{{ $editProduct->price }}">
                                    </div>
								</div>
								<div class="mb-4">
                                    <div class="form-group description_products">
                                        <label class="label_products mt-3"> Description Product  </label>
										<textarea class="form-control desc_products" placeholder="{{ __('products.Name-Of-Product') }}" rows="3" data-name="des_pro" name="des_pro_en">{{ $editProduct->description }}</textarea>
                                    </div>
								</div>
								<!-- Build your select: -->
								<div class="mb-4">
									<div class="form-group">
										<label class="label_products mt-3"> Select Catagories </label>
										<select id="example-getting-started" multiple="multiple" class="mb-5" name="product_category[]">
                                        @foreach ($Catagories as $catagory )
                                            <option 
                                            @foreach ($MySelectedCategory as $lastCat)
                                                {{ $lastCat->translation_id ==  $catagory->translation_id ? "selected" : ""}}
                                            @endforeach
                                            value="{{ $catagory->translation_id }}"
                                            > 
                                            {{ $catagory->name_cat }} 
                                            </option>
											@endforeach
										</select>
                                        @foreach ($MySelectedCategory as $lastCat)
                                            <span class="Last_Cat" data-Lastcat="{{str_replace(' ' , '_' , $lastCat->name_cat)}}"> {{ $lastCat->name_cat }}</span>
                                        @endforeach
									</div>
								</div>
								<div class="col-lg-12 col-md-12">
									<div class="card">
										<div class="card-body">
											<div>
												<h6 class="card-title mb-1">{{ __('products.File Upload') }}</h6>
												<p class="text-muted card-sub-title">{{ __('products.u must upload format your JPG/PNG/PDF') }}</p>
											</div>
                                            <div class="row mb-4">
												<div class="col-lg-12">
													<img src="{{URL::asset('images/products/'.$editProduct->image_name)}}" alt="" class="img-thumbnail rounded" style="height: 250px">
												</div>
											</div>
                                            <img src="" alt="">
											<div class="row mb-4">
												<div class="col-lg-12">
													<input type="file" class="dropify" data-height="200" name="file"/>
												</div>
											</div>
										</div>
									</div>
								</div>
									<input  type="hidden"  name="translation_id" value={{ time();}}>
								<button class="btn ripple btn-primary bl-tl-0 bl-bl-0" type="submit">{{ __('products.Submit') }}</button>
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

<script src="{{URL::asset('assets/js/bootstrap-multiselect.js')}}"></script>

<script>
	$(document).ready(function() {
        $('#example-getting-started').multiselect();
    });
</script>
<script>

	TakeSelectingElement("text");

	TakeSelectingElement("desc");
	


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

			WorkingFunctionTranslation("description", "label", "desc");
			
			formApplication.removeAttribute('action');
			
			formApplication.setAttribute('action' , '/multi');


		}else{

			target.dataset.auto = "noAuto";
			
			button.innerHTML = "No Auto Translate When Save Your data";
			
			WorkingFunctionTranslationDeleting("name", "label", "text");

			WorkingFunctionTranslationDeleting("description", "label", "desc");

			formApplication.removeAttribute('action');

			formApplication.setAttribute('action' , 'products/store');

		}
		
	}); 
</script>

<script>
    setTimeout(() => {
        let checkedIn = document.querySelectorAll('.checkbox');

        checkedIn.forEach((value) => {
           let Inventor =  value.getAttribute('title').trim().replace(" ", "_");
            value.removeAttribute('title');
            value.setAttribute('id' , Inventor);
        });

        let Last_Cat = document.querySelectorAll('.Last_Cat');

        Last_Cat.forEach((value) => {

            let selected =  document.getElementById(value.getAttribute('data-lastcat'))
            
             selected.firstElementChild.checked = true;
        })
    
    }, 1000);
</script>

@endsection