@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Creat Consumoer
    </div>

    <div class="card-body">
        <form action="{{ route("admin.consumers.store") }}" method="POST" >
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="Mac">Mac*</label>
                <input type="text" id="Mac" name="Mac" class="form-control" value="{{ old('model', isset($consumer) ? $consumer->mac : '') }}" required>
               
                
            </div>
            <div class="form-group {{ $errors->has('key') ? 'has-error' : '' }}">
                <label for="sex">sex*</label>
                <input type="text" id="sex" name="sex" class="form-control" value="{{ old('model', isset($consumer) ? $consumer->sex : '') }}" required>
               
                
            </div>
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="age">age*</label>
                <input type="text" id="age" name="age" class="form-control" value="{{ old('model', isset($consumer) ? $consumer->age : '') }}" required>
               
                
            </div>

            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="ads">ads*
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="ads[]" id="ads" class="form-control select2" multiple="multiple" >
                    @foreach($ads as $id => $ads)
                        <option value="{{ $id }}" {{ (in_array($id, old('ads', [])) || isset($consumer) && $consumer->ads->contains($id)) ? 'selected' : '' }}>{{ $ads }}</option>
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