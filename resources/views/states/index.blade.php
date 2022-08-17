@extends('layouts.app')

@section('content')
    <app-page-index
        :title="'Estados'"
        :entity="'states'"
        :url="'states'"
        :columns="{{ json_encode($columns) }}"
        :filters="[
            {
                name: 'date',
                type: 'range',
                index: 4,
                value: 'dt',
            }
        ]"
    ></app-page-index>
@endsection
