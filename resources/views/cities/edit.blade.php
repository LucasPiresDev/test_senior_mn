@extends('layouts.app')

@section('content')
	<app-page-edit
    :url="'/cities'"
        :title="'Editar Cidade'"
        :url_submit="'/api/cities/{{ $city->id }}'"
        :inputs="[
            {
                placeholder: 'Nome',
                label: 'Nome',
                name: 'name',
                value: '{{ $city->name }}',
                minLength: 3,
                maxLength: 100,
                required: true,
            }
        ]"
        :selects="[
            {
                label: 'Estado',
                name: 'state_id',
                value: {{ $city->state_id }},
                required: true,
                options: {{ json_encode($states) }},
            }
        ]"
    >
    </app-page-edit>
@endsection