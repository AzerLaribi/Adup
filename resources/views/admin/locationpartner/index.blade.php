@extends('layouts.admin')
@section('content')


<div class="card">
    <div class="card-header">
        Location Partner 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Locationpartner">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Logo
                        </th>
                        <th>
                            Business Name
                        </th>
                        <th>
                            Business Region
                        </th>
                        <th>
                            Business Secteur
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            &nbsp;
                        </th>
                       
                    </tr>
                </thead>
                <tbody>
                @foreach($locationpartners as $key => $locationpartner)
                <tr data-entry-id="{{ $locationpartner->id }}">
                    <td>
 
                    </td>
                    <td>
                        <img src="{{ asset('/image/LocationPartner/'.$locationpartner->logo)}}" width="50" height="50">
                    </td>
                    <td>
                        {{ $locationpartner->location_name ?? '' }}
                    </td>
                    <td>
                        {{ $locationpartner->location_region ?? '' }}
                    </td>
                    <td>
                        {{ $locationpartner->location_secteur ?? '' }}
                    </td>
                    <td>
                        {{ $locationpartner->created_at ?? '' }}
                    </td>
                    @if($locationpartner->status==1)
                    <td class="p-3 mb-2 bg-success text-white">
                        @if($locationpartner->status==0) Waiting  @else Validate @endif
                    </td>
                    @else
                    <td class="p-3 mb-2 bg-warning  text-white">
                        @if($locationpartner->status==0) Waiting  @else Validate @endif
                    </td>
                    @endif
                    <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.locationpartner.show', $locationpartner->id) }}">
                                    {{ trans('global.view') }}
                                </a>
                                <form action="{{ route('admin.locationpartner.destroy', $locationpartner->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
  $('.datatable-Locationpartner:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection