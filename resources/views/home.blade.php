@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header">
        <h4 class="fw-bold mt-2">{{ __('Dashboard') }}</h4>
    </div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        {{ __('You are logged in!') }}
    </div>
</div>
@endsection
