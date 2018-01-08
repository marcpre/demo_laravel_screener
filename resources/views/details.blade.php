@extends('layouts.app') @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <img style="height: 32px; width: 32px;" src="{{ asset('images')}}/{{ $instrumentUnderEdit->image }}" /> 
                    {{ $instrumentUnderEdit->name }}
                </div>
                <div class="panel-body"></div>
                <div class="container-fluid">
                    <div class="col-md-2">
                        <div class="table-responsive">
                            </br>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            Country of Origin
                                        </td>
                                        <td>
                                            Whatever
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Sector
                                        </td>
                                        <td>
                                            Whatever
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="tabbable" id="tabs-305570">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#panel-495769" data-toggle="tab">Details
                      </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="panel-495769">
                                    <p>
                                        Team
                                    </p>
                                    <p>
                                        Events
                                    </p>
                                    <p>
                                        Github Repository
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
