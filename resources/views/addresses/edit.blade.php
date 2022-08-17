@extends('layouts.app')

@section('content')
	<app-page-edit
    :url="'/addresses'"
        :title="'Editar Endereço'"
        :url_submit="'/api/addresses/{{ $address->id }}'"
        :inputs="[
            {
                placeholder: 'Rua',
                label: 'Rua',
                name: 'street',
                value: '{{ $address->street }}',
                minLength: 3,
                maxLength: 100,
                required: true,
            },
            {
                placeholder: 'Número',
                value: {{ $address->number }},
                label: 'Número',
                name: 'number',
                required: true,
            },
            {
                placeholder: 'Complemento',
                label: 'Complemento',
                name: 'complement',
                value: '{{ $address->complement }}',
                maxLength: 100,
                required: false,
            }
            
        ]"
        :selects="[
            {
                label: 'Cidade',
                name: 'city_id',
                value: {{ $address->city_id }},
                required: true,
                options: {{ json_encode($cities) }}
            }
        ]"
    >
    </app-page-edit>
@endsection