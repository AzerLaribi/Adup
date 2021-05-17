@extends('layouts.admin')
@section('content')

   
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
                        imageUrl
                        </th>
                        <th>
                        video
                        </th>
                        <th>
                        start date
                        </th>
                        <th>
                        end date
                        </th>
                      
                        <th>
                            &nbsp;
                        </th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($ads as $key => $ad)
                        <tr data-entry-id="{{ $ad->id }}">
                            <td>

                            </td>
                          
                            <td>
                            {{ $ad->title ?? '' }}
                            </td>
                            <td>
                            {{ $ad->description ?? '' }}
                            </td>
                            <td>
                            {{ $ad->imageUrl ?? '' }}
                            </td>
                            <td>

                            {{ $ad->video ?? '' }}
                            </td>
                            <td>  
                            {{ $ad->start	 ?? '' }}
                            </td>
                            <td> 
                            {{ $ad->end ?? '' }}    
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
@endsection
@section('scripts')
@parent

</script>
@endsection