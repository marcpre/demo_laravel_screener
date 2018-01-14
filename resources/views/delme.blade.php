@extends('layouts.app') @section('content')
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

<!-- Form -->
<form action="{{ route('instrument.updateDetails', [$instrumentUnderEdit->id]) }}" method='POST' class="repeater" enctype="multipart/form-data">
    {{ csrf_field() }}
    <label>Firstname</label>
    <label>Lastname</label>
    <label>Twitter</label>
    <div data-repeater-list="team">
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
    <div class="row">
        <div class="form-group col-xs-5 col-lg-1">
            <label>User Name*</label>
            <input type="text" name="userName" class="form-control" placeholder="Insert your contributor name" style="width: 250px;"> </div>
    </div>
    <input type="hidden" name='_method' value='POST'>
    <input type="submit" class='btn btn-success btn-sm' value='Update'>
</form>
@endsection
