@extends('layouts.app')

@section('content')
	<app-background
		:limits="{{ json_encode($limits) }}"
		:limit="{{ request('limit') ?? $limit }}"
		:allow-create="@json(Auth::user()->can('resource', 'backgrounds.create'))"
	></app-background>
@endsection