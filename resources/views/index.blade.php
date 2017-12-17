@extends('layouts.app') @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Screener</div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif {{-- Dropdowns Start --}}
                    <ul class="nav nav-pills" role="tablist">
                        <li role="presentation">Order: </li>
                        <li role="presentation" class="dropdown">
                            <a href="#" class="dropdown-toggle" id="drop4" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                Ticker
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" id="menu1" aria-labelledby="drop4">
                                <li>
                                    <a href="#">Action</a>
                                </li>
                                <li>
                                    <a href="#">Another action</a>
                                </li>
                                <li>
                                    <a href="#">Something else here</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="#">Separated link</a>
                                </li>
                            </ul>
                        </li>
                        <li role="presentation" class="dropdown">
                            <a href="#" class="dropdown-toggle" id="drop5" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                ASC
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" id="menu2" aria-labelledby="drop5">
                                <li>
                                    <a href="#">ASC</a>
                                </li>
                                <li>
                                    <a href="#">DESC</a>
                                </li>
                            </ul>
                        </li>
                        <li role="presentation">Signal: </li>
                        <li role="presentation" class="dropdown">
                            <a href="#" class="dropdown-toggle" id="drop6" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" id="menu3" aria-labelledby="drop6">
                                <li>
                                    <a href="#">Action</a>
                                </li>
                                <li>
                                    <a href="#">Another action</a>
                                </li>
                                <li>
                                    <a href="#">Something else here</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="#">Separated link</a>
                                </li>
                            </ul>
                        </li>
                        <li role="presentation">Tickers: </li>
                        <li role="presentation" class="dropdown">
                            <a href="#" class="dropdown-toggle" id="drop6" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" id="menu3" aria-labelledby="drop6">
                                <li>
                                    <a href="#">Action</a>
                                </li>
                                <li>
                                    <a href="#">Another action</a>
                                </li>
                                <li>
                                    <a href="#">Something else here</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="#">Separated link</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    {{-- Dropdowns Ende --}}
                    <div>Total: 7116 </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Symbol</th>
                                <th scope="col">Name</th>
                                <th scope="col">Sector</th>
                                <th scope="col">Industry</th>
                                <th scope="col">Country of Origin</th>
                                <th scope="col">Market Cap.</th>
                                <th scope="col">Current Price</th>
                                <th scope="col">% Change</th>
                                <th scope="col">Volume</th>                               
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
