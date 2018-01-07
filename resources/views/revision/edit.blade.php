@extends('layouts.app') @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit</div>

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
                        <form action="{{ route('revision.update', [$revisionUnderEdit->id]) }}" method='POST'>
                            {{ csrf_field() }}
                            <input type="hidden" name='_method' value='PUT'>

                            <div class="form-group">
                                <input type="text" name='name' class='form-control input-lg' value='{{ $revisionUnderEdit->name }}'>
                            </div>

                            <div class="form-group">
                                <input type="text" name='sector' class='form-control input-lg' value='{{ $revisionUnderEdit->sector }}'>
                            </div>

                            <div class="form-group">
                                <input type="text" name='country_of_origin' class='form-control input-lg' value='{{ $revisionUnderEdit->country_of_origin }}'>
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

@endsection
