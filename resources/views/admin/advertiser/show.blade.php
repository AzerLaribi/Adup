@extends('layouts.admin')
@section('content')
<!--  -->
@if($advertiser->status == 0)
<div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <form action="/advertise_validation/1" method="POST" class="float-left" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                    <button type="submit" class="btn btn-success btn-circle mr-1">
                        <i class="fas fa-check"></i>  validation {{ $advertiser->location_name }} account
                    </button>
            </form>
        </div>
</div>
@endif
<div class="card">
    <div class="card-header">
    <img src="{{ asset('/image/Advertisers/'.$advertiser->logo)}}" width="50" height="50">
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
                            {{ $advertiser->location_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                             Secteur
                        </th>
                        <td>
                            {{ $advertiser->location_secteur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                             Region
                        </th>
                        <td>
                            {{ $advertiser->location_region }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                             adresse
                        </th>
                        <td>
                            {{ $advertiser->location_address }}
                        </td>
                    </tr><tr>
                        <th>
                             Phone
                        </th>
                        <td>
                            {{ $advertiser->location_tel }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                             Email
                        </th>
                        <td>
                            {{ $advertiser->email_pro }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                             Website
                        </th>
                        <td>
                            {{ $advertiser->website }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            social media
                        </th>
                        <td>
                            {{ $advertiser->social_media }}
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
                            {{ $advertiser->first_name }} {{ $advertiser->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Personnel phone
                        </th>
                        <td>
                            {{ $advertiser->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            email
                        </th>
                        <td>
                            {{ $advertiser->email }}
                        </td>
                    </tr>

                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ route('admin.advertiser.index')}}">
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
