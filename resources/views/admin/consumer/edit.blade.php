@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Edit consumer
    </div>

    <div class="card-body">
        <form action="{{ route("admin.consumers.update", [$consumer->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('Mac') ? 'has-error' : '' }}">
                <label for="Mac">Mac*</label>
                <input type="text" id="Mac" name="Mac" class="form-control" value="{{ old('Mac', isset($consumer) ? $consumer->Mac : '') }}" required>
               
                
            </div>
            <div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
                <label for="sex">sex*</label>
                <input type="sex" id="sex" name="sex" class="form-control" value="{{ old('sex', isset($consumer) ? $consumer->sex : '') }}" required>
               
                
            </div>
            
            <div class="form-group {{ $errors->has('age') ? 'has-error' : '' }}">
                <label for="age">age*</label>
                <input type="text" id="age" name="age" class="form-control" value="{{ old('model', isset($consumer) ? $consumer->age : '') }}" required>
               
                
            </div>
            
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="ads">ads
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="ads[]" id="ads" class="form-control select2" multiple="multiple" >
                    @foreach($ads as $id => $ads)
                        <option value="{{ $id }}" {{ (in_array($id, old('ads', [])) || isset($consumer) && $consumer->ads->contains($id)) ? 'selected' : '' }}>{{ $ads }}</option>
                    @endforeach
                </select>
             
                
            </div>
            <div>

            
            
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.speakers.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($speaker) && $speaker->photo)
      var file = {!! json_encode($speaker->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@stop