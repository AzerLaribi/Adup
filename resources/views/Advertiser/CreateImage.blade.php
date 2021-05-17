@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Creat ad : Video
    </div>

    <div class="card-body">
        <form action="{{ action('AdvertiserPartnerController@storeImage') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class=" " style="display:none">
                <label for="title">user*</label>
                <input type="text" id="user_id" name="user_id" class="form-control" value={{$user->id}} >
                <label for="title">user*</label>
                <input type="text" id="type" name="type" class="form-control" value=0 >
                <label for="title">user*</label>
                <input type="text" id="owner" name="owner" class="form-control" value={{$user->name}} >
               
                
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">title*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('model', isset($ads) ? $ads->title : '') }}" required>
            </div>
            
            <div class="form-group {{ $errors->has('key') ? 'has-error' : '' }}">
                <label for="description">description*</label>
                <input type="text" id="description" name="description" class="form-control" value="{{ old('model', isset($ads) ? $ads->key : '') }}" required>
            </div>

            <div class="form-group {{ $errors->has('imageUrl') ? 'has-error' : '' }}">
                <label for="imageUrl">imageUrl*</label>
                <input type="text" id="imageUrl" name="imageUrl" class="form-control" value="{{ old('model', isset($ads) ? $ads->name : '') }}" required>
             </div>
            
            <div class="form-group {{ $errors->has('start') ? 'has-error' : '' }}">
                <label for="start">start*</label>
                <input type="date" id="start" name="start" class="form-control" value="{{ old('model', isset($ads) ? $ads->start : '') }}" required>
            </div>

            <div class="form-group {{ $errors->has('end') ? 'has-error' : '' }}">
                <label for="end">end*</label>
                <input type="date" id="end" name="end" class="form-control" value="{{ old('model', isset($ads) ? $ads->end : '') }}" required>
            </div>
            
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="venues">Location
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="venues[]" id="venues" class="form-control select2" multiple="multiple" >
                    @foreach($venues as $id => $venues)
                        <option value="{{ $id }}" {{ (in_array($id, old('venues', [])) || isset($ads) && $ads->venues->contains($id)) ? 'selected' : '' }}>{{ $venues }}</option>
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