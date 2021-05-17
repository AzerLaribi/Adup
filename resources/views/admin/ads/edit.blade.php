@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Edit ad
    </div>

    <div class="card-body">
        <form action="{{ route("admin.ads.update", [$ad->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="recipient-name" class="col-form-label" value="{{ old('model', isset($ad) ? $ad->type : '') }}" required>Ads Type :</label>
                    <select name="type" id="type" class="form-control">
                        <option id="type" name="type" class="form-control" value=1>Video</option>
                        <option id="type" name="type" class="form-control" value=0>Image</option>
                    </select>
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">title*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('model', isset($ad) ? $ad->title : '') }}" required>


            </div>
            <div class="form-group {{ $errors->has('key') ? 'has-error' : '' }}">
                <label for="description">description*</label>
                <input type="text" id="description" name="description" class="form-control" value="{{ old('model', isset($ad) ? $ad->description : '') }}" required>


            </div>

            <div class="form-group {{ $errors->has('video') ? 'has-error' : '' }}">
                <p>Ads Link :</p>
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="customFile" name="video" value="{{ old('model', isset($ad) ? $ad->video : '') }}" required>
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <div class="form-group {{ $errors->has('start') ? 'has-error' : '' }}">
                <label for="start">start*</label>
                <input type="date" id="start" name="start" class="form-control" value="{{ old('model', isset($ad) ? $ad->start : '') }}" required>


            </div>
            <div class="form-group {{ $errors->has('end') ? 'has-error' : '' }}">
                <label for="end">end*</label>
                <input type="date" id="end" name="end" class="form-control" value="{{ old('model', isset($ad) ? $ad->end : '') }}" required>


            </div>
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="venues">venues
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="venues[]" id="venues" class="form-control select2" multiple="multiple" >
                    @foreach($venues as $id => $venues)
                        <option value="{{ $id }}" {{ (in_array($id, old('venues', [])) || isset($venues) && $ad->venues->contains($id)) ? 'selected' : '' }}>{{ $venues }}</option>
                    @endforeach
                </select>
             </div>
            @if($roleuser =='Admin')

            <div class="form-group " >
                <label for="title">priority</label>
                <input type="text" id="priority" name="priority" class="form-control"   value="{{ old('model', isset($ad) ? $ad->priority : '') }}">


            </div>
            <div class="form-group " >
                <label for="title">duree</label>
                <input type="text" id="time" name="time" class="form-control"  value="{{$ad->time}}">


            </div>
            @endif

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
