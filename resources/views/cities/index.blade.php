@extends('layouts.app')

@section('content')
    <app-page-index
        :title="'Cidades'"
        :entity="'cities'"
        :url="'cities'"
        :columns="{{ json_encode($columns) }}"
        :indexstatusfilter="3"
        :filters="[
            {
                type: 'select',
                name: 'state',
                label: 'Estado',
                index: 4,
                options: {{ json_encode($states) }}
            }    
        ]"
    ></app-page-index>
@endsection
