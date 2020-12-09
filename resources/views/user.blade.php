@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Page') }}</div>

                <div class="card-body">

                    <div class="alert alert-success" role="alert">
                        This is page for admin and user
                    </div>


                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection