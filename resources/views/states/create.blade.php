@extends('layouts.app')

@section('content')
	<app-page-create
        :url="'/states'"
        :title="'Cadastrar Estado'"
        :url_submit="'/api/states'"
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
                placeholder: 'Código',
                label: 'Código',
                name: 'code',
                minLength: 2,
                maxLength: 100,
                required: true,
            },
            {
                placeholder: 'País',
                label: 'País',
                name: 'country',
                minLength: 3,
                maxLength: 100,
                required: true,
            }
        ]"
    >
    </app-page-create>
@endsection