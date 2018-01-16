 @extends('layouts.app') @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <img style="height: 32px; width: 32px;" src="{{ asset('images')}}/{{ $instrumentUnderEdit->image }}" /> {{ $instrumentUnderEdit->name }}
                </div>
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
                </div>
                <div class="container-fluid">
                    <div class="col-md-2">
                        <div class="table-responsive">
                            </br>
                            </br>
                            <!-- Form -->
                            <form action="{{ route('instrument.updateSideTableDetails', [$instrumentUnderEdit->id]) }}" method='POST'>
                            {{ csrf_field() }}
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                Country of Origin
                                            </td>
                                            <td>
                                               <input type="text" name="country_of_origin" value='{{ $instrumentUnderEdit->country_of_origin }}' style="width: 250px;"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Sector
                                            </td>
                                            <td>
                                               <input type="text" name="sector" value='{{ $instrumentUnderEdit->sector }}' style="width: 250px;"/>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </br>
                                </br>

                                <div class="row">
                                 <div class="form-group col-xs-5 col-lg-1">
                                     <label>User Name*</label>
                                     <input type="text" name="userName" class="form-control" placeholder="Insert your contributor name" style="width: 250px;">                                            </div>
                                </div>

                                <div class="row">
                                 <div class="form-group col-xs-5 col-lg-1 ">
                                     <label>Email*</label>
                                     <input type="text" name="email" class="form-control input-normal" placeholder="Insert your email address" style="width: 250px;"/>
                                 </div>
                                </div>

                                <input type="hidden" name='_method' value='POST'>
                                <input type="submit" class='btn btn-success btn-sm' value='Update'>
                            </form>                                
                            <!-- Form -->
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
                                    <h3>
                                        Team
                                    </h3>
                                    <h3>
                                        Upcoming Events
                                    </h3>
                                    <h3>
                                        Code Repository
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
