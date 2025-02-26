@extends('servicemodule::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('servicemodule.name') !!}</p>
@endsection
