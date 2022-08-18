@extends('layouts.app')

@section('content')
    <app-page-index
        :title="'Endereços'"
        :entity="'addresses'"
        :url="'addresses'"
        :columns="{{ json_encode($columns) }}"
        :indexstatusfilter="5"
        :filters="[
            {
                type: 'select',
                name: 'city',
                label: 'Cidade',
                index: 6,
                options: {{ json_encode($cities) }}
            }    
        ]"
    ></app-page-index>
@endsection
