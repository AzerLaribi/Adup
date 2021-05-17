@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.tags.create") }}">
               Add tag
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        tags
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
                           name
                        </th>
                       
                        <th>
                            &nbsp;
                        </th>
                       
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($tags as $key => $tag)
                        <tr data-entry-id="{{ $tag->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $tag->id ?? '' }}
                            </td>

                            <td>
                                {{ $tag->name ?? '' }}
                            </td>
                           
                            <td>
                                
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.tags.show', $tag->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                              

                                
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.tags.edit', $tag->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                
                              
                                    <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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