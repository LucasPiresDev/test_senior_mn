@extends('layouts.app')

@section('content')
    <app-page-index
        :title="'Estados'"
        :entity="'states'"
        :url="'states'"
        :columns="{{ json_encode($columns) }}"
        :indexstatusfilter="4"
        :filters="[
            {
                type: 'select',
                name: 'code',
                index: 5,
                label: 'Código',
                options: {{ json_encode($codes) }}
            },
            {
                type: 'select',
                name: 'country',
                index: 6,
                label: 'País',
                options: {{ json_encode($countries) }}
            }
        ]"
    ></app-page-index>
@endsection
