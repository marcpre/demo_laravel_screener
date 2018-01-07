@extends('layouts.app') @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Screener</div>

                <div class="panel-body">

                {{-- display success message --}} @if (Session::has('success'))
                    <div class="alert alert-success">
                        <strong>Success:</strong> {{ Session::get('success') }}
                    </div>
                    @endif {{-- display error message --}} @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Error:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Dropdowns Start --}}
                    <ul class="nav nav-pills" role="tablist">
                        <li role="presentation">
                            <button id="checkAllButton" class="btn btn-default" type="button">Check all</button>
                        </li>
                        <li role="presentation">
                            <button id="uncheckAllButton" class="btn btn-default" type="button">Uncheck all</button>
                        </li>
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
                        {{--
                        <li role="presentation">
                            <button class="btn btn-success btn-default" type="button">Approve checked</button>
                            <button class="btn btn-danger btn-default" type="button">Disapprove checked</button>
                        </li>
                        --}}
                        <li role="presentation">Filters: </li>
                        <li role="presentation">
                            <form id="revisionFilter" action="{{ route('revision.filter') }}" method='POST'>
                                {{ csrf_field() }}
                                <input class="form-check-input" type="checkbox" value="1" id="checkbox1" name="checkbox1">
                                <label class="form-check-label" for="checkbox1">
                                    1
                                </label>
                                <input class="form-check-input" type="checkbox" value="0" id="checkbox0" name="checkbox0">
                                <label class="form-check-label" for="checkbox0">
                                    0
                                </label>
                                <label class="form-check-label" for="checkboxNull">
                                <input class="form-check-input" type="checkbox" value="NULL-VALUE" id="defaultCheck1" name="checkboxNull">
                                <label class="form-check-label" for="checkboxNull">
                                    Null
                                </label>
                                <input type="hidden" name='_method' value='POST'>
                                <input id="revisionFilterSubmit" type="submit" class='btn btn-danger btn-sm' value='Filter'>
                            </form>
                        </li>
                        <li role="presentation">
                            <form id="revisionOverview" action="{{ route('revision.updateOverview') }}" method='POST'>
                                {{ csrf_field() }}
                                <input type="hidden" name='_method' value='POST'>
                                <input id="revisionOverviewSubmit" type="submit" class='btn btn-success btn-sm' value='Update Overview'>
                            </form>
                        </li>
                    </ul>
                    {{-- Dropdowns Ende --}}
                    <div>Total: {{ count($revArray) }} </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Select / Approve</th>
                                <th scope="col">#</th>
                                <th scope="col">Image / Name</th>
                                <th scope="col">Symbol</th>
                                <th scope="col">Sector</th>
                                <th scope="col">Country of Origin</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Revision Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($revArray as $key => $rev)
                            <tr id="rev{{$rev->id}}">
                                @if ($rev->revision_status === 1)
                                <td>
                                    <a href="{{ route('revision.edit', ['instruments_id'=>$rev->id]) }}" class='btn btn-warning btn-sm'>Edit</a>
                                </td>
                                @elseif ($rev->revision_status === 0)
                                <td>
                                </td>
                                @else
                                <td>
                                    <form id="revisionApprove_{{$rev->id}}" action="{{ route('revision.approve', ['rev'=>$rev->id]) }}" method='POST'>
                                        {{ csrf_field() }}
                                        <input type="hidden" name='_method' value='POST'>
                                        <input id="revisionApprove_{{$rev->id}}" type="submit" class='btn btn-success    btn-sm' value='Approve'>
                                    </form>
                                    <form id="revisionDisapprove_{{$rev->id}}" action="{{ route('revision.disapprove', ['rev'=>$rev->id]) }}" method='POST'>
                                        {{ csrf_field() }}
                                        <input type="hidden" name='_method' value='POST'>
                                        <input id="revisionDisapprove_{{$rev->id}}" type="submit" class='btn btn-danger btn-sm' value='Disapprove'>
                                    </form>
                                </td>
                                @endif
                                <td>{{ ++$key }}</td>
                                <td>
                                    <img style="height: 16px; width: 16px;" src="{{ asset('images')}}/{{ $rev->image }}" /> {{ $rev->name }}
                                </td>
                                <td>{{ $rev->symbol }}</td>
                                <td>{{ $rev->sector }}</td>
                                <td>{{ $rev->country_of_origin }}</td>
                                <td>{{ $rev->created_at }}</td>
                                <td>{{ $rev->updated_at }}</td>
                                <td>{{ $rev->revision_status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
