@extends('layouts.admin')
@section('content')

<!-- <div class="modal fade" id="adsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="text-align:center;">Ads</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-header ">
                                    <h5 class="card-category" style="text-align:center;">Ads : Image</h5>
                                    <a class="nav-link collapsed" style="text-align:center;" href="{{ action('AdvertiserPartnerController@createImage') }}"  aria-expanded="true" aria-controls="collapseUtilities">
                                        <svg width="5em" height="5em" viewBox="0 0 16 16" class="bi bi-card-image" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                        <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-header ">
                                    <h5 class="card-category" style="text-align:center;">Ads : video</h5>
                                    <a class="nav-link collapsed" href="{{ action('AdvertiserPartnerController@createVideo') }}" style="text-align:center;" aria-expanded="true" aria-controls="collapseUtilities">
                                        <svg width="5em" height="5em" viewBox="0 0 16 16" class="bi bi-file-play" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10.117V5.883a.5.5 0 0 1 .757-.429l3.528 2.117a.5.5 0 0 1 0 .858l-3.528 2.117a.5.5 0 0 1-.757-.43z"/>
                                            <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> -->



<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">  
        <a  href="{{ action('AdvertiserPartnerController@createVideo') }}">
            <button type="button" class="btn btn-primary float-left" >
            <i class="fas fa-plus"></i>   Ads
            </button>
        </a>
    </div>
        
</div>
<div class="card">
    <div class="card-header">
        Ads
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Speaker">
                <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <th>
                        title
                        </th>
                        <th>
                        description
                        </th>
                        <th>
                        Type (Image/Video)
                        </th>
                        <th>
                        Url
                        </th>
                        <th>
                        Durée
                        </th>
                        <th>
                        start date
                        </th>
                        <th>
                        end date
                        </th>
                        <th>
                        location
                        </th>
                        <th>
                        Status
                        </th>
                      
                        <th>
                            &nbsp;
                        </th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($ads as $key => $ad)
                        <tr data-entry-id="{{ $ad->id }}">
                            @if ($ad->type == 0)
                            <td>
                                <i class="fas fa-image"></i>
                            </td>
                            @else
                            <td>
                                <i class="fas fa-video"></i>
                            </td>
                            @endif
                            <td>
                            {{ $ad->title ?? '' }}
                            </td>
                            <td>
                            {{ $ad->description ?? '' }}
                            </td>
                            @if ($ad->type == 0)
                            <td>
                            Image
                            </td>
                            <td>
                            {{ $ad->imageUrl ?? '' }}
                            </td>
                            @else
                            <td>
                            Video
                            </td>
                            <td>
                            {{ $ad->video ?? '' }}
                            </td>
                            @endif
                            <td>
                            {{ $ad->time ?? '' }}
                            </td>
                            <td>  
                            {{ $ad->start	 ?? '' }}
                            </td>
                            <td> 
                            {{ $ad->end ?? '' }}    
                            </td>
                            <td> 
                            {{ $ad->venues->name ?? '' }}    
                            </td>
                            <td> 
                            {{ $ad->venues->name ?? '' }}    
                            </td>
                            <td>
                                
                                    <a class="btn btn-xs btn-primary" href="{{action('AdvertiserPartnerController@show',$ad->id)}}">
                                        {{ trans('global.view') }}
                                    </a>
                              

                                
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.ads.edit', $ad->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                
                              
                                    <form action="{{ route('admin.ads.destroy', $ad->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                              
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

</script>
@endsection