@extends('layouts.admin')
@section('content')
<!-- Add domaines Popup  -->
<div class="modal fade" id="AdddomainesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New domaine</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form href="{{ route('admin.domaine.create') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">domaine's name:</label>
                <input type="text" name="name"  class="form-control" id="recipient-name">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Send message</button>
        </div>
    </form>
    </div>
  </div>
</div>


<div style="margin-bottom: 10px;" class="row">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AdddomainesModal">
        Add domaine
    </button>
</div>

<div class="card">
    <div class="card-header">
    domaines
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-domaines">
                <thead>
                    <tr>
                        <th width="10">

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
                @foreach($domaines as $domaine)
                <tr>
                    <td>

                    </td>
                    <td>
                        {{ $domaine->name ?? '' }}
                    </td>
                    <td>
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.domaine.edit', $domaine->id) }}">
                                    edit
                                </a>
                                <form action="{{ route('admin.domaine.destroy', $domaine->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-sm btn-danger" value="{{ trans('global.delete') }}">
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
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  $('.datatable-domaines:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
