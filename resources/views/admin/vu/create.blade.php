@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Creat ad
    </div>

    <div class="card-body">
        <form action="{{ route("admin.vus.store") }}" method="POST" >
            @csrf
           
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="ads">ad*
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="ad_id" id="ads" class="form-control select2" multiple="multiple" required>
                    @foreach($ads as $id => $ads)
                        <option value="{{ $id }}" >{{ $ads }}</option>
                    @endforeach
                </select>
             
               
            </div>
            
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="ads">consumores*
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="consumer_id" id="consumores" class="form-control select2" multiple="multiple" required>
                    @foreach($consumores as $id => $consumores)
                        <option value="{{ $id }}" >{{ $consumores }}</option>
                    @endforeach
                </select>
             
               
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
          
        </form>
    </div>
</div>
@endsection

@section('scripts')

@stop