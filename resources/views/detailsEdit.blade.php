 @extends('layouts.app') @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <img style="height: 32px; width: 32px;" src="{{ asset('images')}}/{{ $instrumentUnderEdit->image }}" /> {{ $instrumentUnderEdit->name }}
                </div>
                <div class="panel-body">              
                    {{-- display success message --}} 
                    @if (Session::has('success'))
                    <div class="alert alert-success">
                        <strong>Success:</strong> {{ Session::get('success') }}
                    </div>
                    @endif 
                    {{-- display error message --}} 
                    @if (count($errors) > 0)
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
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            Country of Origin
                                        </td>
                                        <td>
                                            <form action="" method='POST'>
                                                {{ csrf_field() }}
                                                <input type="hidden" name='_method' value='PUT'>

                                                <div class="form-group">
                                                    <input type="text" name='updatedTaskName' class='form-control input-sm' value=''>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Sector
                                        </td>
                                        <td>
                                            <form action="" method='POST'>
                                                {{ csrf_field() }}
                                                <input type="hidden" name='_method' value='PUT'>

                                                <div class="form-group">
                                                    <input type="text" name='updatedTaskName' class='form-control input-sm' value=''>
                                                </div>
                                            </form>
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
                                    <h3>
                                        Team
                                    </h3>
                                    <!-- Form -->
                                    <form action="{{ route('revision.updateDetails', [$instrumentUnderEdit->id]) }}" method='POST' class="repeater" enctype="multipart/form-data">
                                        <label>Firstname</label>
                                        <label>Lastname</label>
                                        <label>Twitter</label>
                                        <div data-repeater-list="group-a">
                                            <div data-repeater-item>

                                                <input type="text" name="firstName" value='{{ $instrumentUnderEdit->firstName }}' />

                                                <input type="text" name="lastName" value='{{ $instrumentUnderEdit->lastName }}' />

                                                <input type="text" name="twitter" value='{{ $instrumentUnderEdit->twitter }}' />

                                                <input data-repeater-delete type="button" value="Delete" />
                                            </div>
                                        </div>
                                        <input data-repeater-create type="button" value="Add" />
                                        </br>
                                        </br>
                                        <input type="hidden" name='_method' value='POST'>
                                        <input type="submit" class='btn btn-success btn-sm' value='Update'>
                                    </form>
                                    <!-- Form -->
                                    <h3>
                                        Upcoming Events
                                    </h3>
                                    <!-- Form -->
                                    <form action="" method='POST' class="repeater" enctype="multipart/form-data">
                                        <label>Event Name</label>
                                        <label>Link</label>
                                        <label>Date</label>
                                        <div data-repeater-list="group-a">
                                            <div data-repeater-item>
                                                <input name="untyped-input" value="A" />

                                                <input type="text" name="text-input" value="A" />

                                                <input type="date" name="date-input" value='{{ $instrumentUnderEdit->date}}' />

                                                <!--
                                                <textarea name="textarea-input">A</textarea>

                                                
                                                <input type="radio" name="radio-input" value="A" checked/>
                                                <input type="radio" name="radio-input" value="B" />

                                                <input type="checkbox" name="checkbox-input" value="A" checked/>
                                                <input type="checkbox" name="checkbox-input" value="B" />

                                                <select name="select-input">
                                                    <option value="A" selected>A</option>
                                                    <option value="B">B</option>
                                                </select>

                                                <select name="multiple-select-input" multiple>
                                                    <option value="A" selected>A</option>
                                                    <option value="B" selected>B</option>
                                                </select>
-->
                                                <input data-repeater-delete type="button" value="Delete" />
                                            </div>
                                        </div>
                                        <input data-repeater-create type="button" value="Add" />
                                    </form>
                                    <!-- Form -->
                                    <h3>
                                        Code Repository
                                    </h3>
                                    <!-- Form -->
                                    <form action="" method='POST' class="repeater" enctype="multipart/form-data">
                                        <label>Link</label>
                                        <div data-repeater-list="group-a">
                                            <div data-repeater-item>

                                                <input type="text" name="text-input" value="A" />

                                                <input data-repeater-delete type="button" value="Delete" />
                                            </div>
                                        </div>
                                        <input data-repeater-create type="button" value="Add" />
                                    </form>
                                    <!-- Form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
