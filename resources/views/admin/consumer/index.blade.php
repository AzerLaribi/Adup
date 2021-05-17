@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.consumers.create") }}">
               Add consumor
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
    consumors
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
                            mac
                        </th>
                        <th>
                            sex
                        </th>
                        <th>
                            age
                        </th>
                       
                        <th>
                            &nbsp;
                        </th>
                       
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($consumors as $key => $consumor)
                        <tr data-entry-id="{{ $consumor->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $consumor->id ?? '' }}
                            </td>
                            <td>
                                {{ $consumor->Mac ?? '' }}
                            </td>
                            <td>
                                {{ $consumor->sex ?? '' }}
                            </td>
                            <td>
                                {{ $consumor->age ?? '' }}
                            </td>
                         
                           
                            <td>
                                
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.consumers.show', $consumor->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                              

                                
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.consumers.edit', $consumor->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                
                              
                                    <form action="{{ route('admin.consumers.destroy', $consumor->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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