@extends('layouts.RegiterLocationP')
@section('styles')
    <style>
        * {
        margin: 0;
        padding: 0
            }

        html {
            height: 100%
        }

        p {
            color: grey
        }

        #heading {
            text-transform: uppercase;
            color: #673AB7;
            font-weight: normal
        }

        #msform {
            text-align: center;
            position: relative;
            margin-top: 20px
        }

        #msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 0.5rem;
            box-sizing: border-box;
            width: 100%;
            margin: 0;
            padding-bottom: 20px;
            position: relative
        }

        .form-card {
            text-align: left
        }

        #msform fieldset:not(:first-of-type) {
            display: none
        }

        #msform input,
        #msform textarea {
            padding: 8px 15px 8px 15px;
            border: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 25px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            background-color: #ECEFF1;
            font-size: 16px;
            letter-spacing: 1px
        }

        #msform input:focus,
        #msform textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #673AB7;
            outline-width: 0
        }

        #msform .action-button {
            width: 100px;
            background: #673AB7;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 0px 10px 5px;
            float: right
        }

        #msform .action-button:hover,
        #msform .action-button:focus {
            background-color: #311B92
        }

        #msform .action-button-previous {
            width: 100px;
            background: #616161;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px 10px 0px;
            float: right
        }

        #msform .action-button-previous:hover,
        #msform .action-button-previous:focus {
            background-color: #000000
        }

        .card {
            z-index: 0;
            border: none;
            position: relative
        }

        .fs-title {
            font-size: 25px;
            color: #673AB7;
            margin-bottom: 15px;
            font-weight: normal;
            text-align: left
        }

        .purple-text {
            color: #673AB7;
            font-weight: normal
        }

        .steps {
            font-size: 25px;
            color: gray;
            margin-bottom: 10px;
            font-weight: normal;
            text-align: right
        }

        .fieldlabels {
            color: gray;
            text-align: left
        }

        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: lightgrey
        }

        #progressbar .active {
            color: #673AB7
        }

        #progressbar li {
            list-style-type: none;
            font-size: 15px;
            width: 25%;
            float: left;
            position: relative;
            font-weight: 400
        }

        #progressbar #account:before {
            font-family: FontAwesome;
            content: "\f13e"
        }

        #progressbar #personal:before {
            font-family: FontAwesome;
            content: "\f007"
        }

        #progressbar #payment:before {
            font-family: FontAwesome;
            content: "\f030"
        }

        #progressbar #confirm:before {
            font-family: FontAwesome;
            content: "\f00c"
        }

        #progressbar li:before {
            width: 50px;
            height: 50px;
            line-height: 45px;
            display: block;
            font-size: 20px;
            color: #ffffff;
            background: lightgray;
            border-radius: 50%;
            margin: 0 auto 10px auto;
            padding: 2px
        }

        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: lightgray;
            position: absolute;
            left: 0;
            top: 25px;
            z-index: -1
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #673AB7
        }

        .progress {
            height: 20px
        }

        .progress-bar {
            background-color: #673AB7
        }

        .fit-image {
            width: 100%;
            object-fit: cover
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <h2 id="heading">Sign Up Your Advertiser Partener Account</h2>
                    <form id="msform" class="form" method="POST" action="{{ route('advertiser.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active" id="account"><strong>Account</strong></li>
                            <li id="personal"><strong>Business</strong></li>
                            <li id="payment"><strong>Logo</strong></li>
                            <li id="confirm"><strong>Finish</strong></li>
                        </ul>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div> <br> <!-- fieldsets -->
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Account Information:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 1 - 4</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <label class="fieldlabels">First Name: *</label>
                                        <input type="text" name="first_name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="{{ _('First name') }}" value="{{ old('first_name') }}" />
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 ">
                                        <label class="fieldlabels">Last Name: *</label>
                                        <input type="text" name="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="{{ _('Last name') }}" value="{{ old('last_name') }}" />
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group">
                                    <label class="fieldlabels">Email: *</label>
                                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ _('Email') }}" value="{{ old('Email') }}" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <label class="fieldlabels">Post: *</label>
                                    <input type="text" name="post" class="form-control{{ $errors->has('post') ? ' is-invalid' : '' }}" placeholder="{{ _('Post') }}" value="{{ old('post') }}" />
                                    @error('post')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <label class="fieldlabels">Telephone personnel: *</label>
                                    <input type="text" name="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ _('Phone Number') }}" value="{{ old('phone') }}" />
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="password">Password: *</label>
                                    <div class="controls">
                                        <input value="" type="password" id="password" name="password" placeholder="{{ _('password') }}" class="form-control input-sm">

                                        @if($errors->has('password'))
                                            <div class="text-danger">{{ $errors->first(' password') }}</div>
                                        @endif
                                        <p class="help-block"></p>
                                    </div>
                                    <label class="control-label"  for="password">Confirm Password: *</label>
                                    <div class="controls">
                                        <input value="" type="password" id="password_confirmation" name="password_confirmation" placeholder="" class="form-control input-sm">
                                        @if($errors->has('password'))
                                            <div class="text-danger">{{ $errors->first('password') }}</div>
                                        @endif
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Business Information:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 2 - 4</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <label class="fieldlabels">Business Name: *</label>
                                        <input type="text" name="location_name" class="form-control{{ $errors->has('location_name') ? ' is-invalid' : '' }}" placeholder="{{ _('AdUp') }}" value="{{ old('location_name') }}" />
                                        @error('location_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 ">
                                        <label class="fieldlabels">Telephone Professionnel: *</label>
                                        <input type="text" name="location_tel" class="form-control{{ $errors->has('location_tel') ? ' is-invalid' : '' }}" placeholder="{{ _('+216 XX XXX XXX') }}" value="{{ old('location_tel') }}" />
                                        @error('location_tel')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 ">
                                        <label class="fieldlabels">Business Region: *</label>
                                            <select name="location_region" id="location_region" class="form-control">
                                            @foreach($regions as $region)
                                                <option ><?php echo $region?></option>
                                            @endforeach
                                            </select>
                                            @error('location_region')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="col-md-8">
                                        <label class="fieldlabels">Business Adresse: *</label>
                                        <input type="location_address" name="location_address" class="form-control{{ $errors->has('Business Address') ? ' is-invalid' : '' }}" placeholder="{{ _('Business address') }}" value="{{ old('location_address') }}" />
                                        @error('location_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$location_address}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 ">
                                        <label class="fieldlabels">Domaine : *</label>
                                        <select name="location_secteur" id="location_secteur" class="form-control">
                                        @foreach($secteurs as $secteur)
                                            <option >{{$secteur->name}}</option>
                                        @endforeach
                                        </select>
                                        @error('location_region')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                        If you don't find your Domain
                                        <div style="margin-bottom: 10px;" class="row">
                                            <div class="col-lg-12">
                                                <a class="btn btn-success" href="/AddDomaine">
                                                 Add Domain <i class="bi bi-plus-circle"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <label class="fieldlabels">Email: </label>
                                    <input type="email" name="email_pro" class="form-control{{ $errors->has('email_pro') ? ' is-invalid' : '' }}" placeholder="{{ _('E-mail pro') }}" value="{{ old('email_pro') }}" />
                                    @error('email_pro')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <label class="fieldlabels">WebSite: (optionel)</label>
                                    <input type="text" name="website" class="" placeholder="{{ _('www.website.com') }}" value="{{ old('website') }}" />
                                    @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <label class="fieldlabels">Socia Media: (optionel)</label>
                                    <input type="text" name="social_media" class="" placeholder="{{ _('www.website.com') }}" value="{{ old('social_media') }}" />
                                    @error('social_media')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Logo Upload:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 3 - 4</h2>
                                    </div>
                                </div>
                                <label class="fieldlabels">Upload Your Business Logo:</label> <input type="file" name="logo" accept="image/*">

                                @error('logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <input type="button" name="next" class="next action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Finish:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 4 - 4</h2>
                                    </div>
                                </div> <br><br>
                                <h4 class="purple-text text-center">Your account will be processed for 24 hours then you will receive a validation email</h4> <br>
                                <div class="row justify-content-center">
                                    <div class="col-3"> <img src="{{ asset('/img/GwStPmg.png') }}" class="fit-image"> </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-7 text-center">
                                        <h5 class="purple-text text-center"><p></p>  <br> Click on Finish Button </h5>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Finish</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function myFunction() {
        var x = document.getElementById("password_confirmation");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
}
        $(document).ready(function(){
             var current_fs, next_fs, previous_fs; //fieldsets
            var opacity;
            var current = 1;
            var steps = $("fieldset").length;

            setProgressBar(current);

            $(".next").click(function(){

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
            step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
            'display': 'none',
            'position': 'relative'
            });
            next_fs.css({'opacity': opacity});
            },
            duration: 500
            });
            setProgressBar(++current);
            });

            $(".previous").click(function(){

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
            step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
            'display': 'none',
            'position': 'relative'
            });
            previous_fs.css({'opacity': opacity});
            },
            duration: 500
            });
            setProgressBar(--current);
            });

            function setProgressBar(curStep){
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
            .css("width",percent+"%")
            }

            $(".submit").click(function(){
            return false;
            })

            });
    </script>
@endsection
