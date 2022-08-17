@extends('layouts.app')

@section('content')
    <app-cover></app-cover>
    <app-login title="{{ config('app.name') }}"></app-login>
@endsection
