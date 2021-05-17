@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.vus.create") }}">
               Add vu
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        vus
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Speaker">
                <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <th>
                        id
                        </th> 
                        <th>
                        consumore
                        </th>
                        <th>
                        ad
                        </th>
                        
                     
                        <th>
                        date
                        </th>
                       
                        <th>
                            &nbsp;
                        </th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($vus as $key => $vu)
                        <tr data-entry-id="{{ $vu->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $vu->id ?? '' }}
                            </td>
                            <td>
                            {{ $vu->consumer_id  }}
                            </td>
                            <td>
                            {{ $vu->ad_id  }}
                            </td>
                          
                          
                            <td>  
                            {{ $vu->created_at	 ?? '' }}
                            </td>
                           
                            <td>
                              
                                    <form action="{{ route('admin.vus.destroy', $vu->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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