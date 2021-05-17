@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<style>
        .control:checked ~ .conditional,
			#immigrant:checked ~ .conditional,
			#required-2:checked ~ .conditional
			#option-2:checked ~ .conditional {
				clip: auto;
				height: auto;
				margin: 0;
				overflow: visible;
				position: static;
				width: auto;
			}

			.control:not(:checked) ~ .conditional,
			#immigrant:not(:checked) ~ .conditional,
			#required-2:not(:checked) ~ .conditional,
			#option-2:not(:checked) ~ .conditional {
				border: 0;
				clip: rect(0 0 0 0);
				height: 1px;
				margin: -1px;
				overflow: hidden;
				padding: 0;
				position: absolute;
				width: 1px;
			}
    </style>
<div class="card">
    <div class="card-header">
        Creat ad
    </div>

    <div class="card-body">
        <form action="{{ action('AdvertiserPartnerController@storeVideo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class=" " style="display:none">
                <label for="title">user*</label>
                <input type="text" id="user_id" name="user_id" class="form-control" value={{$user->id}} >
                <label for="title">user*</label>
                <input type="text" id="owner" name="owner" class="form-control" value={{$user->name}} >    
                <label for="title">user*</label> 
            </div>
            <p>Choose your Ad's objectif </p>
            <div class="form-check">
         <fieldset>
				<ol>
                <li>
						<input type="radio" name="residency" value="Immigrant" id="immigrant">
						<label for="immigrant">Brand awareness</label>
						<fieldset class="conditional">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Ads Type :</label>
                                    <select name="type" id="type" class="form-control">
                                            <option id="type" name="type" class="form-control" value=1>Video</option>
                                            <option id="type" name="type" class="form-control" value=0>Image</option>
                                    </select>
                                </div>
								<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="title">title*</label>
                                    <input type="text" id="title" name="title" class="form-control" value="{{ old('model', isset($ads) ? $ads->title : '') }}" required>
                                </div>
                                <div class="form-group {{ $errors->has('key') ? 'has-error' : '' }}">
                                    <label for="description">description*</label>
                                    <input type="text" id="description" name="description" class="form-control" value="{{ old('model', isset($ads) ? $ads->key : '') }}" required>
                                </div>

                                <div class="form-group {{ $errors->has('video') ? 'has-error' : '' }}">
                                        <p>Ads Link :</p>
                                        <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="customFile" name="video">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                </div>
                                <div class="form-group {{ $errors->has('start') ? 'has-error' : '' }}">
                                    <label for="start">start*</label>
                                    <input type="date" id="start" name="start" class="form-control" value="{{ old('model', isset($ads) ? $ads->start : '') }}" required>
                                </div>

                                <div class="form-group {{ $errors->has('end') ? 'has-error' : '' }}">
                                    <label for="end">end*</label>
                                    <input type="date" id="end" name="end" class="form-control" value="{{ old('model', isset($ads) ? $ads->end : '') }}" required>
                                </div>
                                <div class ="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('video') ? 'has-error' : '' }}">
                                            <label class="fieldlabels">Region: *</label>
                                            <select name="location_id" id="location_id" class="form-control">
                                            <option value="">Select Region</option>
                                            @foreach($venues as $venues)
                                                @if($venues->status == 1)
                                                <option value="{{$venues->id}}">{{$venues->region}}</option>
                                                @endif
                                            @endforeach
                                            </select> 
                                            @error('location_region')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="end">Location*</label>
                                            <select name="state" id="state" class="form-control input-lg dynamic" data-dependent="city">
                                            <option value="">Select State</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
						</fieldset>
					</li>
					<li>
						<input type="radio" name="residency" value="Immigrant" id="immigrant">
						<label for="immigrant">Generating Leads</label>
						<fieldset class="conditional">
									<label for="option">Target Link</label>
									<input type="text" id="option" class="form-control" name='link'>
						</fieldset>
					</li>
				</ol>
			</fieldset>

            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
$(function(){
  // Opt-in to Bootstrap functionality
  $('[data-toggle="tooltip"]').tooltip();
  $('[data-toggle="popover"]').popover();
  // Create variables
  var optionsList = document.getElementById('reason-list'),
      allTargets = $('.option-target'),
      currentOption,
      currentTarget;
  // Create Hide and Show Functionality
  function hideShowTargets(){
    allTargets.each(function(){
      this.classList.add('hidden');
    });
    currentOption = optionsList.value;
    currentTarget = document.getElementById(currentOption);
    if(currentTarget){
      currentTarget.classList.remove('hidden');
    }
  }
  // Add event listener
  optionsList.addEventListener('change', hideShowTargets);
})();
</script>
@endsection
