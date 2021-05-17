@extends('layouts.admin')
@section('content')
@if($locationpartner->status == 0)
<div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <form action="{{ action('Admin\LocationpartnerController@validation',$locationpartner->id) }}" method="POST" class="float-left" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                    <button type="submit" class="btn btn-success btn-circle mr-1">
                        <i class="fas fa-check"></i>  validation {{ $locationpartner->location_name }} account
                    </button>
            </form>
        </div>
</div>
@endif
<div class="card">
    <div class="card-header">
    <img src="{{ asset('/image/LocationPartner/'.$locationpartner->logo)}}" width="75" height="50">
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>
                                Business Information
                            </th>
                        </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                             Name
                        </th>
                        <td>
                            {{ $locationpartner->location_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                             Secteur
                        </th>
                        <td>
                            {{ $locationpartner->location_secteur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                             Region
                        </th>
                        <td>
                            {{ $locationpartner->location_region }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                             adresse
                        </th>
                        <td>
                            {{ $locationpartner->location_address }}
                        </td>
                    </tr><tr>
                        <th>
                             Phone
                        </th>
                        <td>
                            {{ $locationpartner->location_tel }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                             Email
                        </th>
                        <td>
                            {{ $locationpartner->email_pro }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                             Website
                        </th>
                        <td>
                            {{ $locationpartner->website }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            social media
                        </th>
                        <td>
                            {{ $locationpartner->social_media }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <table class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>
                                Responsable Information
                            </th>
                        </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                             Name
                        </th>
                        <td>
                            {{ $locationpartner->first_name }} {{ $locationpartner->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Personnel phone
                        </th>
                        <td>
                            {{ $locationpartner->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            email
                        </th>
                        <td>
                            {{ $locationpartner->email }}
                        </td>
                    </tr>

                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ route('admin.locationpartner.index')}}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
    </div>
</div>
@endsection
