@extends('layouts.app')

@section('content')
	<app-page-edit
        :url="'/states'"
        :title="'Editar Estado'"
        :url_submit="'/api/states/{{ $state->id }}'"
        :inputs="[
            {
                placeholder: 'Nome',
                label: 'Nome',
                name: 'name',
                minLength: 3,
                maxLength: 100,
                required: true,
                value: '{{ $state->name }}',
            },
            {
                placeholder: 'Código',
                label: 'Código',
                name: 'code',
                minLength: 2,
                maxLength: 100,
                required: true,
                value: '{{ $state->code }}',
            },
            {
                placeholder: 'País',
                label: 'País',
                name: 'country',
                minLength: 3,
                maxLength: 100,
                required: true,
                value: '{{ $state->country }}',
            }
        ]"
    >
    </app-page-edit>
@endsection