@extends('layouts.app')

@section('content')
	<app-background-edit
		id="{{ request()->background }}"
		back-url="{{ $backUrl }}"
	></app-background-edit>
@endsection