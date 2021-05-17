<div>
    <div class="form-group row">
        <label for="tags">tags*
        <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
        <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
        <select wire:model="selectedtag"  name="tags[]" id="tags" class="form-control select2" multiple="multiple" >
            @foreach($tags as $id => $tags)
                <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || isset($venue) && $venue->tags->contains($id)) ? 'selected' : '' }}>{{ $tags }}</option>
            @endforeach
        </select>
    </div>

    @if (!is_null($selectedtag))
    <div class="form-group row">
        <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
            <label for="tags">typs*
            <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
            <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
            <select name="typs[]" id="typs" class="form-control select2" multiple="multiple" >
                @foreach($types as $id => $typs)
                <option value="{{ $id }}" >{{ $typs }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    @if (!is_null($selectedtype))
    <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
        <label for="venues">venues
        <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
        <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
        <select name="venues[]" id="venues" class="form-control select2" multiple="multiple" >
        @foreach($venues as $id => $venues)
            <option value="{{ $id }}" {{ (in_array($id, old('venues', [])) || isset($ads) && $ads->venues->contains($id)) ? 'selected' : '' }}>{{ $venues }}</option>
        @endforeach
        </select>
    </div>
    @endif
</div>
