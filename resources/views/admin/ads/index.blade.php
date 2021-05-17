@extends('layouts.admin')
@section('content')
@can('advertiser')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.ads.create") }}">
               Add Ad
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Ads
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
                        title
                        </th>
                        <th>
                        description
                        </th>
                        <th>
                        start date
                        </th>
                        <th>
                        end date
                        </th>
                        <th>
                        locations
                        </th>

                        <th>
                            &nbsp;
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($ads as $key => $ad)
                        <tr data-entry-id="{{ $ad->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $ad->id ?? '' }}
                            </td>
                            <td>
                            {{ $ad->title ?? '' }}
                            </td>
                            <td>

                            {{ $ad->video ?? '' }}
                            </td>
                            <td>
                            {{ $ad->start	 ?? '' }}
                            </td>
                            <td>
                            {{ $ad->end ?? '' }}
                            </td>
                            <td>

                            @if($ad->status==0) Waiting @elseif($ad->status==1) Accepted @else Refused @endif
                        </td>
                            <td>

                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.ads.show', $ad->id) }}">
                                        {{ trans('global.view') }}
                                    </a>



                                    <a class="btn btn-xs btn-info" href="{{ route('admin.ads.edit', $ad->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>


                                    <form action="{{ route('admin.ads.destroy', $ad->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
