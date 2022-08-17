@extends('layouts.app')

@section('content')
	<app-page-create
        :url="'/users'"
        :title="'Cadastrar Usuário'"
        :url_submit="'/api/users'"
        :inputs="[
            {
                placeholder: 'Nome',
                label: 'Nome',
                name: 'name',
                minLength: 3,
                maxLength: 100,
                required: true,
            },
            {
                placeholder: 'Email',
                label: 'Email',
                name: 'email',
                type: 'email',
                minLength: 3,
                maxLength: 100,
                required: true,
            },
            {
                placeholder: 'Senha',
                label: 'Senha',
                name: 'password',
                type: 'password',
                minLength: 3,
                maxLength: 100,
                required: true,
            }
        ]"
        :selects="[
            {
                label: 'Endereço',
                name: 'address_id',
                required: true,
                options: {{ json_encode($addresses) }}
            }
        ]"
    >
    </app-page-create>
@endsection