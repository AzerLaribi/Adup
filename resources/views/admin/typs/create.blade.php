@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Creat typ
    </div>

    <div class="card-body">
        <form action="{{ route("admin.types.store") }}" method="POST" >
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="model">name*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('model', isset($type) ? $type->name : '') }}" required>
               
                
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