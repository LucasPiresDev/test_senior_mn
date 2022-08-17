@extends('layouts.app')

@section('content')
	<app-profile
		:allows="{
			enableMulti: @json(Auth::user()->can('resource', 'profiles.enableMulti')),
			disableMulti: @json(Auth::user()->can('resource', 'profiles.disableMulti')),
			deleteMulti: @json(Auth::user()->can('resource', 'profiles.deleteMulti')),
			create: @json(Auth::user()->can('resource', 'profiles.create')),
			show: @json(Auth::user()->can('resource', 'profiles.show')),
			edit: @json(Auth::user()->can('resource', 'profiles.edit')),
			delete: @json(Auth::user()->can('resource', 'profiles.delete')),
		}"
		:columns="{{ json_encode($columns) }}"
		:status="{{ json_encode($status) }}"
	></app-profile>
@endsection
