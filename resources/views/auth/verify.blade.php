@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                        <a href="{{ route('getLink',['token' => $token]) }}" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
