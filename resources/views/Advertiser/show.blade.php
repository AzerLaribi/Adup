@extends('layouts.admin')
@section('content')
<div class="card" >
    <div class="card-header">

    </div>
 
    <div class="card-body">
    <div class ="row">
    <div class="col-md-6 ">
            <div class="mb-2">
                <table class="table table-bordered table-striped">
                    <thead>
                            <tr>
                                <th>
                                    Ad Information
                                </th>
                            </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>
                             Name
                        </th>
                        <td>
                            {{ $ad->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Description
                        </th>
                        <td>
                            {{ $ad->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                             Strat
                        </th>
                        <td>
                            {{ $ad->start }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                             adresse
                        </th>
                        <td>
                            {{ $ad->end }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                             Location 
                        </th>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <th>
                             Owner 
                        </th>
                        <td>
                            {{ $ad->owner}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                             Generating Leads 
                        </th>
                        <td>
                            {{ $ad->link}}
                            
                        </td>
                    </tr>
                    <tr>
                        <th>
                             Status 
                        </th>
                        <td>
                        @if($ad->status==0) Waiting @elseif($ad->status==1) Accepted @else Refused @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Video Duration
                        </th>
                        <td>
                        <p id="p1"></p>
                        </td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6 "  onLoad="getDur()">
            <div class="row justify-content-center">
                <video id="myVideo" width="320" height="176" controls>
                    <source src="{{ asset('/Ads/Video/'.$ad->video)}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">
                
            <a style="margin-top:20px;" class="btn btn-default" href="{{ route('admin.ads.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </nav>
    </div>
</div>
@endsection
@section('scripts')

<script>
var vid = document.getElementById("myVideo");

function getCurTime() { 
  alert(vid.currentTime);
} 

function setCurTime() { 
  vid.currentTime=5;
} 
function setDuration() { 
  alert(vid.duration);
} 
document.getElementById("p1").innerHTML = vid.duration;

</script> 
@endsection