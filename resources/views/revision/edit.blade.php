@extends('layouts.app') @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit -
                    <img style="height: 16px; width: 16px;" src="{{ asset('images')}}/{{ $instrumentUnderEdit->image }}" /> {{ $instrumentUnderEdit->name }}
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

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <form action="{{ route('revision.update', [$instrumentUnderEdit->id]) }}" method='POST'>
                                {{ csrf_field() }}
                                <input type="hidden" name='_method' value='POST'>

                                <div class="form-group">
                                    <label class="control-label " for="name">
                                        Name
                                    </label>
                                    <input type="text" name='name' class='form-control input-lg' value='{{ $instrumentUnderEdit->name }}'>
                                </div>

                                <div class="form-group">
                                    <label class="control-label " for="name">
                                        Sector
                                    </label>
                                    <input type="text" name='sector' class='form-control input-lg' value='{{ $instrumentUnderEdit->sector }}'>
                                </div>

                                <div class="form-group">
                                    <label class="control-label " for="name">
                                        Country of Origin
                                    </label>
                                    <input type="text" name='country_of_origin' class='form-control input-lg' value='{{ $instrumentUnderEdit->country_of_origin }}'>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value='Save Changes' class='btn btn-success btn-lg'>
                                    <a href="" class='btn btn-danger btn-lg pull-right'>Go Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
