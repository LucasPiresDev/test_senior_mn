@extends('layouts.app')

@section('content')
	<app-page-edit
    :url="'/users'"
        :title="'Editar Usuário'"
        :url_submit="'/api/users/{{ $user->id }}'"
        :inputs="[
            {
                placeholder: 'Nome',
                label: 'Nome',
                name: 'name',
                value: '{{ $user->name }}',
                minLength: 3,
                maxLength: 100,
                required: true,
            },
            {
                placeholder: 'Email',
                label: 'Email',
                name: 'email',
                value: '{{ $user->email }}',
                type: 'email',
                minLength: 3,
                maxLength: 100,
                required: true,
            }
        ]"
        :selects="[
            {
                label: 'Endereço',
                name: 'address_id',
                value: {{ $user->address_id }},
                required: true,
                options: {{ json_encode($addresses) }}
            }
        ]"
    >
    </app-page-edit>
@endsection