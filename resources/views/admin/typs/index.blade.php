@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.types.create") }}">
               Add typ
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
                    @foreach($typs as $key => $typ)
                        <tr data-entry-id="{{ $typ->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $typ->id ?? '' }}
                            </td>

                            <td>
                                {{ $typ->name ?? '' }}
                            </td>
                           
                            <td>
                                
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.types.show', $typ->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                              

                                
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.types.edit', $typ->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                
                              
                                    <form action="{{ route('admin.types.destroy', $typ->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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