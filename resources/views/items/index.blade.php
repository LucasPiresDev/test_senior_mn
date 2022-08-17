@extends('layouts.app')

@section('content')
	<app-item
		:limits="{{ json_encode($limits) }}"
		:limit="{{ request('limit') ?? $limit }}"
		:allow-create="@json(Auth::user()->can('resource', 'items.create'))"
	></app-item>
@endsection