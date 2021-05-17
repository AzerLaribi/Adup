@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} Event
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                           id
                        </th>
                        <td>
                            {{ $event->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            title
                        </th>
                        <td>
                        {{ $event->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        description
                        </th>
                        <td>
                        {{ $event->description ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        start_time
                        </th>
                        <td>
                        {{ $event->start_time ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        finish_time
                        </th>
                        <td>
                        {{ $event->finish_time ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection