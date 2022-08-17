@extends('layouts.app')

@section('content')
	<app-page-create
        :url="'/cities'"
        :title="'Cadastrar Cidade'"
        :url_submit="'/api/cities'"
        :inputs="[
            {
                placeholder: 'Nome',
                label: 'Nome',
                name: 'name',
                minLength: 3,
                maxLength: 100,
                required: true,
            }
        ]"
        :selects="[
            {
                label: 'Estado',
                name: 'state_id',
                required: true,
                options: {{ json_encode($states) }}
            }
        ]"
    >
    </app-page-create>
@endsection