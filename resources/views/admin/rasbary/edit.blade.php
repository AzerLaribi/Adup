@extends('layouts.admin')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css?family=Ubuntu');
@import url('https://fonts.googleapis.com/css?family=Ubuntu+Mono');

body {
 
}

#container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

#terminal {
  width: 70vw;
  height: 65vh;
  box-shadow: 2px 4px 10px rgba(0,0,0,0.5);
}

#terminal__bar {
  display: flex;
  width: 100%;
  height: 30px;
  align-items: center;
  padding: 0 8px;
  box-sizing: border-box;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  background: linear-gradient(#504b45 0%,#3c3b37 100%);
}

#bar__buttons {
  display: flex;
  align-items: center;
}

.bar__button {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0;
  margin-right: 5px;
  font-size: 8px;
  height: 12px;
  width: 12px;
  box-sizing: border-box;
  border: none;
  border-radius: 100%;
  background: linear-gradient(#7d7871 0%, #595953 100%);
  text-shadow: 0px 1px 0px rgba(255,255,255,0.2);
  box-shadow: 0px 0px 1px 0px #41403A, 0px 1px 1px 0px #474642;
}
.bar__button:hover {
  cursor: pointer;
}
.bar__button:focus {
  outline: none;
}
#bar__button--exit {
  background: linear-gradient(#f37458 0%, #de4c12 100%);
  background-clip: padding-box;
}

#bar__user {
  color: #d5d0ce;
  margin-left: 6px;
  font-size: 14px;
  line-height: 15px;
}

#terminal__body {
  background: rgba(56, 4, 40, 0.9);
  font-family: 'Ubuntu Mono';
  height: calc(100% - 30px);
  padding-top: 2px;
  margin-top: -1px;
}

#terminal__prompt {
  display: flex;
}
#terminal__prompt--user {
  color: #7eda28;
}
#terminal__prompt--location {
  color: #4878c0;
}
#terminal__prompt--bling {
  color: #dddddd;
}
#terminal__prompt--cursor {
  display: block;
  height: 17px;
  width: 8px;
  margin-left: 9px;
  animation: blink 1200ms linear infinite;
}

@keyframes blink {
  0% {
    background: #ffffff;
  }
  49% {
    background: #ffffff;
  }
  60% {
    background: transparent;
  }
  99% {
    background: transparent;
  }
  100% {
    background: #ffffff;
  }
}

@media (max-width: 600px) {
  #terminal {
    max-height: 90%;
    width: 90%;
  }
}
</style>
<div class="card">
    <div class="card-header">
        Edit Rasbary
    </div>

    <div class="card-body">
        <form action="{{ route("admin.rasbarys.update", [$rasbary->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
    <main id="container">
      <div id="terminal">
        <!-- Terminal Bar -->
        <section id="terminal__bar">
          <div id="bar__buttons">
            <button class="bar__button" id="bar__button--exit">&#10005;</button>
            <button class="bar__button">&#9472;</button>
            <button class="bar__button">&#9723;</button>
          </div>
          <p id="bar__user">rasbary@ {{$rasbary->name}}: ~</p>
        </section>
        <!-- Terminal Body -->
        <section id="terminal__body">
          <div id="terminal__prompt">
            <span id="terminal__prompt--user">sakka @ {{$rasbary->name}} :</span>
            <span id="terminal__prompt--location">~</span>
            <span id="terminal__prompt--bling">$</span>
            <span id="terminal__prompt--cursor"></span>
          </div>
        </section>
      </div>
    </main>  
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