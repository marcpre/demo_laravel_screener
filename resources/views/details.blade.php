@extends('layouts.app') @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Screener</div>
                <div class="panel-body"></div>
                <div class="container-fluid">
                    <div class="col-md-2">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Product
                                        </th>
                                        <th>
                                            Payment Taken
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            TB - Monthly
                                        </td>
                                        <td>
                                            01/04/2012
                                        </td>
                                        <td>
                                            Default
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
                                    <a href="#panel-495769" data-toggle="tab">Section 1
                      </a>
                                </li>
                                <li>
                                    <a href="#panel-207616" data-toggle="tab">Section 2
                      </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="panel-495769">
                                    <p>
                                        I'm in Section 1.
                                    </p>
                                </div>
                                <div class="tab-pane" id="panel-207616">
                                    <p>
                                        Howdy, I'm in Section 2.
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
