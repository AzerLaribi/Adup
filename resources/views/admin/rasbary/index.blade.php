@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.rasbarys.create") }}">
               Add Rasbar
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        Rasbary
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
                            model
                        </th>
                        <th>
                            key
                        </th>
                        <th>
                            name
                        </th>
                        <th>
                            boughtdate
                        </th>
                        <th>
                           givingdate
                        </th>
                        <th>
                            &nbsp;
                        </th>
                       
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($rasbarys as $key => $rasbary)
                        <tr data-entry-id="{{ $rasbary->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $rasbary->id ?? '' }}
                            </td>
                            <td>
                                {{ $rasbary->model ?? '' }}
                            </td>
                            <td>
                                {{ $rasbary->key ?? '' }}
                            </td>
                            <td>
                                {{ $rasbary->name ?? '' }}
                            </td>
                            <td>
                                {{ $rasbary->boughtdate ?? '' }}
                            </td>
                            <td>
                                {{ $rasbary->givingdate ?? '' }}
                            </td>
                            <td>
                                
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.rasbarys.show', $rasbary->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                              

                                
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.rasbarys.edit', $rasbary->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                
                              
                                    <form action="{{ route('admin.rasbarys.destroy', $rasbary->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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