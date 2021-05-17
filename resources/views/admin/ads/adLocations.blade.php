@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        locations  
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Venue">
                <thead>
                    <tr>
                        <th >

                        </th>
                       
                        <th>
                            {{ trans('cruds.venue.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.latitude') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.longitude') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venues as $key => $venue)
                        <tr data-entry-id="{{ $venue->id }}">
                            <td>

                            </td>
                           
                            <td>
                                {{ $venue->name ?? '' }}
                            </td>
                            <td>
                                {{ $venue->address ?? '' }}
                            </td>
                            <td>
                                {{ $venue->latitude ?? '' }}
                            </td>
                            <td>
                                {{ $venue->longitude ?? '' }}
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.venues.show', $venue->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                               

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
@can('venue_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.venues.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Venue:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection