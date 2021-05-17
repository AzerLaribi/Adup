@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
       View Rasbary 
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
                            {{ $rasbary->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            model
                        </th>
                        <td>
                            {{ $rasbary->model }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           key
                        </th>
                        <td>
                            {!! $rasbary->key !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            name
                        </th>
                        <td>
                            {!! $rasbary->name !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            name
                        </th>
                        <td>
                            {!! $rasbary->boughtdate !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            name
                        </th>
                        <td>
                            {!! $rasbary->givingdate !!}
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
                    @foreach($rasbary->consumers as $key => $consumor)
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
                              

                              
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection