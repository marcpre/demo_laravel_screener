 @extends('layouts.app') @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <img style="height: 32px; width: 32px;" src="{{ asset('images')}}/{{ $instrumentUnderEdit->image }}" /> {{ $instrumentUnderEdit->name }}
                    <a href="{{ route('instrument.editDetails', ['instrument_id'=>$instrumentUnderEdit->id]) }}">
                        <sup> EDIT</sup>
                    </a>
                </div>
                <div class="panel-body"></div>
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
                                    <form action="echo.php" class="repeater" enctype="multipart/form-data">
                                        <div data-repeater-list="group-a">
                                            <div data-repeater-item>
                                                <input name="untyped-input" value="A" />

                                                <input type="text" name="text-input" value="Name" />

                                                <input type="text" name="text-input" value="Twitter" />

                                                <input type="text" name="text-input" value="Twitter" />

                                                <input data-repeater-delete type="button" value="Delete" />
                                            </div>
                                        </div>
                                        <input data-repeater-create type="button" value="Add" />
                                    </form>
                                    <!-- Form -->
                                    <h3>
                                        Upcoming Events
                                    </h3>
                                    <!-- Form -->
                                    <form action="echo.php" class="repeater" enctype="multipart/form-data">
                                        <div data-repeater-list="group-a">
                                            <div data-repeater-item>
                                                <input name="untyped-input" value="A" />

                                                <input type="text" name="text-input" value="A" />

                                                <input type="date" name="date-input" />

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

                                                <input data-repeater-delete type="button" value="Delete" />
                                            </div>
                                            <div data-repeater-item>
                                                <input name="untyped-input" value="A" />

                                                <input type="text" name="text-input" value="B" />

                                                <input type="date" name="date-input" />

                                                <textarea name="textarea-input">B</textarea>

                                                <input type="radio" name="radio-input" value="A" />
                                                <input type="radio" name="radio-input" value="B" checked/>

                                                <input type="checkbox" name="checkbox-input" value="A" />
                                                <input type="checkbox" name="checkbox-input" value="B" checked/>

                                                <select name="select-input">
                                                    <option value="A">A</option>
                                                    <option value="B" selected>B</option>
                                                </select>

                                                <select name="multiple-select-input" multiple>
                                                    <option value="A" selected>A</option>
                                                    <option value="B" selected>B</option>
                                                </select>

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
                                    <form action="echo.php" class="repeater" enctype="multipart/form-data">
                                        <div data-repeater-list="group-a">
                                            <div data-repeater-item>
                                                <input name="untyped-input" value="A" />

                                                <input type="text" name="text-input" value="A" />

                                                <input type="date" name="date-input" />

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

                                                <input data-repeater-delete type="button" value="Delete" />
                                            </div>
                                            <div data-repeater-item>
                                                <input name="untyped-input" value="A" />

                                                <input type="text" name="text-input" value="B" />

                                                <input type="date" name="date-input" />

                                                <textarea name="textarea-input">B</textarea>

                                                <input type="radio" name="radio-input" value="A" />
                                                <input type="radio" name="radio-input" value="B" checked/>

                                                <input type="checkbox" name="checkbox-input" value="A" />
                                                <input type="checkbox" name="checkbox-input" value="B" checked/>

                                                <select name="select-input">
                                                    <option value="A">A</option>
                                                    <option value="B" selected>B</option>
                                                </select>

                                                <select name="multiple-select-input" multiple>
                                                    <option value="A" selected>A</option>
                                                    <option value="B" selected>B</option>
                                                </select>

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
