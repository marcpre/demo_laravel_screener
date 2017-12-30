@extends('layouts.app') @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Screener</div>

                <div class="panel-body">
                    
                    {{-- Dropdowns Start --}}
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
                    <div>Total: {{ $storedOverview->total() }} </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Symbol</th>
                                <th scope="col">Sector</th>
                                <th scope="col">Country of Origin</th>
                                <th scope="col">Market Cap.</th>
                                <th scope="col">Circulating Supply</th>
                                <th scope="col">Current Price</th>
                                <th scope="col">% Change</th>
                                <th scope="col">Volume</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($storedOverview as $key => $cryptos)
                            <tr id="cryptos{{$cryptos->id}}">
                                <td>{{ ++$key }}</td>
                                <td>
                                    <img style="height: 16px; width: 16px;" src="{{ asset('images')}}/{{ $cryptos->image }}" /> {{ $cryptos->name }}
                                </td>
                                <td>{{ $cryptos->symbol }}</td>
                                <td>{{ $cryptos->sector }}
                                    <a id="sec{{ $cryptos->id }}" name="sector" value="{{ $cryptos->id }}" class="open_modal" data-target="#myModal">
                                        <sup> EDIT</sup>
                                    </a>
                                </td>
                                <td>{{ $cryptos->country_of_origin }} 
                                    <a id="coo{{ $cryptos->id }}" name="country_of_origin" value="{{ $cryptos->id }}" class="open_modal" data-target="#myModal">
                                        <sup> EDIT</sup>
                                    </a>
                                </td>
                                <td>${{ number_format($cryptos->market_cap, 2, ',', '.') }}</td>
                                <td>{{ number_format($cryptos->circulatingSupply, 2, ',', '.') }} {{ $cryptos->symbol }}</td>
                                <td>{{ $cryptos->current_price }}</td>
                                <td>{{ $cryptos->change }}</td>
                                <td>${{ number_format($cryptos->volume_24h, 2, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Pagination --}}
                    <div class="row text-center">
                        {{ $storedOverview->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Country of Origin --}}
<!-- Passing BASE URL to AJAX -->
<input id="url" type="hidden" value="{{ \Request::url() }}">

<!-- MODAL SECTION -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Edit:</h4>
            </div>
            <div class="modal-body">           
                <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                    {{ csrf_field() }}
                    <div class="form-group error">
                        <label for="inputName" class="col-sm-3 control-label">Name: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control has-error" id="name" name="name" placeholder="Insert value" value="">
                            <p class="errorName text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save" value="add">Edit Entry</button>
                <input type="hidden" id="cryptos_id" name="cryptos_id" value="0">
                <input type="hidden" id="secOrcoo" name="secOrcoo" value="0">
            </div>
        </div>
    </div>
</div>

@endsection
