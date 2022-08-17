@extends('layouts.app')

@section('content')
	<app-profile-edit
		id="{{ request()->profile }}"
		back-url="{{ $backUrl }}"
	></app-profile-edit>
@endsection