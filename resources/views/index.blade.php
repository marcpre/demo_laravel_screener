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
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    <img style="height: 16px; width: 16px;" src="{{ asset('images')}}/{{ $cryptos->image }}" /> {{ $cryptos->name }}
                                </td>
                                <td>{{ $cryptos->symbol }}</td>
                                <td>{{ $cryptos->sector }}
                                    <a href="{{route('editToken.edit',$cryptos->id)}}" data-toggle="modal" data-target="#modalSector">
                                        <sup> EDIT</sup>
                                        <a>
                                </td>
                                <td>{{ $cryptos->country_of_origin }}
                                    <a href="{{route('editToken.edit',$cryptos->id)}}" 
                                    data-id="{{ $cryptos->id }}"
                                    data-title="{{ $cryptos->symbol }}"
                                    data-toggle="modal" 
                                    data-target="#modalCountry">
                                        <sup> EDIT</sup>
                                        <a>
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
<div class="modal fade" id="modalCountry" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
                <form action="/edit/{id}" method='POST' class="form-horizontal" id="modal-coo-form">
                    {{ csrf_field() }}
                    <input type="hidden" name='editID' value=''>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Country of Origin: </label>
                            <div class="col-md-4">
                                <input id="textinput" name="tokenUnderEdit" placeholder="Insert Country of Origin" class="form-control input-md" type="text">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>

{{--
<script>
    $(document).on("click", ".#modalCountry", function () {
        var id = $(this).val();
        url = "/data/" + id;
        $.ajax({
            url: url,
            method: "get"
        }).done(function (response) {
            //Setting input values
            $("input[name='editID']").val(id);
            $("input[name='tokenUnderEdit']").val(response.tokenUnderEdit);

            //Setting submit url
            $("modal-coo-form").attr("action", "/edit/" + id)
        });
    });
</script>
 @include('modals.sector') --}}

@endsection
