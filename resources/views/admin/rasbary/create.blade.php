@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Creat Rasbary
    </div>

    <div class="card-body">
        <form action="{{ route("admin.rasbarys.store") }}" method="POST" >
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="model">model*</label>
                <input type="text" id="model" name="model" class="form-control" value="{{ old('model', isset($rasbary) ? $rasbary->model : '') }}" required>
               
                
            </div>
            <div class="form-group {{ $errors->has('key') ? 'has-error' : '' }}">
                <label for="key">key*</label>
                <input type="text" id="key" name="key" class="form-control" value="{{ old('model', isset($rasbary) ? $rasbary->key : '') }}" required>
               
                
            </div>
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">name*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('model', isset($rasbary) ? $rasbary->name : '') }}" required>
               
                
            </div>
            
            <div class="form-group {{ $errors->has('boughtdate') ? 'has-error' : '' }}">
                <label for="boughtdate">bought date*</label>
                <input type="date" id="boughtdate" name="boughtdate" class="form-control" value="{{ old('model', isset($rasbary) ? $rasbary->boughtdate : '') }}" required>
               
                
            </div>
            <div class="form-group {{ $errors->has('givingdate') ? 'has-error' : '' }}">
                <label for="givingdate">giving date*</label>
                <input type="date" id="givingdate" name="givingdate" class="form-control" value="{{ old('model', isset($rasbary) ? $rasbary->givingdate : '') }}" required>
               
                
            </div>
            <div class="form-group {{ $errors->has('consumers') ? 'has-error' : '' }}">
                <label for="venues">consumers
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="consumers[]" id="consumers" class="form-control select2" multiple="multiple" >
                    @foreach($consumers as $id => $consumers)
                        <option value="{{ $id }}" {{ (in_array($id, old('consumers', [])) || isset($rasbary) && $rasbary->consumers->contains($id)) ? 'selected' : '' }}>{{ $consumers }}</option>
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