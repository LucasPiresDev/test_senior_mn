@extends('layouts.app')

@section('content')
	<app-page-create
        :url="'/addresses'"
        :title="'Cadastrar Endereço'"
        :url_submit="'/api/addresses'"
        :inputs="[
            {
                placeholder: 'Rua',
                label: 'Rua',
                name: 'street',
                minLength: 3,
                maxLength: 100,
                required: true,
            },
            {
                placeholder: 'Número',
                label: 'Número',
                name: 'number',
                required: true,
            },
            {
                placeholder: 'Complemento',
                label: 'Complemento',
                name: 'complement',
                maxLength: 100,
                required: false,
            }
            
        ]"
        :selects="[
            {
                label: 'Cidade',
                name: 'city_id',
                required: true,
                options: {{ json_encode($cities) }}
            }
        ]"
    >
    </app-page-create>
@endsection