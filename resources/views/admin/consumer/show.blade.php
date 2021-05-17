@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
       View a Team member
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
                            {{ $consumer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Mac
                        </th>
                        <td>
                            {{ $consumer->Mac }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           sex
                        </th>
                        <td>
                            {!! $consumer->sex !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            age
                        </th>
                        <td>
                            {!! $consumer->age !!}
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